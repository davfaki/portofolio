<?php

// Koneksi ke database

$conn = mysqli_connect("localhost", "root", "", "teknisibaik");

// fungsi registrasi pelanggan

function registrasiP($data) {
	global $conn;

	// ambil data dari form registrasi
	$nama = htmlspecialchars($data['nama']);
    $username = strtolower(stripcslashes($data["username"]));
    $hp = htmlspecialchars($data['hp']);
    $email = htmlspecialchars($data['email']);
	$password = mysqli_real_escape_string($conn, $data["password"]);

	// cek username sudah ada atau belum
	$result = mysqli_query($conn, "SELECT username FROM pelanggan WHERE username = '$username' ");

	// jika username sudah terdaftar di database pelanggan
	if (mysqli_fetch_assoc($result)) {
		echo " 
			<script>
			alert('username sudah terdaftar!');
			</script> ";

		return false;
	}

	// jika username belum terdaftar di database pelanggan
	// enkripsi password
	$password = password_hash($password, PASSWORD_DEFAULT);
	// insert userbaru ke database
	mysqli_query($conn, "INSERT INTO pelanggan VALUES('','$nama','$username','$hp','$email','$password')");
	return mysqli_affected_rows($conn);

}

// fungsi registrasi Teknisi

function registrasiT($data) {
	global $conn;

	$nama = htmlspecialchars($data['nama']);
    $username = strtolower(stripcslashes($data["username"]));
    $hp = htmlspecialchars($data['hp']);
    $email = htmlspecialchars($data['email']);
	$password = mysqli_real_escape_string($conn, $data["password"]);
	$keahlian = htmlspecialchars($data['keahlian']);
	$alamat = htmlspecialchars($data['alamat']);

	// cek username sudah ada atau belum
	$result = mysqli_query($conn, "SELECT username FROM teknisi WHERE username = '$username' ");

	if (mysqli_fetch_assoc($result)) {
		echo " 
			<script>
			alert('username sudah terdaftar!');
			</script> ";

		return false;
	}


	// enkripsi password
	$password = password_hash($password, PASSWORD_DEFAULT);
	// insert userbaru ke database
	mysqli_query($conn, "INSERT INTO teknisi VALUES('','$nama','$username','$hp','$email','$password','$keahlian','$alamat')");
	return mysqli_affected_rows($conn);

}



// fungsi order
function order($data){
    global $conn;

    // ambil data dari tiap elemen dalam form
    $nama = htmlspecialchars($data['nama']);
    $hp = htmlspecialchars($data['hp']);
    $layananPerbaikan = $data['layananPerbaikan'];
    $merk = htmlspecialchars($data['merk']);
    $jenisPerbaikan = htmlspecialchars($data['jenisPerbaikan']);
    $harga = (int)$data['harga'];
    $tanggal = htmlspecialchars($data['tanggal']);
    $waktu = $data['waktu'];
    $alamat = htmlspecialchars($data['alamat']);
    $status = $data['status'];
    $teknisi = $data['teknisi'];

    // query insert data 
    $query = "INSERT INTO orderperbaikan
                VALUES 
                ('','$nama','$hp','$layananPerbaikan','$merk','$jenisPerbaikan', '$harga', '$tanggal', '$waktu', '$alamat', '$status', '$teknisi')
                ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

// fungsi query
function query($query) {
	global $conn;
	$result = mysqli_query($conn, $query);
	$rows = [];
	while ($row = mysqli_fetch_assoc($result)) {
		$rows[] = $row;
	}
	return $rows;
}

// fungsi completed order
function completed($id) {
	global $conn;
	mysqli_query($conn, "UPDATE orderperbaikan SET status = 'Completed' WHERE id = '$id' ");
	return mysqli_affected_rows($conn);
}

// fungsi cancel order
function canceled($id) {
	global $conn;
	mysqli_query($conn, "UPDATE orderperbaikan SET status = 'Canceled' WHERE id = '$id' ");
	return mysqli_affected_rows($conn);
}

// fungsi ambil order
function ambil($id) {

	global $conn;
	session_start();
	$user = isset($_SESSION['userteknisi']) ? $_SESSION['userteknisi'] : '';
	if (!$user) {
		return 0;
	}
	$result = mysqli_query($conn, "UPDATE orderperbaikan SET
		status = 'Dalam Penanganan', 
		teknisi = '$user' 
		WHERE id = '$id' ");
	if (!$result) {
		echo '<script>alert("MySQL error: ' . mysqli_error($conn) . '");</script>';
	}
	return mysqli_affected_rows($conn);
}

// CRUD Tipe Perbaikan
function getAllTipePerbaikan() {
    global $conn;
    $result = mysqli_query($conn, "SELECT * FROM tipeperbaikan ORDER BY id DESC");
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

// In the addTipePerbaikan function:
function addTipePerbaikan($data) {
    global $conn;
    $nama = htmlspecialchars($data['nama']);
    $harga = (int)$data['harga'];
    $icon = null;
    if (isset($_FILES['icon']) && $_FILES['icon']['error'] == 0) {
        $ext = strtolower(pathinfo($_FILES['icon']['name'], PATHINFO_EXTENSION));
        $allowed = ['jpg','jpeg','png','gif'];
        if (in_array($ext, $allowed)) {
            $icon = uniqid('icon_') . '.' . $ext;
            move_uploaded_file($_FILES['icon']['tmp_name'], __DIR__ . "/img/" . $icon);
        }
    }
    $query = "INSERT INTO tipeperbaikan (nama, harga, icon) VALUES ('$nama', '$harga', " . ($icon ? "'$icon'" : "NULL") . ")";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

// In the updateTipePerbaikan function:
function updateTipePerbaikan($id, $data) {
    global $conn;
    $nama = htmlspecialchars($data['nama']);
    $harga = (int)$data['harga'];
    $icon = null;
    if (isset($_FILES['icon']) && $_FILES['icon']['error'] == 0) {
        $ext = strtolower(pathinfo($_FILES['icon']['name'], PATHINFO_EXTENSION));
        $allowed = ['jpg','jpeg','png','gif'];
        if (in_array($ext, $allowed)) {
            $icon = uniqid('icon_') . '.' . $ext;
            move_uploaded_file($_FILES['icon']['tmp_name'], __DIR__ . "/img/" . $icon);
        }
    }
    $setIcon = $icon ? ", icon = '$icon'" : "";
    $query = "UPDATE tipeperbaikan SET nama = '$nama', harga = '$harga' $setIcon WHERE id = '$id'";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function deleteTipePerbaikan($id) {
    global $conn;
    $query = "DELETE FROM tipeperbaikan WHERE id = '$id'";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}


?>