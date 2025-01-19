<?php 

require 'functions.php';

$id = $_GET ["id"];

if (blacklist($id) > 0) {
    echo "
    <script>
        alert('User Berhasil Diblacklist');
        document.location.href = '../a_dashboard.php';
    </script>";
} else {
    echo "
    <script>
        alert(' User gagal diblacklist');
        document.location.href = '../a_dashboard.php';
    </script>";
}

?>