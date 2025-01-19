<?php 

require 'functions.php';

$id = $_GET ["id"];

if (hapus($id) > 0) {
    echo "
    <script>
        alert('Data Berhasil Dihapus');
        document.location.href = 'a_dashboard.php';
    </script>";
} else {
    echo "
    <script>
        alert('Data gagal dihapus');
        document.location.href = 'a_dashboard.php';
    </script>";
} 

?>