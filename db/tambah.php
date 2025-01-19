<?php 

require 'functions.php';

if (!$connect) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

if (isset($_POST["submit"])) {
    
    // var_dump($_POST); die;

    if (tambah($_POST) > 0) {
        echo "
            <script>
                alert('Data Berhasil Ditambahkan');
                document.location.href = 'a_dashboard.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Data gagal Ditambahkan');
                document.location.href = 'a_dashboard.php';
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
    <title>Tambah data Mahasiswa</title>
</head>
<body>
    <h1>TAMBAH DATA Mahasiswa</h1>

    <form action="" method="post" enctype="multipart/form-data">
        <ul>
            <li>
                <label for="email">Email : </label>
                <input type="text" name="email" id="email">
            </li>
            <li>
                <label for="username">Username : </label>
                <input type="text" name="username" id="username">
            </li>
            <li>
                <label for="password">Password : </label>
                <input type="password" name="password" id="password">
            </li>

            <li>
                <label for="gambar">Password : </label>
                <input type="file" name="gambar" id="gambar">
            </li>

            <li>
                <button type="submit" name="submit">TAMBAH DATA</button>
            </li>
        </ul>
    </form>

</body>
</html>
