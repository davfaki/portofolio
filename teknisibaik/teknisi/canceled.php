<?php 
require '../function.php';

$id = $_GET["id"];

if (canceled($id) > 0) {
	echo "
			<script>
			 alert('Order berhasil di cancel');
			 document.location.href = 'dashboard.php';
			</script>
	";
} else {
	echo "

	<script>
			 alert('Order gagal di cancel');
			 document.location.href = 'dashboard.php';
			</script>

	";
}

 ?>