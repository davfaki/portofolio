<?php
session_start();

// cek apakah user sudah login
if (!isset($_SESSION['login'])) {
    header("Location: loginteknisi.php");
    exit;
}

// mengambil nama dari user
$user = $_SESSION['userteknisi'];

// untuk set waktu lokal
date_default_timezone_set('Asia/Jakarta');
$waktu = date('d-m-Y H:i:s');

// menghubungkan ke halaman function
require '../function.php';

// query ambil order dimanana statusnya belum completed
$perbaikan = query("SELECT * FROM orderperbaikan WHERE status != 'Completed' ORDER BY id DESC ");

// CRUD Tipe Perbaikan
$tipeperbaikan = getAllTipePerbaikan();

// Tambah tipe perbaikan
if (isset($_POST['tambah_tipe'])) {
    if (addTipePerbaikan($_POST) > 0) {
        echo "<script>alert('Tipe perbaikan berhasil ditambah!');window.location='dashboard.php';</script>";
    } else {
        echo "<script>alert('Gagal menambah tipe perbaikan!');</script>";
    }
}
// Hapus tipe perbaikan
if (isset($_GET['hapus_tipe'])) {
    $id = $_GET['hapus_tipe'];
    if (deleteTipePerbaikan($id) > 0) {
        echo "<script>alert('Tipe perbaikan berhasil dihapus!');window.location='dashboard.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus tipe perbaikan!');</script>";
    }
}
// Edit tipe perbaikan
if (isset($_POST['edit_tipe'])) {
    $id = $_POST['id'];
    if (updateTipePerbaikan($id, $_POST) > 0) {
        echo "<script>alert('Tipe perbaikan berhasil diupdate!');window.location='dashboard.php';</script>";
    } else {
        echo "<script>alert('Gagal update tipe perbaikan!');</script>";
    }
}

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

    <title>Dashboard Teknisi</title>
  </head>
  <body>

    <!-- navbar -->
        
    <nav class="navbar navbar-expand-lg navbar-dark bg-success fixed-top">
      <div class="container">
        <a class="navbar-brand" href="../index.html">Teknisi Baik</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="dashboard.php">Dashboard</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="order.php">Order Anda</a>
            </li>
          </ul>
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link active" href="#"><?= $user; ?></a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="logout.php">Logout</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- Akhir Navbar -->
    
    <!-- CRUD Tipe Perbaikan -->
    <section class="mt-5 pt-5">
      <div class="container">
        <div class="row mb-3">
          <div class="col-md-6">
            <h4>Manajemen Tipe Perbaikan</h4>
            <form method="post" class="d-flex mb-3" enctype="multipart/form-data">
              <input type="text" name="nama" class="form-control me-2" placeholder="Tipe perbaikan baru" required>
              <input type="number" name="harga" class="form-control me-2" placeholder="Harga" required>
              <input type="file" name="icon" class="form-control me-2" accept="image/*">
              <button type="submit" name="tambah_tipe" class="btn btn-success">Tambah</button>
            </form>
          </div>
        </div>
        <div class="row">
          <div class="col-md-8">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Tipe Perbaikan</th>
                  <th>Harga</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $no=1; foreach($tipeperbaikan as $tp): ?>
                  <tr>
                    <td><?= $no++; ?></td>
                    <td>
                      <?php if(isset($_GET['edit_tipe']) && $_GET['edit_tipe']==$tp['id']): ?>
                        <form method="post" class="d-flex" enctype="multipart/form-data">
                          <input type="hidden" name="id" value="<?= $tp['id']; ?>">
                          <input type="text" name="nama" value="<?= htmlspecialchars($tp['nama']); ?>" class="form-control me-2" required>
                          <input type="number" name="harga" value="<?= htmlspecialchars($tp['harga']); ?>" class="form-control me-2" required>
                          <input type="file" name="icon" class="form-control me-2" accept="image/*">
                          <button type="submit" name="edit_tipe" class="btn btn-primary btn-sm me-1">Simpan</button>
                          <a href="dashboard.php" class="btn btn-secondary btn-sm">Batal</a>
                        </form>
                      <?php else: ?>
                        <?php if(!empty($tp['icon'])): ?>
                          <img src="../img/<?= htmlspecialchars($tp['icon']); ?>" alt="icon" style="max-width:40px;max-height:40px;">
                        <?php endif; ?>
                        <?= htmlspecialchars($tp['nama']); ?>
                      <?php endif; ?>
                    </td>
                    <td>Rp <?= number_format($tp['harga'], 0, ',', '.'); ?></td>
                    <td>
                      <a href="dashboard.php?edit_tipe=<?= $tp['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                      <a href="dashboard.php?hapus_tipe=<?= $tp['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus tipe perbaikan ini?')">Hapus</a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </section>
    
    <!-- card history -->
    
    <section class="history mt-5 pt-5">
      <div class="container">
        <div class="row mb-3">
          <div class="col-md-11">
            <p>Terakhir Update : <?= $waktu ?></p>
          </div>
          <div class="col-md-1">
            <a href="refresh.php" class="btn btn-primary">Refresh</a>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <?php $i=1; ?>
            <?php foreach($perbaikan as $data) : ?>
            <div class="card mb-4">
              <div class="card-header">
                <div class="row">
                  <div class="col-md-10">
                    <h5><?= $i; ?>. Layanan Perbaikan <?= $data["layananperbaikan"]; ?></h5>
                     <p>Merk : <?= $data["merk"]; ?></p>
                  </div>
                  <div class="col-md-2">
                    <p><?= $data["tanggal"]; ?> <?= $data["waktu"]; ?></p>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-10">
                    <table border="0" cellspacing="" cellpadding="5">
                      <tr>
                        <td>Jenis Perbaikan </td>
                        <td>: <?= $data['jenisperbaikan']; ?></td>
                      </tr>
                      <tr>
                        <td>Harga </td>
                        <td>: Rp <?= number_format($data['harga'], 0, ',', '.'); ?></td>
                      </tr>
                      <tr>
                        <td>Status </td>
                        <td>: <?= $data['status']; ?></td>
                      </tr>
                      <tr>
                        <td>Teknisi </td>
                        <td>: <?= $data['teknisi']; ?></td>
                      </tr>
                    </table>
                  </div>
                  <div class="col-md-2">
                     <a href="ambilorder.php?id=<?= $data["id"]; ?>" class="btn btn-success" onclick="return confirm('Anda yakin?')">Ambil Order</a> 
                     <p class="text-danger">*Pastikan untuk menghubungi pelanggan terlebih dahulu sebelum ambil order</p>
                  </div>
                </div>
                
                <hr>
                <h5 class="card-title">Identitas Pelanggan</h5>
                <table border="0" cellspacing="" cellpadding="5">
                  <tr>
                    <td>Atas Nama </td>
                    <td>: <?= $data["nama"]; ?></td>
                  </tr>
                  <tr>
                    <td>No. Hp </td>
                    <td>: <?= $data["hp"]; ?></td>
                  </tr>
                  <tr>
                    <td>Alamat </td>
                    <td>: <?= $data["alamat"]; ?></td>
                  </tr>
                </table>
              </div>
            </div>
             <?php $i++; ?>
             <?php endforeach; ?>
          </div>  
        </div>
      </div>
     
    </section>

    <!-- akhir card history -->
   
    <!-- Akhir CRUD Tipe Perbaikan -->
  

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  </body>
</html>