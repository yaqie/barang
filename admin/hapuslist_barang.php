<?php 
@session_start();
include 'config.php';
$id=$_GET['id'];
$id2=$_GET['c'];
$sql = mysqli_query($conn,"delete from barang_jual where id_barang_jual='$id'");
if ($sql) {
    $_SESSION['sukses'] = "Data Barang Berhasil Dihapus";
	header("location:tambah-transaksi2.php?id=".$id2);
} else {
   $_SESSION['info_gagal'] = "Data Barang Gagal Dihapus";
	header("location:tambah-transaksi2.php?id=".$id2);
}

?>