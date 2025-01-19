<?php 
require ('db/functions.php');

if (isset($_POST['registrasi'])) {
    if (registrasi($_POST) > 0) {
        echo "<script src='js/script.js'></script>"; 
        echo "<script>
                alert('user baru ditambahkan');
            </script>";
    } else {
        echo 'user gagal ditambahkan';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Registrasi</title>
    <link rel="stylesheet" href="css/style.css">
    <link href='https://fonts.googleapis.com/css?family=Merriweather' rel='stylesheet'>
</head>
<body>
    <div class="sign">
        <h1>Sign Up</h1>
        <p class="desc1">Welcome To Build Trust</p>
        <p class="desc2">The most trust building home platform</p>
        <form action="" method="post">
            <ul class="form">
                <li class="form-item">
                    <label for="username">Enter Your Username</label>
                    <input type="text" name="username" id="username" required>
                </li>
                <li class="form-item">
                    <label for="email">Enter Your Email</label>
                    <input type="email" name="email" id="email" required>
                </li>
                <li class="form-item">
                    <label for="password">Enter Your Password</label>
                    <input type="password" name="password" id="password" required>
                </li>
                <li class="form-item">
                    <label for="password2">Confirm Your Password</label>
                    <input type="password" name="password2" id="password2" required>
                </li>
                <li class="form-item">
                    <label for="role">Sign Up As:</label>
                    <select name="role" id="role" required>
                        <option value="users">User</option>
                        <option value="mitra">Mitra</option>
                    </select>
                </li>
                <li class="form-button">
                    <button type="submit" name="registrasi">Registrasi</button>
                </li>
                <li class="account">
                    Have an already account? <a href="login.php">Sign In</a>
                </li>
            </ul>
        </form>
    </div>
</body>
</html>
