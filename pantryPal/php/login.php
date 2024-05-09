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
                <a href="get_started.html">
                    <img src="../images/logoPantrypal.png" alt="PantryPal" width="80%">
                </a>
            </div>

            <form action="" class="login-form">

                <div class="body">

                    <span class="login-title">Please Login</span>

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

                    <button class="login-form-btn"> Login </button>
                
                </div>
                
                <div class="register-form">
                    <a class="txt2" href="register.php"> Create Account </a>
                </div>

            </form>     
        </div>
    </div>

    <script src="../js/login.js"></script>
</body>
</html>