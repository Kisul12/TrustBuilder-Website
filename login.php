<?php 
session_start();
require 'db/functions.php';

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $table = ($role === 'users') ? 'users' : 'mitra';

    // Prevent SQL injection
    $username = mysqli_real_escape_string($connect, $username);

    $result = mysqli_query($connect, "SELECT * FROM $table WHERE username = '$username'");

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row["password"])) {
            $_SESSION["username"] = $username;
            $_SESSION["role"] = $role;
            $_SESSION["id_mitra"] = $row["id"]; // Store the mitra ID in the session
            $_SESSION["gambar"] = $row["gambar"];

            if ($role == 'users') {
                header("Location: u_dashboard.php");
            } elseif ($role == 'mitra') {
                header("Location: m_dashboard.php");
            }
            exit;
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "Invalid username.";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
    <link rel="stylesheet" href="css/style.css">
    <link href='https://fonts.googleapis.com/css?family=Merriweather' rel='stylesheet'>
</head>
<body>
    <?php if (isset($error)): ?>
        <p><?php echo $error; ?></p>
    <?php endif; ?>

    <div class="sign">
        <h1>Sign In</h1>
        <p class="desc1">Welcome To Build Trust</p>
        <p class="desc2">The most trust building home platform</p>
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
                <li class="form-item">
                    <label for="role">Sign Up As:</label>
                    <select name="role" id="role" required>
                        <option value="users">User</option>
                        <option value="mitra">Mitra</option>
                    </select>
                </li>
                <li class="form-button">
                    <button type="submit" name="login">Login</button>
                </li>
                <li class="account">
                    Don't have an account yet? <a href="signUp.php" style="color: #145990;">Sign Up</a>
                </li>
            </ul>
        </form>
    </div>
</body>
</html>
