<?php 

$connect = mysqli_connect("localhost", "root", "", "trustbuilder");

function query($query) {
    global $connect;
    $result = mysqli_query($connect, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}


function tambahPortofolio($data) {
    global $connect;

    $id_mitra = $_SESSION['id_mitra'];  // Assumes the mitra's ID is stored in the session
    $nama_rumah = htmlspecialchars($data["nama"]);
    $harga_rumah = htmlspecialchars($data["harga"]);
    $kontak = htmlspecialchars($data["kontak"]);
    $deskripsi = htmlspecialchars($data["deskripsi"]);
    
    // Upload gambar
    $gambar = upload();
    if (!$gambar) {
        return false;
    }

    $query = "INSERT INTO portofolio (id_mitra, nama_rumah, harga_rumah, kontak, deskripsi, gambar_rumah) VALUES ('$id_mitra', '$nama_rumah', '$harga_rumah', '$kontak', '$deskripsi', '$gambar')";
    mysqli_query($connect, $query);

    return mysqli_affected_rows($connect);
}

function upload() {
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    if ($error === 4) {
        echo "<script>
                alert('pilih gambar terlebih dahulu');
              </script>";
        return false;
    }

    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>
                alert('yang anda upload bukan gambar');
              </script>";
        return false;
    }

    if ($ukuranFile > 1000000) {
        echo "<script>
                alert('ukuran gambar terlalu besar');
              </script>";
        return false;
    }

    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    move_uploaded_file($tmpName, 'uploads/' . $namaFileBaru);

    return $namaFileBaru;   
}


function hapus ($id) {
    global $connect;

    mysqli_query($connect, "DELETE FROM users WHERE id = $id");
    return mysqli_affected_rows($connect);
}

function ubah($data, $gambar) {
    global $connect;

    $id = htmlspecialchars($data["id"]);  
    $email = htmlspecialchars($data["email"]);
    $username = htmlspecialchars($data["username"]);
    $password = htmlspecialchars($data["password"]);

    // Fetch the current password from the database
    if ($_SESSION["role"] == "mitra") {
        $currentUser = query("SELECT password FROM mitra WHERE id = $id")[0];
    } else {
        $currentUser = query("SELECT password FROM users WHERE id = $id")[0];
    }

    // Check if the password has been changed
    if (!empty($password) && $password !== $currentUser['password']) {
        // Hash the password
        $password = password_hash($password, PASSWORD_DEFAULT);
    } else {
        // If the password is the same, don't change it
        $password = $currentUser['password'];
    }

    if ($_SESSION["role"] == "mitra") {
        $query = "UPDATE mitra SET email = '$email', username = '$username', password = '$password', gambar = '$gambar' WHERE id = $id";
    } else {
        $query = "UPDATE users SET email = '$email', username = '$username', password = '$password', gambar = '$gambar' WHERE id = $id";
    }

    mysqli_query($connect, $query);

    return mysqli_affected_rows($connect);
}


    
// $gambarLama = $data["gambarLama"];

// check apakah user pilih gambar baru atau tidak
// if ($_FILES['gambar']['error'] === 4) {
//     $gambar = $gambarLama;
// } else {
//     $gambar = upload();
// }

function cari ($keyword) {
    $query = "SELECT * FROM users WHERE 
        email LIKE '%$keyword%' 
        OR 
        username LIKE '%$keyword%'";
    return query($query);
}

function registrasi($data) {
    global $connect;

    $username = strtolower(stripslashes($data["username"]));
    $email = strtolower(stripslashes($data["email"]));
    $password = mysqli_real_escape_string($connect, $data["password"]);
    $password2 = mysqli_real_escape_string($connect, $data["password2"]);
    $role = strtolower(stripslashes($data["role"]));

    // Validate role input
    $allowed_roles = ['users', 'mitra'];
    if (!in_array($role, $allowed_roles)) {
        echo "<script>
                alert('Role tidak valid');
                document.location.href = 'signUp.php';
              </script>";
        return false;
    }

    // Check if username or email already exists
    $result_username = mysqli_query($connect, "SELECT username FROM $role WHERE username = '$username'");
    $result_email = mysqli_query($connect, "SELECT email FROM $role WHERE email = '$email'");
    if (mysqli_fetch_assoc($result_username)) {
        echo "<script>
                alert('Username sudah terdaftar');
                document.location.href = 'signUp.php';
              </script>";
        return false;
    }
    if (mysqli_fetch_assoc($result_email)) {
        echo "<script>
                alert('Email sudah terdaftar');
                document.location.href = 'signUp.php';
              </script>";
        return false;
    }

    // Check if passwords match
    if ($password !== $password2) {
        echo "<script>
                alert('Password tidak sesuai');
                document.location.href = 'signUp.php';
              </script>";
        return false;
    }

    // Encrypt the password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // Insert into database
    $query = "INSERT INTO $role (username, email, password) VALUES ('$username', '$email', '$password')";
    mysqli_query($connect, $query);

    return mysqli_affected_rows($connect);
}

function blacklist($id) {
    global $connect;

    // Cek apakah user dengan ID yang diberikan ada di tabel users
    $result_user = mysqli_query($connect, "SELECT * FROM users WHERE id = $id");
    if (mysqli_num_rows($result_user) > 0) {
        // Cek apakah user sudah ada di tabel blacklist
        $result_blacklist = mysqli_query($connect, "SELECT * FROM blacklist WHERE id_user = $id");
        if (mysqli_num_rows($result_blacklist) >= 1) {
            echo "<script>alert('User sudah pernah di-blacklist.');</script>";
            return false; 
        }

        // User ditemukan dan belum di-blacklist dua kali, masukkan ke tabel blacklist
        $query = "INSERT INTO blacklist (id_user) VALUES ('$id')";
        mysqli_query($connect, $query);

        if (mysqli_affected_rows($connect) > 0) {
            // echo "<script>alert('User berhasil di-blacklist.');</script>";
            return true; // User berhasil di-blacklist
        } else {
            return false; // Gagal melakukan blacklist
        }
    } else {
        echo "<script>alert('User tidak ditemukan.');</script>";
        return false; // User tidak ditemukan
    }
}

function updatePortofolio($data) {
    $id = $data["id"];
    $nama_rumah = $data["nama"];
    $harga_rumah = $data["harga"];
    $kontak = $data["kontak"];
    $deskripsi = $data["deskripsi"];

    // Upload gambar jika ada
    $gambar = $data["gambarLama"];
    if ($_FILES['gambar']['error'] === 0) {
        $gambar = upload();
    }

    // Update data portofolio dalam database
    $conn = new mysqli('localhost', 'root', '', 'trustbuilder');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "UPDATE portofolio SET nama_rumah = ?, harga_rumah = ?, kontak = ?, deskripsi = ?, gambar_rumah = ? WHERE id_portofolio = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $nama_rumah, $harga_rumah, $kontak, $deskripsi, $gambar, $id);
    $stmt->execute();

    $stmt->close();
    $conn->close();

    return true;
}
?>