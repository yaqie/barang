<?php 
@session_start();
include 'config.php';
$id=$_GET['id'];
$jumlah=$_GET['jumlah'];
$nama=$_GET['nama'];

$a=mysqli_query($conn,"select jumlah from barang where nama='$nama'");
$b=mysqli_fetch_array($a);
$kembalikan=$b['jumlah']+$jumlah;
$c=mysqli_query($conn,"update barang set jumlah='$kembalikan' where nama='$nama'");
$sql = mysqli_query($conn,"delete from barang_laku where id='$id'");
if ($sql) {
    $_SESSION['sukses'] = "Data Barang Berhasil Dihapus";
	header("location:barang_laku.php");
} else {
   $_SESSION['info_gagal'] = "Data Barang Gagal Dihapus";
	header("location:barang_laku.php");
}

 ?>