<?php 
@session_start();
include 'config.php';
$id=$_GET['id'];
$sql = mysqli_query($conn,"delete from barang where id='$id'");
if ($sql) {
    $_SESSION['sukses'] = "Data Barang Berhasil Dihapus";
	header("location:barang.php");
} else {
   $_SESSION['info_gagal'] = "Data Barang Gagal Dihapus";
	header("location:barang.php");
}

?>