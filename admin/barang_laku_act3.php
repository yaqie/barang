<?php 
@session_start();
include 'config.php';
echo "<br>";echo $id = $_POST['id_barang_laku'];
echo "<br>";echo $total = $_POST['total'];
echo "<br>";echo $bayar = $_POST['bayar'];
echo "<br>";echo $laba = $_POST['laba'];
echo "<br>";echo $kembali = $_POST['kembali'];
echo "<br>";echo $id_karyawan = $_POST['id_karyawan'];

mysqli_query($conn,"UPDATE barang_laku SET total_harga='$total',laba='$laba',bayar='$bayar',kembali='$kembali',id_karyawan = '$id_karyawan' WHERE id='$id'");
header('location:edit_laku.php?id='.$id);


?>