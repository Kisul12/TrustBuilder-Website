<?php
session_start();
require 'db/functions.php';

if (!isset($_SESSION['id_mitra'])) {
    echo "<script>
            alert('Anda harus login sebagai mitra untuk menambah portofolio');
            document.location.href = 'login.php';
          </script>";
    exit;
}

if (isset($_POST['submit'])) {
    if (tambahPortofolio($_POST) > 0) {
        echo "<script>
                alert('Data portofolio berhasil ditambahkan!');
                document.location.href = 'm_dashboard.php';
              </script>";
    } else {
        echo "<script>
                alert('Data portofolio gagal ditambahkan!');
              </script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Portofolio</title>
    <link rel="stylesheet" href="css/porto_style.css">
    <link rel="stylesheet" href="css/style.css">
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
            <li class="nav-item"><a href="m_dashboard.php">Portofolio</a></li>
            <li class="nav-item"><a href="m_confirm.php">Confirm</a></li>
            <li class="nav-item"><a href="m_schedule.php">Schedule</a></li>
            <li class="nav-item"><a href="profil.php"><?php echo $_SESSION["username"]; ?></a></li>
            <li class="nav-profil"><img src="img/profil.png" alt="Profile Picture"></li>
            <li class="nav-profil"><img src="img/iconhistory.png" alt="History Icon"></li>
        </ul>
    </div>
</div>

<form action="" method="POST" enctype="multipart/form-data">
    <ul class="form">
        <li>
            <label for="nama">Nama Rumah</label>
            <input type="text" name="nama" id="nama" required>
        </li>
        <li>
            <label for="harga">Harga Rumah</label>
            <input type="text" name="harga" id="harga" required>
        </li>
        <li>
            <label for="kontak">Kontak</label>
            <input type="text" name="kontak" id="kontak" required>
        </li>
        <li>
            <label for="deskripsi">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" cols="30" rows="10" required></textarea>
        </li>
        <li>
            <label for="gambar">Gambar</label>
            <input type="file" name="gambar" id="gambar" required>
        </li>
        <li>
            <button type="submit" name="submit">Simpan</button>
        </li>
    </ul>
</form>

<?php require 'footer.php'; ?>
</body>
</html>