<?php 
session_start();

require 'functions.php';

// AMBIL ID dari URL
$id = $_GET["id"];
// var_dump($id);

// query data mahasiswa berdasarkan id nya
$user = query("SELECT * FROM users WHERE id = $id")[0];

if (!$connect) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

if (isset($_POST["submit"])) {
    if (ubah($_POST) > 0) {
        echo "
            <script>
                alert('Data Berhasil Diubah');
                document.location.href = '../a_dashboard.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Data gagal Diubah');
                document.location.href = '../a_dashboard.php';
            </script>
        ";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

    <div class="sign">
        <h1>Update User</h1>
        <br>
        <br>
        <form action="" method="post" enctype="multipart/form-data" >
            <input type="hidden" name="id" value="<?= $user["id"] ?>">
            <ul class="form">
                <li class="form-item">
                    <label for="email">Email : </label>
                    <input type="text" name="email" id="email" value="<?= $user["email"] ?>">
                </li>
                <li class="form-item">
                    <label for="username">Username : </label>
                    <input type="text" name="username" id="username" value="<?= $user["username"] ?>">
                </li>
                <li class="form-item">
                    <label for="password">Password : </label>
                    <input type="password" name="password" id="password" value="<?= $user["password"] ?>">
                </li>
                <li>
                    <button type="submit" name="submit">UBAH DATA</button>
                </li>
            </ul>
    </div>
    </form>

</body>
</html>