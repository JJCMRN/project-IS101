<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ImageData</title>
</head>
<body>
    <table border="1" cellspacing="0" cellpadding="10">
        <tr>
            <td>#</td>
            <td>Name</td>
            <td>Image</td>
        </tr>

        <?php
        require 'connection.php'; // Include your database connection file
        
        // Retrieve data from the database
        $query = "SELECT * FROM tb_upload ORDER BY id DESC";
        $result = mysqli_query($conn, $query);
        $i = 1;
        
        // Loop through the retrieved data and display it in the table
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $i++ . "</td>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td><img src='image_uploaded/img" . $row['image'] . "' alt='image_uploaded'></td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>
