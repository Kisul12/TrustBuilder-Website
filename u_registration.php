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

    <body>
    <div class="header.php">
        <!-- Header content -->
    </div>

    <main class="content">
        <div class="form-container">
            <h2>Formulir Pendaftaran</h2>
            <form action="submit_registration.php" method="post" enctype="multipart/form-data">
                <label for="name">Nama:</label>
                <input type="text" id="name" name="name" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>

                <label for="phone">Telepon:</label>
                <input type="tel" id="phone" name="phone" required>

                <label for="payment_proof">Bukti Pembayaran:</label>
                <input type="file" id="payment_proof" name="payment_proof" accept="image/*,.pdf" required>

                <label for="contract">Kontrak:</label>
                <input type="file" id="contract" name="contract" accept=".pdf" required>

                <label for="order_request">Request Pesanan:</label>
                <textarea id="order_request" name="order_request" rows="4" required></textarea>
                <button type="submit">Daftar</button>
               
            </form>
        </div>
    </main>

    <?php require 'footer.php'?>
    
</body>
</html>