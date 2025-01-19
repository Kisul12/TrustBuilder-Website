<?php 
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "trustbuilder";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch properties from the portofolio table
$sql = "SELECT * FROM portofolio";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php require 'header.php'; ?>

    <div class="container">
        <div class="container-1">
            <div class="persuasif">
                <h1>Make Your Own</h1>
                <h1>Cozy Home</h1>
            </div>
        </div>

        <div class="container-2">
            <div class="promot">
                <div class="text1">
                    <h1>About Us</h1>
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis odio laborum, deserunt a distinctio, maiores minus velit optio amet quidem ipsam doloribus magni impedit nam? Tenetur inventore dolorum dolore 
                    </p>
                </div>
                <div class="promot-image">
                    <img src="img/rumah1.png" alt="House 1">
                </div>
            </div>

            <div class="promot">
                <div class="promot-image">
                    <img src="img/rumah2.png" alt="House 2">
                </div>
                <div class="text2">
                    <h1>UNLOCK AND MAKE FREEDOM WITH YOUR OWN HOME</h1>
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis odio laborum, deserunt a distinctio, maiores minus velit optio amet quidem ipsam doloribus magni impedit nam? Tenetur inventore dolorum dolore 
                    </p>
                </div>
            </div>
        </div> 

        <div class="container3-title">
            <h1>OUR PROJECT</h1>
        </div>

        <div class="container-3"> 
        <?php
            if ($result->num_rows > 0) {
                $count = 0;
                while ($row = $result->fetch_assoc()) {
                    if ($count < 8) {
                        echo '<div class="grid-item">';
                        echo '<img src="uploads/' . $row["gambar_rumah"] . '" alt="' . $row["nama_rumah"] . '">';
                        echo '</div>';
                        $count++;
                    } else {
                        break; // keluar dari loop setelah menampilkan 8 item
                    }
                }
            } else {
                echo "No projects found.";
            }
            $conn->close();
            ?>

        </div>

        <div class="container3-title">  
            <h1>What Our Client Say</h1>
        </div>

        <div class="container-4">
            <div class="card">
                <img src="img/gambar.png" alt="Client">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Expedita delectus omnis unde et laboriosam accusantium, ratione atque quibusdam consequuntur ea vel, recusandae aut repellendus eius dolore debitis asperiores ducimus eveniet.</p>
            </div>

            <div class="card">
                <img src="img/gambar.png" alt="Client">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Expedita delectus omnis unde et laboriosam accusantium, ratione atque quibusdam consequuntur ea vel, recusandae aut repellendus eius dolore debitis asperiores ducimus eveniet.</p>
            </div>

            <div class="card">
                <img src="img/gambar.png" alt="Client">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Expedita delectus omnis unde et laboriosam accusantium, ratione atque quibusdam consequuntur ea vel, recusandae aut repellendus eius dolore debitis asperiores ducimus eveniet.</p>
            </div>
        </div>
    </div>
    <?php require 'footer.php'; ?>
</body>
</html>
