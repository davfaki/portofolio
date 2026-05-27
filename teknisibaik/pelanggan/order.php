<?php 

session_start();
if (!isset($_SESSION['loginpelanggan'])) {
  header("Location: loginpelanggan.php");
  exit;
}

// MENGAMBIL NAMA USER
$user = $_SESSION['userpelanggan'];

// MENGAMBIL LAYANAN
$layananPerbaikan = $_GET['layanan'];

// MENGHUBUNGKAN KE FILE FUNCTION
require '../function.php';

// AMBIL DATA HARGA DARI DATABASE BERDASARKAN LAYANAN
$hargaPerbaikan = query("SELECT harga FROM tipeperbaikan WHERE nama = '$layananPerbaikan'");
$harga = $hargaPerbaikan ? $hargaPerbaikan[0]['harga'] : 0;

// CEK APAKAH TOMBOL KIRIM SUDAH DI TEKAN ATAU BELUM
if ( isset($_POST['kirim'])) {
  // cek apakah data berhasil di tambahkan atau tidak
  if( order($_POST) > 0  ) {
    echo "
      <script>
      alert('Permintaan berhasil dikirim');
      document.location.href = 'history.php';
      </script>
    ";
  } else {
    echo "
    <script>
      alert('Permintaan gagal dikirim');
      document.location.href = 'history.php';
    </script>
    ";
  }
}

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- css costum -->
    <link rel="stylesheet" href="../style.css" />

    <title>Halaman Order</title>
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
  
    <!-- form order -->

  <section class="Order mb-4">
      <div class="container">
        <div class="row">
          <div class="col mt-5 pt-3">
            <h2>Form Permintaan Perbaikan</h2>
            <hr>
          </div>
        </div>
        <div class="row g-3">
          <div class="col-md-6">
            <form action="" method="post">
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" name="nama" class="form-control" id="nama" value="<?= $user; ?>" placeholder="<?= $user ?>" readonly>
                </div>
                <div class="mb-3">
                    <label for="hp" class="form-label">No. HP</label>
                    <input type="text" name="hp" class="form-control" id="hp" required>
                </div>
                <div class="mb-3">
                    <label for="layananPerbaikan" class="form-label">Layanan Perbaikan</label>
                    <input class="form-control" name="layananPerbaikan" value="<?= $layananPerbaikan ?>" type="text" placeholder="<?= $layananPerbaikan ?>" readonly>
                </div>
                <div class="mb-3">
                  <label for="merk" class="form-label">Merk</label>
                  <input type="text" name="merk" class="form-control" id="merk" required>
                </div> 
                
                <div class="mb-3">
                  <label for="jenisperbaikan" class="form-label">Jenis Perbaikan</label>
                  <input type="text" name="jenisPerbaikan" class="form-control" id="jenisperbaikan" required>
                </div>
                
                <div class="mb-3">
                  <label for="harga" class="form-label">Harga Perbaikan</label>
                  <input type="text" name="harga" class="form-control" id="harga" value="Rp <?= number_format($harga, 0, ',', '.'); ?>" readonly>
                  <input type="hidden" name="harga" value="<?= $harga; ?>">
                </div>
                
                <div class="mb-3">
                  <label for="tanggal" class="form-label">Tanggal</label>
                  <input type="date" name="tanggal" class="form-control" id="tanggal">
                </div>
                <div class="mb-3">
                   <label for="waktu" class="form-label">Waktu</label>
                   <input type="time" name="waktu" pattern="^([0-1]?[0-9]|2[0-4]):([0-5][0-9])(:[0-5][0-9])?$" required class="form-control" id="waktu">
                </div>
                <div class="mb-3">
                  <label for="alamat" class="form-label">Lokasi / Alamat</label>
                  <textarea class="form-control" name="alamat" id="alamat" rows="3"></textarea>
                </div>
                <input type="hidden" name="status" value="Menunggu Teknisi">
                <input type="hidden" name="teknisi" value="">

                <button type="submit" name="kirim" class="btn btn-primary">Kirim</button>
            </form>
          </div>
        </div>
      </div>
    </section>

    <!-- akhir form order -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
   
  </body>
</html>