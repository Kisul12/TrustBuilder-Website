<?php 
session_start();
require 'db/functions.php';

$connect = mysqli_connect("localhost", "root", "", "trustbuilder");

// Fetch properties from the portofolio table
$properties = query("SELECT id_portofolio, nama_rumah, gambar_rumah, deskripsi FROM portofolio");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>

    <style>
        .property-recommendations {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        }

        .property-item {
            flex: 1 0 calc(20% - 10px); /* Mengatur agar 4 properti memenuhi satu baris dan ada margin di antara properti */
            margin: 5px; 
            position: relative;
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .property-item img {
            width: 100%;
            height: auto;
        }

        .property-item:hover {
            transform: scale(0.95);
        }
    </style>
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
                
                <li class="nav-profil"><img src="<?php echo $_SESSION['gambar']; ?>" alt="Profile Picture"></li>
                <li class="nav-profil"><a href="db/logout.php"><img src="img/iconlogout.png" alt="Logout"></a></li>

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

    <div class="property-recommendations">
    <?php foreach ($properties as $property): ?>
        <a href="dproduk.php?id=<?php echo $property['id_portofolio']; ?>" class="property-item">
            <img src="uploads/<?php echo $property['gambar_rumah']; ?>" alt="<?php echo $property['nama_rumah']; ?>">
            <div class="property-info">
                <h3><?php echo $property['nama_rumah']; ?></h3>
                <p><?php echo substr($property['deskripsi'], 0, 100) . '...'; ?></p>
            </div>
        </a>
    <?php endforeach; ?>
</div>



    <?php require 'footer.php'?>
</body>
</html>