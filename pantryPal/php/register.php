<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>
    <div class="limiter">
        <div class="login-container">
            <div class="logo">
                <a href="home.html">
                    <img src="../images/logoPantrypal.png" alt="PantryPal" width="80%">
                </a>
            </div>

            <form action="" class="login-form" enctype="multipart/form-data">
    
                <div class="body">

                    <span class="login-title">Sign Up</span>

                    <div class="username-container">
                        <input class="input" type="text" name="email" id="username" placeholder="Email" required>
                        <span class="focus-input"></span>
                        <span class="symbol-input"></span>
                    </div>

                    
                    <div class="password-container">
                        <input class="input" type="password" name="pass" id="password" placeholder="Password" required>
                        <span class="focus-input"></span>
                        <span class="symbol-input"></span>
                    </div>

                    <div class="password-container">
                        <input class="input" type="password" name="confirmPass" id="confirmPass" placeholder=" Confirm Password" required>
                        <span class="focus-input"></span>
                        <span class="symbol-input"></span>
                    </div>

                    <button class="login-form-btn"> Register </button>
                  
                </div>
                
                <div class="backtologin">
                    <a class="txt2" href="login.php"> Back to Login </a>
                </div>

            </form>
        </div>
    </div>

    <script src="../js/register.js"></script>
</body>
</html>