<?php

  require '../function.php';
  
  if (isset($_POST['daftar'])) {
    if (registrasiP($_POST) > 0) {
      echo "
        <script>
        alert('user baru berhasil ditambahkan');
        document.location.href = 'loginpelanggan.php';
  
        </script>
       ";
       
    } else {
      echo mysqli_error($conn);
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

    <title>Halaman Registrasi Pelanggan</title>
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
              <a class="nav-link active" href="loginpelanggan.php">Login</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- Akhir Navbar -->
   
    <!-- form registrasi -->
    <section class="mt-5 pt-5 mb-4">
      <div class="container">
        <div class="row">
          <div class="col">
            <h2>Registrasi Pelanggan</h2>
          </div>
        </div>
        <div class="row mt-3">
          <div class="col-md-6">
            <form action="" method="post">
            <div class="mb-3">
              <label for="nama" class="form-label">Nama</label>
              <input type="text" name="nama" class="form-control" id="nama" required>
            </div>
            <div class="mb-3">
              <label for="username" class="form-label">Username</label>
              <input type="text" name="username" class="form-control" id="username" required>
            </div>
            <div class="mb-3">
              <label for="hp" class="form-label">No Hp</label>
              <input type="text" name="hp" class="form-control" id="hp" required>
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" name="email" class="form-control" id="email" required>
            </div>
            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Password</label>
              <input type="password" name="password" class="form-control" id="exampleInputPassword1">
            </div>
              <button type="submit" name="daftar" class="btn btn-primary">Daftar</button>
              <p class="mt-2">Sudah punya akun? <a href="loginpelanggan.php">Login disini</a></p>
            </form>
          </div>
        </div>
      </div>
    </section>
    <!-- akhir form registrasi -->




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  </body>
</html>