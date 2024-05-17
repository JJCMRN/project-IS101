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

async function insertChat() {
    try {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "functions/insert_chat.php", true);

        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = xhr.response;
                    console.log(data);
                    loadChat();
                    autoScrollDown();
                }
            }
        };

        let formData = new FormData(form);
        xhr.send(formData);

        // Wait for the chat to be inserted
        await new Promise((resolve) => {
            xhr.onloadend = () => resolve();
        });

        await insertOpenAi();

        // Wait for insertOpenAi to finish before loading chat again
        await new Promise((resolve) => setTimeout(resolve, 2000));

        loadChat();
    } catch (error) {
        console.error('Error during insertChat:', error);
    }
}


function autoScrollDown() {
    var chat_module = document.querySelector('.main-content');
    chat_module.scrollTop = chat_module.scrollHeight; // Set scrollTop to the height of the scrollable content
}

function exitImageArea() {

    const imageArea = document.querySelector('.image-area');
    const imgArea = document.querySelector('.image-uploaded');

    while (imgArea.firstChild) {imgArea.removeChild(imgArea.firstChild);}
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


document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('fileForm');

    form.addEventListener('submit', function(event) {
        const inputs = form.querySelectorAll('input[required]');
        let allFilled = true;
        
        inputs.forEach(input => {
            if (!input.value.trim()) {
                allFilled = false; 
            }
        });

        if (!allFilled) {
            event.preventDefault(); // Prevent form submission if not all fields are filled
        }
        else {
            insertChat(); //Insert to Database <form> inputs
            exitImageArea(); //Cleared <form> inputs
        }
    });
});







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

    sendPredictionToPHP(maxClassPrediction);
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

async function insertOpenAi() {

    return new Promise((resolve, reject) => {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "../post-openai.php", true);
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = xhr.response;
                    console.log(data);
                    resolve(); // Resolve the promise when done
                } else {
                    reject(`Error: ${xhr.status}`); // Reject the promise on error
                }
            }
        };
        xhr.onerror = () => reject("Network error");

        let form = document.getElementById('fileForm');
        let formData = new FormData(form);
        xhr.send(formData);
    });
}

init();