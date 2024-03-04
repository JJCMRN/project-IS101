<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>PantryPal</title>
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Rubik:wght@500&display=swap');

* {
    box-sizing: border-box;
    margin: 0%;
    padding: 0%;
}

body {
    display: flex;
    flex-direction: column;
    width: 100%;
    height: 100vh;
    background-image: linear-gradient(rgba(0,0,0,0.75), rgba(0,0,0,0.75)),url('image/banner.png');
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    position: relative;
}

header {
    width: 100%;
    display: flex;
    justify-content: flex-end;
    padding: 1px 5%;
    align-items: center;
    background-color: #333;
    position: fixed;
}

li, a, button {
    font-family: 'Rubik', sans-serif;
    font-weight: 500;
    color: rgb(42, 175, 42);
    text-decoration: none;
}
li:hover{
    scale: 1.5;
    transition: 1.2s;
}

button {
    margin-left: 20px;
    padding: 9px 25px;
    cursor: pointer;
    border: none;
    border-radius: 50px;
    color: white;
    background-color: rgb(42, 175, 42);
}

footer {
    bottom: 0;
    width: 100%;
    background-color: rgb(42, 175, 42);
    color: rgb(255, 255, 255);
    text-align: center;
    padding: 15px;
}

main .section1 { 
    color: white;
}

.section1 {
    font-style: italic;
    display: flex;
    justify-content: center;
    padding: 200px 10%;
}

main .section2 {
    padding: 100px 20%;
    justify-content: center;
    background-color: white;
    font-size: xx-large;
}

main .section2 .getStartedbutton {
    display: flex;
    justify-content: center;
    padding: 100px 10%;
}

.logo {
    cursor: pointer;
    margin-right: auto;
}

.nav_links {
    list-style: none;
    text-decoration: none;
}

.nav_links li {
    display: inline-block;
    padding: 0px 20px;
}

#recipe-suggestion {
    max-width: 600px;
    margin: 50px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

#upload-btn-wrapper {
    position: relative;
    overflow: hidden;
    display: inline-block;
    margin-bottom: 20px;
}

#upload-btn-wrapper input[type=file] {
    font-size: 100px;
    position: absolute;
    left: 0;
    top: 0;
    opacity: 0;
}

#upload-btn-wrapper .btn {
    border: 2px solid gray;
    color: gray;
    background-color: white;
    padding: 8px 20px;
    border-radius: 8px;
    font-size: 16px;
    font-weight: bold;
}

#upload-btn-wrapper .btn:hover {
    border-color: #333;
    cursor: pointer;
}

#image-preview-container {
    display: none;
    margin-top: 20px;
}

#image-preview-container img {
    max-width: 100%;
    margin-top: 10px;
}

#suggest-recipe-btn {
    display: none;
    margin-top: 20px;
    border: 2px solid green;
    color: green;
    background-color: white;
    padding: 8px 20px;
    border-radius: 8px;
    font-size: 16px;
    font-weight: bold;
    cursor: pointer;
}

#recipe-suggestion-text {
    display: none;
    margin-top: 20px;
}
.center-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}
        </style>
    </head>

    <body>
        <header>

            <img class="logo" src="image/PantryPal_Logo_Name.png" alt="PantryPal : Smart Cooking Companion" width="25%">
   
            <nav>
                <ul class="nav_links">
                    <li><a href="home.html">Home</a></li>
                    <li><a href="#">About</a></li>
                    <li><a href="#">Contact us</a></li>
                </ul>
            </nav>

            <a class="loginButton" href="login.php"><button>Login/SignUp</button></a>

        </header>
        
        <main>
            <section class="section1">
                <h2>PantryPal is an AI bot that suggesting menus, recipes and meals.</h2>
            </section>
            <section class="section2">
                <p>The sole purpose of this project is to help you to think and decide on what you should cook today based on the 
                    available ingredients you have.
                </p>
                <div class="getStartedbutton">
                    <a href="home.php"><button>Get Started</button></a>
                </div>
            </section>
        </main>

        <footer>
            <p>&copy;2024 Pantry Pal. All Rights Reserved</p>
        </footer>
    </body>
</html>