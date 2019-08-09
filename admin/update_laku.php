<?php 
@session_start();
include 'config.php';
$id = $_POST['id'];
$tgl=$_POST['tgl'];
$nama=$_POST['nama'];
$harga=$_POST['harga'];
$jumlah=$_POST['jumlah'];
$totalHarga=$_POST['total'];

function ubahTanggal($tgl){
		 $pisah = explode('/',$tgl);
		 $array = array($pisah[2],$pisah[0],$pisah[1]);
		 $satukan = implode('-',$array);
		 return $satukan;
	}

	$tanggal = ubahTanggal($tgl);

$dt=mysqli_query($conn,"select * from barang where id='$id'");
$data=mysqli_fetch_array($dt);
$sisa=$data['jumlah']-$jumlah;
mysqli_query($conn,"UPDATE barang SET jumlah='$sisa' WHERE id='$id'");

$modal=$data['modal'];
$laba=$harga-$modal;
$labaa=$laba*$jumlah;
$total_harga=$totalHarga;

$sql = mysqli_query($conn,"update barang_laku set tanggal='$tanggal', nama='$nama', harga='$harga', jumlah='$jumlah', total_harga='$total_harga' where id='$id'");
if ($sql) {
    $_SESSION['sukses'] = "Data Barang Berhasil Diedit";
	header("location:barang.php");
} else {
   $_SESSION['info_gagal'] = "Data Barang Gagal Diedit";
	header("location:barang.php");
}

?>