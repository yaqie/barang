<?php 
@session_start();
include 'config.php';
$id = $_POST['id'];
$nama=explode("|", $_POST['nama']);
$harga=$_POST['harga'];
$jumlah=$_POST['jumlah'];
$totalHarga=$_POST['total'];
$jumlahUang=$_POST['jumlahUang'];
$kembalian=$_POST['kembalian'];

$tanggal = date("Y-m-d");

$dt=mysqli_query($conn,"select * from barang where id='$id'");
$data=mysqli_fetch_array($dt);







if ($data['jumlah'] < $jumlah){
	$_SESSION['info_gagal'] = "Stok barang tidak tersedia";
	header("location:barang_laku.php");
} else {
	$sisa=$data['jumlah']-$jumlah;
	mysqli_query($conn,"UPDATE barang SET jumlah='$sisa' WHERE id='$id'");
	$modal=$data['modal'];
	$laba=$harga-$modal;
	$labaa=$laba*$jumlah;
	$total_harga=$totalHarga;
	$sql = mysqli_query($conn,"insert into barang_laku values('','$tanggal','$nama[0]','$jumlah','$harga','$total_harga','$labaa')");
	if ($sql) {
		$_SESSION['sukses'] = "Data Transaksi Berhasil Ditambahkan";
		// header("location:det-transaksi.php");
		header("location:barang_laku.php");
	} else {
		$_SESSION['info_gagal'] = "Data Transaksi Gagal Ditambahkan";
		header("location:barang_laku.php");
	}
}


?>