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

    









    
    </main>
<?php require 'footer.php'?>
</body>
</html>