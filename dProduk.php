<?php 
session_start();
require 'db/functions.php';

$connect = mysqli_connect("localhost", "root", "", "trustbuilder");

$id = $_GET['id'];

// Fetch property details based on the ID
$property = query("SELECT * FROM portofolio WHERE id_portofolio = $id")[0];

// Function to clean and format the price
function clean_number($string) {
    // Remove any character that is not a digit
    return preg_replace('/\D/', '', $string);
}

// Clean the harga_rumah to ensure it's a valid number
$cleaned_harga = clean_number($property['harga_rumah']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $property['nama_rumah']; ?></title>
    <link rel="stylesheet" href="css/d_style.css">
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

    <div class="d_produk">
        <div class="produk_container1">
            <div class="produk_container-left">
                <img src="uploads/<?php echo $property['gambar_rumah']; ?>" alt="">
            </div>
            <div class="produk_container-right">
                <a href="company.php?id=<?php echo $property['id_portofolio']; ?>">
                    <img src="uploads/<?php echo $property['gambar_rumah']; ?>" alt="">
                </a>
                <a href="company.php?id=<?php echo $property['id_portofolio']; ?>">
                    <img src="uploads/<?php echo $property['gambar_rumah']; ?>" alt="">
                </a>
            </div>
        </div>

        <div class="produk_container2">
            <div class="produk_container2-left">
                <div class="produk_container2-left-header">
                    <h1><?php echo $property['nama_rumah']; ?></h1>
                    <p>(4 ulasan)</p>
                </div>
                
                <div class="produk_container2-left-price">
                    <h1>Rp <?php echo number_format($cleaned_harga, 0, ',', '.'); ?></h1>
                    <a href="u_registration.php" class="produk_container2-left-price">Contact</a>
                </div>
                
                <div class="produk_container2-left-description">
                    <h4>Deskripsi</h4>
                    <p><?php echo $property['deskripsi']; ?></p>
                </div>
                <hr>
            </div>
        </div>
    </div>

    <?php require 'footer.php' ?>
</body>
</html>