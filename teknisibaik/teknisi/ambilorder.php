<?php 
require '../function.php';

$id = $_GET["id"];

if (ambil($id) > 0) {
	echo "
			<script>
			 alert('Order berhasil di ambil');
			 document.location.href = 'order.php';
			</script>
	";
} else {
	echo "

	<script>
			 alert('Order gagal di ambil');
			 document.location.href = 'dashboard.php';
			</script>

	";
}

 ?>