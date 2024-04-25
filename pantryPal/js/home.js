const inputFile = document.querySelector('#fileInput');
const imgArea = document.querySelector('.image-uploaded');
const imageArea = document.querySelector('.image-area');
const form = document.querySelector('.file-form');
logoutBtn =  document.querySelector('#logoutBtn');
sendBtn = document.querySelector('#send-button');
chat_module = document.querySelector('#chat-module');

form.onsubmit = (e) => {
    e.preventDefault();
}

inputFile.addEventListener('change',function () {
    const image = this.files[0];
    console.log(image);

    const reader = new FileReader();
    reader.onload = () => {
        const allImg = imageArea.querySelectorAll('img');
        allImg.forEach(item => item.remove());
        const imgUrl = reader.result;
        const img = document.createElement('img');
        img.src = imgUrl;
        imgArea.appendChild(img);
        imgArea.classList.add('active');

    };
    reader.readAsDataURL(image);

    imageArea.style.display = 'flex';
    
});

window.onload = function() {
    loadChat();
};

// setInterval (() => {}, 500);

function loadChat () {
    let xhr = new XMLHttpRequest();
    xhr.open("GET", "functions/get_home.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                console.log(data);
                chat_module.innerHTML = data;
                autoScrollDown();
            }
        }
    }
    xhr.send();
}

function generateResponse () {

    let xhr = new XMLHttpRequest();
    xhr.open("GET", "../openai.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                console.log(data);
                chat_module.innerHTML = data;
            }
        }
    }
    xhr.send();
}

function insertChat () {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "functions/insert_chat.php", true);
    xhr.onload = () => {
        if(xhr.readyState === XMLHttpRequest.DONE) {
            if(xhr.status === 200) {
                let data = xhr.response;
                console.log(data);
                loadChat();
                autoScrollDown();

                setTimeout(() => {loadChat()}, 4000);
                }
            }
        }
    let formData = new FormData(form);
    xhr.send(formData);
}

sendBtn.onclick = () => {
    insertChat();
}

function autoScrollDown() {
    var chat_module = document.querySelector('.main-content');
    chat_module.scrollTop = chat_module.scrollHeight; // Set scrollTop to the height of the scrollable content
}

function exitImageArea() {
    const imgArea = document.querySelector('.image-uploaded');
    // Remove all child elements (images) from imgArea
    while (imgArea.firstChild) {
        imgArea.removeChild(imgArea.firstChild);
    }
    // Hide the imageArea container
    const imageArea = document.querySelector('.image-area');
    imageArea.style.display = 'none';
}

function logout() {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "functions/logout.php", true);
    xhr.onload = () => {
        if(xhr.readyState === XMLHttpRequest.DONE) {
            if(xhr.status === 200) {
                let data = xhr.response;
                console.log(data);
                window.location.href = "../php/login.php";
                }
            }
        }
    xhr.send();
}

logoutBtn.addEventListener('click', function() {
    logout();
})


//----------------------------------------------------------------------------------
// Teachable Machine - Tensorflow.js


// The link to your model provided by Teachable Machine export panel
const URL = "../data-source/";

let model, labelContainer, maxPredictions;
let modelLoaded = false;

// Load the image model
async function init() {
    const modelURL = URL + "model.json";
    const metadataURL = URL + "metadata.json";

    // Load the model and metadata
    model = await tmImage.load(modelURL, metadataURL);
    maxPredictions = model.getTotalClasses();

    // Set the modelLoaded flag to true
    modelLoaded = true;

}

// Handle image upload
async function handleImageUpload(event) {
    const imageFile = event.target.files[0];
    if (!imageFile) return;

    const img = document.createElement('img');
    img.onload = async () => {
        if (modelLoaded) { // Check if the model has finished loading
            const prediction = await predict(img);
            updateLabel(prediction);
        } else {
            console.error('Model is not yet loaded.');
        }
    };
    img.src = window.URL.createObjectURL(imageFile);
}

// Run prediction on the provided image
async function predict(img) {
    const prediction = await model.predict(img);
    return prediction;
}

// Update the label container with prediction results
function updateLabel(prediction) {
    let maxProbability = 0;
    let maxClassIndex = 0;

    for (let i = 0; i < maxPredictions; i++) {
        const probability = prediction[i].probability;

        if (probability > maxProbability) {
            maxProbability = probability;
            maxClassIndex = i;
        }

        const classPrediction = prediction[i].className + ": " + probability.toFixed(2);
        console.log(classPrediction);
    }

    const maxClassPrediction = `${prediction[maxClassIndex].className}`;
    console.log(maxClassPrediction);

    
    setTimeout(() => {
        sendPredictionToPHP(maxClassPrediction);
        insertPredict();
    }, 6000);
}

function sendPredictionToPHP(maxClassPrediction) {

    fetch('functions/post_prediction.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({maxClassPrediction: maxClassPrediction})
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        console.log('Prediction sent successfully:', data);
    })
    .catch(error => {
        console.error('Error sending prediction to PHP:', error);
    });
}

function insertPredict() {
    const form = document.querySelector('.file-form');
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "functions/post_prediction.php", true);
    xhr.onload = () => {
        if(xhr.readyState === XMLHttpRequest.DONE) {
            if(xhr.status === 200) {
                let data = xhr.response;
                console.log(data);
                }
            }
        }
    let formData = new FormData(form);
    xhr.send(formData);
}

init();