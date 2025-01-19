<?php 
require 'db/functions.php';

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare the query to check the correct table based on role
    $stmt = mysqli_prepare($connect, "SELECT * FROM admin WHERE username = ?");
    mysqli_stmt_bind_param($stmt, 's', $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Check username
    if (mysqli_num_rows($result) === 1) {
        // Check password
        $row = mysqli_fetch_assoc($result);

        if (password_verify($password, $row["password"])) {
            header("Location: a_dashboard.php");
            exit;
        } else {
            $error = true;
        }
    } else {
        $error = true;
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
    <link rel="stylesheet" href="css/style.css">
    <link href='https://fonts.googleapis.com/css?family=Merriweather' rel='stylesheet'>
</head>
<body>
    <?php if ( isset($eror) ): ?>
        <p> Kata Sandi atau Password anda salah  </p>
    <?php endif; ?>

    <div class="sign">
        <h1>Sign In</h1>
        <p class="desc1">Welcome To Build Trust</p>
        <p class="desc2">The most trust building home platform</p>
        <form action="" method="post">
        <form action="" method="post">
            <ul class="form">
                <li class="form-item">
                    <label for="username">Username : </label>
                    <input type="text" name="username" id="username">
                </li>
                <li class="form-item">
                    <label for="password">Password : </label>
                    <input type="password" name="password" id="password">
                </li>
                <li class="form-button">
                    <button type="submit" name="login">Login</button>
                </li>
                <li class="account">
                    Don't have an already account? <a href="signUp.php" style="color: #145990;">Sign Up</a>
                </li>
            </ul>
        </form>
    </div>

</body>
</html>