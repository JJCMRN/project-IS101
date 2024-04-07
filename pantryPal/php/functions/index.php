<?php 
    require 'connection.php';
    if(isset($_POST["submit"])) {
        $name = $_POST["name"];

        if ($_FILES["image"]["error"] === 4 ) {
            echo "<script> alert('Image Does not Exist'); <script>";
        }
        else {
            $filename = $_FILES["image"] ["name"];
            $fileSize = $_FILES["image"] ["size"];
            $tmpName = $_FILES["image"] ["tmp_name"];

            $validImageExtension = ['.jpg', 'png', 'jpeg'];
            $imageExtension = explode('.', $filename);
            $imageExtension = strtolower(end($imageExtension));

            if (!in_array($imageExtension, $validImageExtension)){
                echo "<script> alert('Invalid Image Extension'); <script>";
            }
            else if ($fileSize > 1000000) {
                echo "<script> alert('Image Size is too large'); <script>";
            }
            else {
                $newImageName = uniqid();
                $newImageName .= '.'. $imageExtension;

                move_uploaded_file($tmpName, 'image_uploaded\img' . $newImageName);
                $query = "INSERT INTO tb_upload VALUES ('', '$name', '$newImageName')";
                mysqli_query($conn,$query);
                
                echo 
                "<script> 
                    alert('Successfully Added');
                    document.location.href = 'data.php'; 
                <script>";
            
            }
        }
    } 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Image</title>
</head>
<body>
    <form class="" action="" method="post" autocomplete="off" enctype="multipart/form-data">
        <label for="name">Name : </label>
        <input type="text" name="name" id="name" required value=""> <br>
        <label for="image">Image : </label>
        <input type="file" name="image" id="image" accept=".jpg, .jpeg, .png" value=""> <br> <br>
        <button type="submit" name="submit">Submit</button>
    </form>

    <a href="data.php">Data</a>
</body>
</html>