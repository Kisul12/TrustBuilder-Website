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

    <div class="search">
        <div class="search_box">
            <input type="text" class="input" placeholder="search...">
            <div class="btn btn_common">
                <i class="fas fa-search"></i>
            </div>
        </div>
    </div>

    <div class="management">
        <table class="user-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                <?php foreach ($result as $users) : ?>

                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $users["username"]; ?></td>
                    <td><?php echo $users["email"]; ?></td>
                    <td>
                        <button class="edit-btn-mana">
                            <a href="db/update.php?id=<?php echo $users["id"]; ?>">Ubah</a>
                        </button>

                        <button class="delete-btn-mana">
                            <a href="db/hapus.php?id=<?php echo $users["id"]; ?>">hapus</a>
                        </button>

                        <button class="delete-btn-mana">
                            <a href="db/api_blacklist.php?id=<?php echo $users["id"]; ?>">Blacklist</a>
                        </button>
                    </td>
                </tr>
            </tbody>
            <?php $i++; ?>
            <?php endforeach; ?>
        </table>
    </div>

    
    <?php require 'footer.php'?>

</body>
</html>