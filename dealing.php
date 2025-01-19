<?php 
    session_start();
    
    require 'db/functions.php';

    $result = query("SELECT * FROM users");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company</title>
    <link rel="stylesheet" href="css/d_style.css">
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
</head>

<body>
<div class="header">
        <div class="header-left">
            <div class="header-logo">
                <img src="img/logo.png" alt="Logo">
            </div> 
            <div class="header-title">
                <h1>Trust Build</h1>
            </div>
        </div>

         <div class="navbar">
            <ul class="nav-list">
                <li class="nav-item"><a href="u_dashboard.php">Home</a></li>
                <li class="nav-item"><a href="u_company.php">Company</a></li>
                <li class="nav-item"><a href="information.php">Information</a></li>
                <li class="nav-item"><a href="profil.php"><?php echo $_SESSION["username"]; ?></a></li>
                <li class="nav-profil"><img src="img/profil.png" alt=""></li>
                <li class="nav-profil"><img src="img/iconhistory.png" alt=""></li>
            </ul>
        </div>
    </div>

    <main class="content">
        <div class="d_produk">
            <div class="produk_container1">
                <div class="produk_container-left">
                    <img src="img/detailrumah.png" alt="">
                </div>

                <div class="produk_container-right">
                    <img src="img/detailrumah.png" alt="">
                    <img src="img/detailrumah.png" alt="">
                </div>
            </div>

            <div class="waiting">
                <p>Succesfull</p>
            </div>

            <div class="tanggal">
                <div class="tanggal-left">
                    <!-- Kalender -->
                    <div class="calendar">
                        <div class="month">
                            <h2>Mei 2024</h2>
                        </div>
                        <div class="weekdays">
                            <div>Sun</div>
                            <div>Mon</div>
                            <div>Tue</div>
                            <div>Wed</div>
                            <div>Thu</div>
                            <div>Fri</div>
                            <div>Sat</div>
                        </div>
                        <div class="days">
                            <!-- Isi tanggalan -->
                            <div>1</div>
                            <div>2</div>
                            <div>3</div>
                            <div>4</div>
                            <div>5</div>
                            <div>6</div>
                            <div>7</div>
                            <div>8</div>
                            <div>9</div>
                            <div>10</div>
                            <div>11</div>
                            <div>12</div>
                            <div>13</div>
                            <div>14</div>
                            <div>15</div>
                            <div>16</div>
                            <div>17</div>
                            <div>18</div>
                            <div>19</div>
                            <div>20</div>
                            <div>21</div>
                            <div>22</div>
                            <div>23</div>
                            <div>24</div>
                            <div>25</div>
                            <div>26</div>
                            <div>27</div>
                            <div>28</div>
                            <div>29</div>
                            <div>30</div>
                            <div>31</div>
                        </div>
                    </div>
                </div>

                <div class="tanggal-right">
                    <!-- Deskripsi / Jadwal -->
                    <div class="description">
                        <h2>Deskripsi</h2>
                        <div class="event" data-date="1">
                            <h3>1 Mei 2024: </h3>
                            <p>Meeting design dan pencarian lokasi yang sesuai dengan jenis rumah yang dirancang </p>
                        </div>
                        <div class="event" data-date="15">
                            <h3>15 Mei 2024:</h3>
                            <p>Pembelian bahan bangunan</p>
                        </div>
                        <!-- Tambahkan deskripsi/jadwal lainnya sesuai kebutuhan -->
                    </div>

                    <div class="pelunasan">
                        <p>Pelunasan | Rp 149.000.000</p>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php require 'footer.php'?>
</body>
</html>