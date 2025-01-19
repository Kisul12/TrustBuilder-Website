<?php
session_start();
require 'db/functions.php';

// Assuming you have a function to check if the user is logged in and get user details
if (!isset($_SESSION['id_mitra'])) {
    header("Location: login.php");
    exit;
}

$mitra_id = $_SESSION['id_mitra'];

// Connect to the database
$conn = new mysqli('localhost', 'root', '', 'trustbuilder');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch portfolios for the logged-in mitra
$sql = "SELECT id_portofolio, nama_rumah, deskripsi, harga_rumah, gambar_rumah FROM portofolio WHERE id_mitra = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $mitra_id);
$stmt->execute();
$result = $stmt->get_result();

$portfolios = [];
while ($row = $result->fetch_assoc()) {
    $portfolios[] = $row;
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
    <style>
        /* Gaya untuk kontainer tombol portofolio */
        .button-porto-container {
            text-align: center; /* Pusatkan isi kontainer */
            margin-top: 10px; /* Atur margin atas sesuai kebutuhan */
            margin-bottom: 10px;
        }

        /* Gaya untuk tombol portofolio */
        .button-porto-container button {
            padding: 10px 20px; /* Atur padding tombol */
            font-size: 16px; /* Atur ukuran font tombol */
            background-color: #007bff; /* Atur warna latar belakang tombol */
            color: #fff; /* Atur warna teks tombol */
            border: none; /* Hilangkan border */
            border-radius: 5px; /* Tambahkan sudut border */
            cursor: pointer; /* Ganti kursor saat mengarah ke tombol */
            transition: background-color 0.3s ease; /* Efek transisi untuk perubahan warna latar belakang */
        }

        /* Gaya saat mengarahkan kursor ke tombol portofolio */
        .button-porto-container button:hover {
            background-color: #0056b3; /* Ubah warna latar belakang saat mengarahkan kursor */
        }

        .edit-btn a {
            color: #fff;
            text-decoration: none;
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
                <li class="nav-item"><a href="m_portofolio.php">Portofolio</a></li>
                <li class="nav-item"><a href="m_confirm.php">Confirm</a></li>
                <li class="nav-item"><a href="m_schedule.php">Schedule</a></li>
                <li class="nav-item"><a href="profil.php"><?php echo $_SESSION["username"]; ?></a></li>
                <li class="nav-profil"><img src="<?php echo $_SESSION['gambar']; ?>" alt="Profile Picture"></li>
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

    <?php foreach ($portfolios as $portfolio): ?>
    <div class="house-container">
        <div class="house-box">
            <div class="house-image">
                <img src="uploads/<?php echo $portfolio['gambar_rumah']; ?>" alt="Foto Rumah">
            </div>
            <div class="house-details">
                <h2><?php echo $portfolio['nama_rumah']; ?></h2>
                <p><?php echo $portfolio['deskripsi']; ?></p>
                <p><strong>Harga Rumah:</strong> <?php echo $portfolio['harga_rumah']; ?></p>
                <button class="edit-btn">
                    <a href="m_editPorto.php?id_porto=<?php echo $portfolio['id_portofolio']; ?>">Edit</a>
                </button>
            </div>
        </div>
    </div>
    <?php endforeach; ?>

    <div class="button-porto-container">
        <form action="m_portofolio.php" method="GET">
            <button type="submit">Tambah Portofolio</button>
        </form>
    </div>

    <?php require 'footer.php'; ?>
</body>
</html>
