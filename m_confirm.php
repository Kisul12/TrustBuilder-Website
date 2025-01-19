<?php 

session_start();
require 'db/functions.php';

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
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
                <li class="nav-item"><a href="m_dashboard.php">Protofolio</a></li>
                <li class="nav-item"><a href="m_confirm.php">Confirm</a></li>
                <li class="nav-item"><a href="m_schedule.php">Schedule</a></li>
                <li class="nav-item"><a href="profil.php"><?php echo $_SESSION["username"]; ?></a></li>
                <li class="nav-profil"><img src="img/profil.png" alt="Profile Picture"></li>
                <li class="nav-profil"><img src="img/iconhistory.png" alt="History Icon"></li>
            </ul>
        </div>
    </div>

    <div class="search">
        <div class="search_box">
            <input type="text" class="input" placeholder="search...">
            <div class="btn btn_common">
                <i class="fas fa-search"></i>
            </div>
        </div>
    </div>    

    <?php require 'footer.php'?>
</body>
</html>
