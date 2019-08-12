<?php 
@session_start();
include 'config.php';

$aksi = $_GET['aksi'];

if ($aksi == 'tambah-jenis') {
	$nama=$_POST['nama'];

	$cek = mysqli_num_rows(mysqli_query($conn,"SELECT nama_jenis from jenis_barang where nama_jenis = '$nama'"));
	if ($cek > 0) {
		$_SESSION['info_gagal'] = "Jenis barang sudah ada!";
		header("location:jenis-barang.php");
	}
	else{
		$sql = mysqli_query($conn, "INSERT into jenis_barang (`id_jenis`,`nama_jenis`) VALUES ('','$nama')");
		if ($sql) {
			 $_SESSION['sukses'] = "Jenis barang berhasil ditambahkan";
			header("location:jenis-barang.php");
		}
		else{
			$_SESSION['info_gagal'] = "Jenis barang gagal ditambahkan!";
			header("location:jenis-barang.php");
		}
	}
}

if ($aksi == 'edit-jenis') {
	$nama=$_POST['nama'];
	$id=$_POST['id'];

	
	$sql = mysqli_query($conn, "UPDATE jenis_barang SET 
		`nama_jenis` = '$nama' where `jenis_barang`.`id_jenis` = '$id'");
	if ($sql) {
		 $_SESSION['sukses'] = "Jenis barang berhasil diedit";
		header("location:jenis-barang.php");
	}
	else{
		$_SESSION['info_gagal'] = "Jenis barang gagal diedit!";
		header("location:jenis-barang.php");
	}
}

if ($aksi == 'hapus-jenis') {
	$id = strip_tags(mysqli_real_escape_string($conn,$_POST['hapus']));
 
	$sql=mysqli_query($conn,"DELETE FROM `jenis_barang` WHERE `id_jenis` = '$id'");
   
	if ($sql) {
	  	$_SESSION['sukses'] = "Jenis Barang Berhasil Dihapus";
	  	header('location:jenis-barang.php');
	  	// echo '<script language="javascript">swal("Berhasil!", "Laporan Telah Dihapus!", "success").then(() => { window.location="../kegiatan-harian"; });</script>';
	}
	else{
		$_SESSION['info_gagal'] = "Jenis Barang Gagal Dihapus";
		header('location:jenis-barang.php');
	  	// echo '<script language="javascript">swal("Gagal!", "Laporan Gagal Dihapus!", "error").then(() => { window.location="../kegiatan-harian"; });</script>';
	}
}

if ($aksi == 'tambah-supplier') {
	$nama=$_POST['nama_supplier'];

	$cek = mysqli_num_rows(mysqli_query($conn,"SELECT nama_supplier from supplier where nama_supplier = '$nama'"));
	if ($cek > 0) {
		$_SESSION['info_gagal'] = "Supplier sudah ada!";
		header("location:data-supplier.php");
	}
	else{
		$sql = mysqli_query($conn, "INSERT INTO supplier (`id_supplier`,`nama_supplier`) VALUES ('','$nama')");
		if ($sql) {
			 $_SESSION['sukses'] = "Supplier berhasil ditambahkan";
			header("location:data-supplier.php");
		}
		else{
			$_SESSION['info_gagal'] = "Supplier gagal ditambahkan!";
			header("location:data-supplier.php");
		}
	}
}

if ($aksi == 'edit-supplier') {
	$nama=$_POST['nama'];
	$id=$_POST['id'];

	
	$sql = mysqli_query($conn, "UPDATE supplier SET 
		`nama_supplier` = '$nama' where `supplier`.`id_supplier` = '$id'");
	if ($sql) {
		 $_SESSION['sukses'] = "Supplier berhasil diedit";
		header("location:data-supplier.php");
	}
	else{
		$_SESSION['info_gagal'] = "Supplier gagal diedit!";
		header("location:data-supplier.php");
	}
}

if ($aksi == 'hapus-supplier') {
	$id = strip_tags(mysqli_real_escape_string($conn,$_POST['hapus']));
 
	$sql=mysqli_query($conn,"DELETE FROM `supplier` WHERE `id_supplier` = '$id'");
   
	if ($sql) {
	  	$_SESSION['sukses'] = "Supplier Berhasil Dihapus";
	  	header('location:data-supplier.php');
	  	// echo '<script language="javascript">swal("Berhasil!", "Laporan Telah Dihapus!", "success").then(() => { window.location="../kegiatan-harian"; });</script>';
	}
	else{
		$_SESSION['info_gagal'] = "Supplier Gagal Dihapus";
		header('location:data-supplier.php');
	  	// echo '<script language="javascript">swal("Gagal!", "Laporan Gagal Dihapus!", "error").then(() => { window.location="../kegiatan-harian"; });</script>';
	}
}

 ?>