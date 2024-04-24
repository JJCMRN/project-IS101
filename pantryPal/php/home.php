<?php 
    session_start();
    if (!isset($_SESSION['user_id'])) {
        header("location : ../php/login.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>PantryPal</title>
        <link rel="stylesheet" href="../css/home.css">
    </head>
    <body>
        <header>
            <?php 
                include_once("../php/functions/config.php");
                $user_id = mysqli_real_escape_string($conn, $_SESSION['user_id']);
                $sql = mysqli_query($conn,"SELECT * FROM users WHERE user_id = '{$user_id}'");
                if (mysqli_num_rows($sql) > 0) {
                    $row = mysqli_fetch_assoc($sql);
                }
            ?>   
                    <nav> 
                        <ul class="nav_links">
                            <li>
                                <a>
                                    <img class="logo" src="../images/logoPantryPalLight.png" alt="PantryPal : Smart Cooking Companion" width="50%">
                                </a>
                            </li>
                            <div>
                                <li><a href="../php/index.html">About</a></li>
                                <li><a href="#">Help</a></li>
                            </div>
                            
                        </ul>
                    </nav>
        </header>

        <main>
            <div class="main-container">

                <div class="left-sidebar">
                    <div class="recent-content">

                        <div class="new-chat">
                            <p>Settings</p>
                            <a href="#">
                                <svg class="new-chat-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24">
                                    <path d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h280v80H200v560h560v-280h80v280q0 33-23.5 56.5T760-120H200Zm188-212-56-56 372-372H560v-80h280v280h-80v-144L388-332Z" fill="white"/>
                                </svg>
                            </a>
                        </div>
                        <div class="chat-history">
                            <header>
                                <h3>Account Name</h3>
                            </header>
                            <div class="chat-history-content">
                                <p>Earl Verzon</p>       
                            </div>
                        </div>
                    </div>
                    <div class="log-button">
                        <button id="logoutBtn">
                            <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24">
                                <path fill="white" d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h280v80H200v560h280v80H200Zm440-160-55-58 102-102H360v-80h327L585-622l55-58 200 200-200 200Z"/>
                            </svg>Logout
                        </button>
                    </div>
                </div>

                <div class="chat-window" >
                    <div class="main-content" id="chat-module">
                      <div>
                        <p>
                            Want to know the dishes? Let's start our cooking stories
                        </p>
                      </div>
                    </div>  

                    <div class="bottom-content">

                        <div class="custom-file-input">

                            <form class="file-form" enctype="multipart/form-data">

                                <div class="image-area" data-img="">
                                    <a href="#" onclick="exitImageArea()"><svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"/></svg></a>                                    
                                    <a href="#" class="image-uploaded" id="image"></a>
                                </div>
                                <input type="text" name="outgoing_id" value="<?php echo $_SESSION['user_id']; ?>" hidden>
                                <input type="text" name="name" id="file-name" placeholder="File name" required>
                                <label for="fileInput">Upload File</label>
                                <input type="file" id="fileInput" name="image" accept=".jpg, .jpeg, .png" 
                                        value="" onchange="handleImageUpload(event)" >

                                <div class="send-button">
                                    <button type="submit" name="submit" class="image-button" id="send-button">Send
                                        <svg class="send-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24">
                                            <path fill="white" d="M120-160v-640l760 320-760 320Zm80-120 474-200-474-200v140l240 60-240 60v140Zm0 0v-400 400Z"/>
                                        </svg>
                                    </button>
                                </div>  

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        
        
        <script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs@latest/dist/tf.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@teachablemachine/image@latest/dist/teachablemachine-image.min.js"></script>
        <script src="../js/home.js"></script>
        <!-- <script src="../js/ai-prediction.js"></script> -->
    </body>
</html>
