<?php 
@session_start();
include 'config.php';
$user=$_POST['user'];
$lama=md5($_POST['lama']);
$baru=$_POST['baru'];
$ulang=$_POST['ulang'];
$id=$_POST['id']; 
$jenis=$_POST['jenis'];

$cek=mysqli_query($conn,"select * from admin where pass='$lama' and id='$id'");
$cek2=mysqli_query($conn,"select * from reseller where password='$lama' and id_reseller='$id'");

if($jenis == "admin"){
	if(mysqli_num_rows($cek)==1){
		if($baru==$ulang){
			$b = md5($baru);
			mysqli_query($conn,"update admin set pass='$b' where id='$id'");
			$_SESSION['sukses'] = "Password Berhasil Diubah";
			header("location:ganti_pass.php");
		} else {
			$_SESSION['info_gagal'] = "Password Tidak Sama";
			header("location:ganti_pass.php");
		}
	} else {
		$_SESSION['info_gagal'] = "Password Gagal Diubah";
		header("location:ganti_pass.php");
	}
} else {
	if(mysqli_num_rows($cek2)==1){
		if($baru==$ulang){
			$b = md5($baru);
			mysqli_query($conn,"update reseller set password='$b' where id_reseller='$id'");
			$_SESSION['sukses'] = "Password Berhasil Diubah";
			header("location:ganti_pass.php");
		} else {
			$_SESSION['info_gagal'] = "Password Tidak Sama";
			header("location:ganti_pass.php");
		}
	} else {
		$_SESSION['info_gagal'] = "Password Gagal Diubah";
		header("location:ganti_pass.php");
	}
}

 ?>