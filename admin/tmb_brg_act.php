<?php 
@session_start();
include 'config.php';
$nama=$_POST['nama'];
$jenis=$_POST['jenis'];
$suplier=$_POST['suplier'];
$modal=$_POST['modal'];
$harga=$_POST['harga'];
$jumlah=$_POST['jumlah'];
$sisa=$_POST['jumlah'];
$foto=$_FILES['foto']['name'];






move_uploaded_file($_FILES['foto']['tmp_name'], "foto_barang/".$_FILES['foto']['name']);
// $sql = mysqli_query($conn,"insert into barang values('','$nama','$jenis','$suplier','$modal','$harga','$jumlah','$sisa',$foto)");
$sql = mysqli_query($conn, "INSERT INTO `barang` (`id`, `nama`, `id_jenis`, `Id_supplier`, `modal`, `harga`, `jumlah`, `sisa`, `foto`) VALUES (NULL, '$nama','$jenis','$suplier','$modal','$harga','$jumlah','$sisa','$foto')");
if ($sql) {
    $_SESSION['sukses'] = "Data Barang Berhasil Ditambahkan";
	header("location:barang.php");
} else {
   $_SESSION['info_gagal'] = "Data Barang Gagal Ditambahkan";
	header("location:barang.php");
}

 ?>