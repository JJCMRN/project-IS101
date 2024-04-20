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
    };
    xhr.send();
}

sendBtn.onclick = () => {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "functions/insert_chat.php", true);
    xhr.onload = () => {
        if(xhr.readyState === XMLHttpRequest.DONE) {
            if(xhr.status === 200) {
                let data = xhr.response;
                console.log(data);
                setTimeout(getPredictionPHP(), 3000)
                }
            }
        }
    let formData = new FormData(form);
    xhr.send(formData);
    
}

function autoScrollDown() {
    var chat_module = document.querySelector('.main-content');
    chat_module.scrollTop = chat_module.scrollHeight; // Set scrollTop to the height of the scrollable content
}

function getPredictionPHP () {
    let xhr = new XMLHttpRequest();
    xhr.open("GET", "functions/get_prediction.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                console.log(data);
                chat_module.innerHTML = data;
            }
        }
    };
    xhr.send();
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