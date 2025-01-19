<?php 
session_start();
require 'db/functions.php';

// Fetch mitra data from the database
$companies = query("SELECT mitra.id, mitra.username, mitra.gambar, COUNT(portofolio.id_portofolio) AS total_portofolio FROM mitra LEFT JOIN portofolio ON mitra.id = portofolio.id_mitra GROUP BY mitra.id");

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

    <div class="company-container">
    <?php if (!empty($companies)): ?>
        <?php foreach ($companies as $company): ?>
            <div class="company-box">
                <div class="company-content">
                    <h2><?= htmlspecialchars($company['username']) ?></h2>
                    <p>Total Portofolio: <?= $company['total_portofolio'] ?></p> <!-- Tampilkan total portofolio -->
                </div>
                <div class="company-logo">
                    <?php 
                    $imagePath = '' . htmlspecialchars($company['gambar']);
                    if (file_exists($imagePath)) {
                        echo "<img src='$imagePath' alt='Logo " . htmlspecialchars($company['username']) . "'>";
                    } else {
                        echo "<p>Image not found: $imagePath</p>"; // Debugging statement
                    }
                    ?>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No companies found.</p>
    <?php endif; ?>
    </div>  
</div>

    <?php require 'footer.php'?>
</body>
</html>
