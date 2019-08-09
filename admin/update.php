<?php 
@session_start();
include 'config.php';
$id=$_POST['id'];
$nama=$_POST['nama'];
$jenis=$_POST['jenis'];
$suplier=$_POST['suplier'];
$modal=$_POST['modal'];
$harga=$_POST['harga'];
$jumlah=$_POST['jumlah'];
$foto=$_FILES['foto']['name'];

// $sql = mysqli_query($conn,"update barang set nama='$nama', jenis='$jenis', suplier='$suplier', modal='$modal', harga='$harga', jumlah='$jumlah' where id='$id'");
// if ($sql) {
//     $_SESSION['sukses'] = "Data Barang Berhasil Diedit";
// 	header("location:barang.php");
// } else {
//    $_SESSION['info_gagal'] = "Data Barang Gagal Diedit";
// 	header("location:barang.php");
// }

if ($foto == '') {
   mysqli_query($conn,"update barang set nama='$nama', jenis='$jenis', suplier='$suplier', modal='$modal', harga='$harga', jumlah='$jumlah' where id='$id'");
		 $_SESSION['sukses'] = "Data Barang Berhasil Diedit";
		header("location:barang.php");
} else {
   $u=mysqli_query($conn,"select * from barang where id='$id'");
	$us=mysqli_fetch_array($u);
	if(file_exists("foto_barang/".$us['foto'])){
		unlink("foto_barang/".$us['foto']);
		move_uploaded_file($_FILES['foto']['tmp_name'], "foto_barang/".$_FILES['foto']['name']);
		mysqli_query($conn,"update barang set nama='$nama', jenis='$jenis', suplier='$suplier', modal='$modal', harga='$harga', jumlah='$jumlah',foto='$foto' where id='$id'");
		 $_SESSION['sukses'] = "Data Barang Berhasil Diedit";
		header("location:barang.php");
	}else{
		move_uploaded_file($_FILES['foto']['tmp_name'], "foto_barang/".$_FILES['foto']['name']);
		mysqli_query($conn,"update barang set nama='$nama', jenis='$jenis', suplier='$suplier', modal='$modal', harga='$harga', jumlah='$jumlah',foto='$foto' where id='$id''");
		$_SESSION['sukses'] = "Data Barang Berhasil Diedit";
		header("location:barang.php");
    }
}
?>