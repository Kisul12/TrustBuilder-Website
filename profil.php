<?php
session_start();
require 'db/functions.php';

// AMBIL ID dari session
$id = $_SESSION["id_mitra"]; // Pastikan $_SESSION["id_mitra"] sudah diatur sebelumnya

// Query data pengguna berdasarkan perannya
if ($_SESSION["role"] == "mitra") {
    $user = query("SELECT * FROM mitra WHERE id = $id")[0];
} else {
    $user = query("SELECT * FROM users WHERE id = $id")[0];
}

if (isset($_POST["submit"])) { // Pastikan formulir telah disubmit
    $gambar = $user['gambar']; // Default gambar saat ini

    // Proses pengunggahan gambar
    if (!empty($_FILES["profile_image"]["name"])) {
        $targetDir = "uploads/"; // Pastikan direktori tempat menyimpan gambar sudah ada dan memiliki izin untuk menulis
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true); // Buat direktori jika belum ada
        }

        $fileName = basename($_FILES["profile_image"]["name"]);
        $targetFilePath = $targetDir . time() . "_" . $fileName; // Beri nama file yang unik
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); // Dapatkan tipe file

        // Memeriksa apakah file yang diunggah adalah gambar
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
        if (in_array($fileType, $allowTypes)) {
            // Memeriksa ukuran file
            if ($_FILES["profile_image"]["size"] <= 2000000) { // Maksimum 2MB
                // Memindahkan gambar ke direktori yang ditentukan
                if (move_uploaded_file($_FILES["profile_image"]["tmp_name"], $targetFilePath)) {
                    // Hapus gambar lama jika ada
                    if (!empty($user['gambar']) && file_exists($user['gambar'])) {
                        unlink($user['gambar']);
                    }
                    $gambar = $targetFilePath;
                } else {
                    echo "Maaf, terjadi kesalahan saat mengunggah gambar.";
                }
            } else {
                echo "Maaf, ukuran file terlalu besar. Maksimum 2MB.";
            }
        } else {
            echo "Maaf, hanya file gambar JPG, JPEG, PNG, dan GIF yang diizinkan.";
        }
    }

    // Proses penyimpanan data pengguna
    if (ubah($_POST, $gambar) > 0) { // Periksa apakah fungsi ubah($user) berjalan dengan benar
        $_SESSION["username"] = $_POST["username"];
        $_SESSION["gambar"] = $gambar;

        echo "
            <script>
                alert('Data Berhasil Diubah');
                document.location.href = '../a_dashboard.php';
            </script>
        ";

        if ($_SESSION["role"] == "users") {
            header("Location: ./u_dashboard.php?error=update_success");
        } elseif ($_SESSION["role"] == "mitra") {
            header("Location: ./m_dashboard.php?error=update_success");
        }
    } else {
        echo "
            <script>
                alert('Data gagal Diubah');
                document.location.href = '../a_dashboard.php';
            </script>
        ";
        if ($_SESSION["role"] == "users") {
            header("Location: ./u_dashboard.php?error=update_failed");
        } elseif ($_SESSION["role"] == "mitra") {
            header("Location: ./m_dashboard.php?error=update_failed");
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile Settings</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .profile-image {
            text-align: center;
            margin-bottom: 20px;
        }
        .profile-image img {
            border-radius: 50%;
            width: 100px;
            height: 100px;
            display: block;
            margin: 0 auto;
        }
        .profile-image button {
            margin-top: 10px;
            padding: 10px 20px;
            background-color: #f06445;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .profile-image button:hover {
            background-color: #d0523a;
        }
        .profile-image a {
            display: block;
            margin-top: 10px;
            color: #f06445;
            cursor: pointer;
            text-decoration: none;
        }
        .profile-settings label {
            display: block;
            margin: 10px 0 5px;
        }
        .profile-settings input {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            display: block;
        }
        .profile-settings .form-actions {
            text-align: right;
        }
        .profile-settings .form-actions button {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            color: white;
            transition: background-color 0.3s;
        }
        .profile-settings .form-actions .save-btn {
            background-color: #f06445;
        }
        .profile-settings .form-actions .cancel-btn {
            background-color: #6c757d;
            margin-right: 10px;
        }
        .profile-settings .form-actions .save-btn:hover {
            background-color: #d0523a;
        }
        .profile-settings .form-actions .cancel-btn:hover {
            background-color: #5a6268;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="profile-image">
            <img src="<?= $user['gambar'] ?? 'https://via.placeholder.com/100' ?>" alt="Profile Image">
            <button onclick="document.getElementById('profile-image-input').click();">Upload new photo</button>
        </div>

        <form action="" method="post" class="profile-settings" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $user["id"] ?>">
            <input type="file" id="profile-image-input" name="profile_image" style="display: none;">
            <label for="username">New Username</label>
            <input type="text" name="username" id="username" value="<?= $user["username"] ?>">
            
            <label for="email">New E-mail</label>
            <input type="email" name="email" id="email" value="<?= $user["email"] ?>">
            
            <label for="new-password">New Password</label>
            <input type="password" name="password" id="new-password" value="<?= $user["password"] ?>">
            
            <div class="form-actions">
                <button type="button" class="cancel-btn">Cancel</button>
                <button name="submit" type="submit" class="save-btn">Save changes</button>
            </div>
        </form>
    </div>
</body>
</html>
