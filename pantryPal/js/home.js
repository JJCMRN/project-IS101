const selectImage = document.querySelector('.image-button');
const inputFile = document.querySelector('#fileInput');
const imgArea = document.querySelector('.image-uploaded');
const imageArea = document.querySelector('.image-area')


selectImage.addEventListener('click', function () {
    inputFile.click();
})

inputFile.addEventListener('change',function () {
    const image = this.files[0]
    console.log(image);

    const reader = new FileReader();
    reader.onload = () => {
        const allImg = imageArea.querySelectorAll('img')
        allImg.forEach(item => item.remove())
        const imgUrl = reader.result;
        const img = document.createElement('img');
        img.src = imgUrl;
        imgArea.appendChild(img);
        imgArea.classList.add('active');
    }
    reader.readAsDataURL(image);

    imageArea.style.display = 'flex';
})

function exitImageArea() {
    const imageArea = document.querySelector('.image-area');
    imageArea.style.display = '';
}
