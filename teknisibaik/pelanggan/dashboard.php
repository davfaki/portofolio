<?php

// CEK SESSION APAKAH SUDAH LOGIN ATAU BELUM
session_start();
if (!isset($_SESSION['loginpelanggan'])) {
	header("Location: loginpelanggan.php");
	exit;

}

// MENGAMBIL NAMA DARI USER
$user = $_SESSION['userpelanggan'];

// Ambil tipe perbaikan dari database
require '../function.php';
$tipeperbaikan = getAllTipePerbaikan();



?>
<!doctype html>

<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- css costum -->
    <link rel="stylesheet" href="../style.css" />

    <title>Dashboard Pelanggan</title>
  </head>
  <body>
    <!-- navbar -->
        
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="../index.html">Teknisi Baik</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="dashboard.php">Beranda</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="order.php">Order</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="history.php">History</a>
            </li>
          </ul>
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link active" href=""><?= $user; ?></a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="logout.php">Logout</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- Akhir Navbar -->

    <!-- Menu Pelanggan -->

    <section class="mt-5 pt-5 mb-5">
      <div class="container">
        <div class="row">
          <div class="col">
            <h2>Pilih Jenis Perbaikan</h2>
            <hr>
          </div>
        </div>
        <div class="row">
          <?php foreach($tipeperbaikan as $tp): ?>
            <div class="col-md-3 mb-4 text-center">
              <a href="order.php?layanan=<?= urlencode($tp['nama']); ?>">
                <?php 
                  $imgPath = !empty($tp['icon']) ? "../img/" . $tp['icon'] : "../img/teknisiruli.png";
                ?>
                <img src="<?= $imgPath; ?>" alt="<?= htmlspecialchars($tp['nama']); ?>" style="max-width:100px;max-height:100px;">
              </a>
              <p class="mt-2"><?= htmlspecialchars($tp['nama']); ?></p>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </section>

    <!-- akhir menu pelanggan-->
   
   



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  </body>
</html>