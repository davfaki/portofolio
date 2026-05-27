<?php 
require '../function.php';

// ambil id yang dikirim dari halaman order
$id = $_GET["id"];

// jalankan fungsi

// jika berhasil 
if (completed($id) > 0) {
	echo "
			<script>
			 alert('Status order berhasil diperbarui');
			 document.location.href = 'dashboard.php';
			</script>
	";
} 

// jika gagal
else {
	echo "

	<script>
			 alert('Status order gagal diperbarui');
			 document.location.href = 'dashboard.php';
			</script>

	";
}

 ?>