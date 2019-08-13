<?php 
@session_start();
include 'config.php';
$id = $_POST['id_barang_laku'];
$nama=explode("|", $_POST['nama']);
$harga=$_POST['harga'];
$jumlah=$_POST['jumlah'];
// $totalHarga=$_POST['total'];
// $jumlahUang=$_POST['jumlahUang'];
// $kembalian=$_POST['kembalian'];
$jenis=$_POST['jenis'];


$dt=mysqli_query($conn,"select * from barang where id='$nama[2]'");
$data=mysqli_fetch_array($dt);

// echo $id;
// echo "<br>";
// echo $nama[2];
// echo "<br>";
// echo $harga;
// echo "<br>";
// echo $jumlah;
// echo "<br>";

// echo $data['jumlah'];

if ($data['jumlah'] < $jumlah){
	$_SESSION['info_gagal'] = "Stok barang tidak tersedia";
	header("location:tambah-transaksi2.php?id=".$id);
    // echo "hoy1";
} else {
    // echo "hoy2";
	$sisa=$data['jumlah']-$jumlah;
	mysqli_query($conn,"UPDATE barang SET jumlah='$sisa' WHERE id='$nama[2]'");
	// $modal=$data['modal'];
	// $laba=$harga-$modal;
	// $labaa=$laba*$jumlah;
	// $total_harga=$totalHarga;
	$sql = mysqli_query($conn,"INSERT INTO `barang_jual` (`id_barang_jual`, `id_barang_laku`, `id_barang`, `jumlah`, `harga`) VALUES (NULL, '$id', '$nama[2]', '$jumlah', '$harga');");
	if ($sql) {
		$_SESSION['sukses'] = "Barang Berhasil Ditambahkan";
		// header("location:det-transaksi.php");
		header("location:tambah-transaksi2.php?id=".$id);
	} else {
		$_SESSION['info_gagal'] = "Data Transaksi Gagal Ditambahkan";
		header("location:tambah-transaksi2.php?id=".$id);
    }
    
    echo $id;
}


?>