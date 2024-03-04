<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PantryPal</title>
    <link rel="stylesheet" href="../css/home.css">
</head>
<body>
    
    <div class="main-container">
        <div class="navigation">
            <h1>navigation</h1> 
        </div>

        <div class="main-content">
            <h1>Katulong sa pag luluto</h1>
            <hr>
        </div>

        <div class="left-sidebar">
            <div class="logo-container">
                <h2>PANTRYPAL</h2>
                <p>Smart Cooking Companion</p>
            </div>
            <div class="recent-content">
                <section>
                </section>
            </div>
            <div class="log-button">
                <button id="logoutBtn" onclick="logout()">Logout</button>
                <button id="loginBtn" onclick="login()">Login</button>
            </div>
        </div>

        <div class="bottom-content">
            <div class="custom-file-input">
                <input type="file" id="fileInput" />
                <label for="fileInput">Mag-upload ng File</label>
            </div>
        </div>
    </div>
    <script src="script/script.js"></script>
</body>
</html>