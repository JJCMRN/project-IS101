const form = document.querySelector('.login-form');
loginBtn = document.querySelector('.login-form-btn');

form.onsubmit = (e) => {
    e.preventDefault();
}

loginBtn.onclick = () => {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "functions/post_login.php", true);
    xhr.onload = () => {
        if(xhr.readyState === XMLHttpRequest.DONE) {
            if(xhr.status === 200) {
                let data = xhr.response;
                console.log(data);
                if (data == "success") {
                    location.href = "home.php";
                }
                else {
                    console.log("not success");
                }
            }
        }
    }

    let formData = new FormData(form);
    xhr.send(formData);
}