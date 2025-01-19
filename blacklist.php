<?php 
    require 'db/functions.php';
    $result = query("SELECT * FROM users");
    $blacklist_result = query("SELECT users.id, users.username, users.email FROM blacklist JOIN users ON blacklist.id_user = users.id");
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
                <li class="nav-item"><a href="a_dashboard.php">User</a></li>
                <li class="nav-item"><a href="a_company.php">Instansi</a></li>
                <li class="nav-item"><a href="blacklist.php">Blacklist</a></li>
                <li class="nav-item"><a href="profil.php">Administrator</a></li>
                <li class="nav-profil"><img src="img/profil.png" alt="Profile Picture"></li>
                <li class="nav-profil"><img src="img/iconhistory.png" alt="History Icon"></li>
            </ul>
        </div>
    </div>


    <div class="management">
        <h2 class="management-title">Daftar Pengguna yang Diblacklist</h2>
        <table class="user-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                <?php foreach ($blacklist_result as $blacklisted_user) : ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $blacklisted_user["username"]; ?></td>
                    <td><?php echo $blacklisted_user["email"]; ?></td>
                </tr>
                <?php $i++; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <br><br><br><br><br>
    <br><br><br><br><br>
    
    <?php require 'footer.php'?>

</body>
</html>
