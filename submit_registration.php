<?php 
session_start();
require 'db/functions.php';

$result = query("SELECT * FROM users");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
</head>

<body>
    <div class="header">
        <div class="header-left">
            <div class="header-logo">
                <img src="img/logo.png" alt="Logo">
            </div> 
            <div class="header-title">
                <h1>Trust Build</h1>
            </div>
        </div>

        <div class="navbar">
            <ul class="nav-list">
                <li class="nav-item"><a href="u_dashboard.php">Home</a></li>
                <li class="nav-item"><a href="u_company.php">Company</a></li>
                <li class="nav-item"><a href="information.php">Information</a></li>
                <li class="nav-item"><a href="profil.php"><?php echo $_SESSION["username"]; ?></a></li>
                <li class="nav-profil"><img src="img/profil.png" alt=""></li>
                <li class="nav-profil"><img src="img/iconhistory.png" alt=""></li>
            </ul>
        </div>
    </div>

    <div class="header.php">
        <!-- Header content -->
    </div>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $order_request = $_POST['order_request'];

        // Handle file uploads
        $upload_dir = 'uploads/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        $payment_proof_path = $upload_dir . basename($_FILES['payment_proof']['name']);
        $contract_path = $upload_dir . basename($_FILES['contract']['name']);

        $upload_ok = 1;
        
        // Check if files are valid and move them to the upload directory
        if (move_uploaded_file($_FILES['payment_proof']['tmp_name'], $payment_proof_path) && move_uploaded_file($_FILES['contract']['tmp_name'], $contract_path)) {
            echo "<div class='success-message'>";
            echo "<h1>FILE BERHASIL DIUNGGAH</h1>";
            echo "<a href='u_dashboard.php' class='back-button'>Kembali ke Halaman Utama</a>";
            echo "</div>";
        } else {
            echo "<script>alert('Maaf, terjadi kesalahan saat mengunggah file.');</script>";
            $upload_ok = 0;
        }
    }
    ?>

    <?php require 'footer.php'?>

    
</body>
</html>
