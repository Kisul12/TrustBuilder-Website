<?php
session_start();
require 'db/functions.php';

if (!isset($_SESSION['id_mitra'])) {
    echo "<script>
            alert('Anda harus login sebagai mitra untuk mengedit portofolio');
            document.location.href = 'login.php';
          </script>";
    exit;
}

// Ambil ID portofolio dari URL
$id_porto = isset($_GET['id_porto']) ? $_GET['id_porto'] : null;
if ($id_porto === null) {
    exit("ID portofolio tidak ditemukan dalam URL.");
}

// Ambil data portofolio dari database
$conn = new mysqli('localhost', 'root', '', 'trustbuilder');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM portofolio WHERE id_portofolio = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_porto);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    exit("Portofolio tidak ditemukan.");
}

$portofolio = $result->fetch_assoc();

$stmt->close();
$conn->close();

if (isset($_POST['submit'])) {
    if (updatePortofolio($_POST) > 0) {
        echo "<script>
                alert('Data portofolio berhasil diubah!');
                document.location.href = 'm_dashboard.php';
              </script>";
    } else {
        echo "<script>
                alert('Data portofolio gagal diubah!');
              </script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Portofolio</title>
    <link rel="stylesheet" href="css/porto_style.css">
</head>
<body>

<div class="header">
    <!-- Bagian header di sini -->
</div>

<h1 class="title">Edit Portofolio</h1>

<form action="" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $portofolio['id_portofolio'] ?>">
    <input type="hidden" name="gambarLama" value="<?= $portofolio['gambar_rumah'] ?>">
    <ul class="form">
        <li>
            <label for="nama">Nama Rumah</label>
            <input type="text" name="nama" id="nama" value="<?= $portofolio['nama_rumah'] ?>" required>
        </li>
        <li>
            <label for="harga">Harga Rumah</label>
            <input type="text" name="harga" id="harga" value="<?= $portofolio['harga_rumah'] ?>" required>
        </li>
        <li>
            <label for="kontak">Kontak</label>
            <input type="text" name="kontak" id="kontak" value="<?= $portofolio['kontak'] ?>" required>
        </li>
        <li>
            <label for="deskripsi">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" cols="30" rows="10" required><?= $portofolio['deskripsi'] ?></textarea>
        </li>
        <li>
            <label for="gambar">Gambar</label>
            <input type="file" name="gambar" id="gambar">
            <img src="uploads/<?= $portofolio['gambar_rumah'] ?>" width="100" alt="Gambar Rumah">
        </li>
        <li>
            <button type="submit" name="submit">Simpan</button>
        </li>
    </ul>
</form>

</body>
</html>