<?php 
session_start();

// jika sudah login, langsung redirect ke halaman dashboard
if (isset($_SESSION['loginpelanggan'])) {
	header("Location: dashboard.php");
	exit;
}

require '../function.php';
if (isset($_POST["loginpelanggan"])) {
	$username = $_POST['username'];
	$password = $_POST['password'];

	$result = mysqli_query($conn,"SELECT * FROM pelanggan WHERE username = '$username' " );



	// cek username
	if (mysqli_num_rows($result) === 1) {
		
		// cek password
		$row = mysqli_fetch_assoc($result);
		if (password_verify($password, $row["password"])) {
			// set session
			$_SESSION['loginpelanggan'] = true;
      $_SESSION['userpelanggan'] = $row['nama'];

			header("Location: dashboard.php");
			exit;
		}
	}

	$error = true;
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

    <title>Halaman Login Pelanggan</title>
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
              <a class="nav-link active" href="registrasipelanggan.php">Registrasi</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- Akhir Navbar -->
   
    <!-- form Login -->
    <section class="mt-5 pt-5 mb-5">
      <div class="container ">
        <div class="row">
          <div class="col text-center">
            <h2>Halaman Login</h2>
          </div>
        </div>
        <div class="row mt-3 justify-content-center">
          <div class="col-md-4">
          <form action="" method="post" class="mb-5">
                <?php if(isset($error)) : ?>
                    <div class="alert alert-warning mb-3" role="alert">
                         Username / Password Salah!
                    </div>
                <?php endif; ?>

                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" id="username" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="password" required>
                </div>
                <button type="submit" name="loginpelanggan" class="btn btn-primary mb-4">Login</button>
                <p class="mb-5">Belum punya akun? <a href="registrasipelanggan.php">Daftar disini</a></p>
            </form>
          </div>
        </div>
      </div>
    </section>
    <!-- akhir form Login -->




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  </body>
</html>