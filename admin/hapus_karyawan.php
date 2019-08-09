<?php 
@session_start();
include 'config.php';
$id=$_GET['id'];
$sql = mysqli_query($conn,"DELETE FROM admin WHERE id='$id'");
if ($sql) {
    $_SESSION['sukses'] = "Karyawan Berhasil Dihapus";
	header("location:karyawan.php");
} else {
   $_SESSION['info_gagal'] = "Karyawan Gagal Dihapus";
	header("location:karyawan.php");
}

?>