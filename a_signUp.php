<?php 
session_start();

$connect = mysqli_connect("localhost", "root", "", "trustbuilder");

if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}

function registrasiadmin($data) {
    global $connect;

    $username = strtolower(trim($data["username"]));
    $email = strtolower(trim($data["email"]));
    $password = mysqli_real_escape_string($connect, $data["password"]);
    $password2 = mysqli_real_escape_string($connect, $data["password2"]);

    // Check if username or email already exists
    $result_username = mysqli_query($connect, "SELECT username FROM admin WHERE username = '$username'");
    $result_email = mysqli_query($connect, "SELECT email FROM admin WHERE email = '$email'");
    if (mysqli_fetch_assoc($result_username)) {
        $_SESSION['error'] = 'Username sudah terdaftar';
        header("Location: registrasiadmin.php");
        exit;
    }
    if (mysqli_fetch_assoc($result_email)) {
        $_SESSION['error'] = 'Email sudah terdaftar';
        header("Location: registrasiadmin.php");
        exit;
    }

    // Check if passwords match
    if ($password !== $password2) {
        $_SESSION['error'] = 'Password tidak sesuai';
        header("Location: registrasiadmin.php");
        exit;
    }

    // Encrypt the password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // Insert into database
    $query = "INSERT INTO admin (username, email, password) VALUES ('$username', '$email', '$password')";
    if (mysqli_query($connect, $query)) {
        return mysqli_affected_rows($connect);
    } else {
        $_SESSION['error'] = 'Gagal mendaftarkan pengguna baru';
        header("Location: registrasiadmin.php");
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['csrf_token']) && hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        registrasiadmin($_POST);
    } else {
        $_SESSION['error'] = 'Token CSRF tidak valid';
        header("Location: registrasiadmin.php");
        exit;
    }
}

// Generate CSRF token
$_SESSION['csrf_token'] = bin2hex(random_bytes(32));
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
        <?php if (isset($_SESSION['error'])): ?>
            <div class="error">
                <?= htmlspecialchars($_SESSION['error']); unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>
        <form action="" method="post">
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']); ?>">
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
                <li class="form-button">
                    <button type="submit" name="registrasi">Registrasi</button>
                </li>
                <li class="account">
                    Have an already account? <a href="a_login.php">Sign In</a>
                </li>
            </ul>
        </form>
    </div>
</body>
</html>
