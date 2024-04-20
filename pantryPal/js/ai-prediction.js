
// The link to your model provided by Teachable Machine export panel
const URL = "https://teachablemachine.withgoogle.com/models/QJXWUlRoh/";

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
    insertPredict();
}

function sendPredictionToPHP(maxClassPrediction) {
    // Make a POST request to your PHP script
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