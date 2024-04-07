const form = document.querySelector('.login-form');
registerBtn = document.querySelector('.login-form-btn');

form.onsubmit = (e) => {
    e.preventDefault();
}

registerBtn.onclick = () => {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "functions/signup.php", true);
    xhr.onload = () => {
        if(xhr.readyState === XMLHttpRequest.DONE) {
            if(xhr.status === 200) {
                let data = xhr.response;
                if (data == "success") {
                    location.href = "home.php"
                }
                else {
                    console.error("not success");
                }
            }
        }
    }

    let formData = new FormData(form);
    xhr.send(formData);
}