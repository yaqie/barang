<?php 
@session_start();
include 'config.php';
$user=$_POST['user'];
$foto=$_FILES['foto']['name'];
$id = $_POST['id'];
$jenis = $_POST['jenis'];

// move_uploaded_file($_FILES['foto']['tmp_name'], "foto/".$_FILES['foto']['name'])or die();
// 	mysqli_query($conn,"update admin set foto='$foto' where uname='$user'");



// $u2=mysqli_query($conn,"select * from reseller where id_reseller='$id'");
// $us2=mysqli_fetch_array($u);

if ($foto == '') {
	 $_SESSION['info_gagal'] = "Foto Belum Dipilih";
	header("location:ganti_foto.php");
} else {
	if($jenis == "admin"){
	$u=mysqli_query($conn,"select * from admin where id='$id'");
	$us=mysqli_fetch_array($u);
	if(file_exists("foto/".$us['foto'])){
		unlink("foto/".$us['foto']);
		move_uploaded_file($_FILES['foto']['tmp_name'], "foto/".$_FILES['foto']['name']);
		mysqli_query($conn,"update admin set foto='$foto' where id='$id'");
		 $_SESSION['sukses'] = "Foto Berhasil Diganti";
		header("location:ganti_foto.php");
	}else{
		move_uploaded_file($_FILES['foto']['tmp_name'], "foto/".$_FILES['foto']['name']);
		mysqli_query($conn,"update admin set foto='$foto' where id='$id'");
		$_SESSION['sukses'] = "Foto Berhasil Diganti";
		header("location:ganti_foto.php");
	}
} else {
	$u2=mysqli_query($conn,"select * from reseller where id_reseller='$id'");
	$us2=mysqli_fetch_array($u2);
	if(file_exists("foto/".$us2['foto'])){
		unlink("foto/".$us2['foto']);
		move_uploaded_file($_FILES['foto']['tmp_name'], "foto/".$_FILES['foto']['name']);
		mysqli_query($conn,"update reseller set foto='$foto' where id_reseller='$id'");
		$_SESSION['sukses'] = "Foto Berhasil Diganti";
		header("location:ganti_foto.php");
	}else{
		move_uploaded_file($_FILES['foto']['tmp_name'], "foto/".$_FILES['foto']['name']);
		mysqli_query($conn,"update reseller set foto='$foto' where id_reseller='$id'");
		$_SESSION['sukses'] = "Foto Berhasil Diganti";
		header("location:ganti_foto.php");
	}
}
}



?>
