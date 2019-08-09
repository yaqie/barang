<?php 
@session_start();
include 'config.php';
$nama=$_POST['nama'];
$nomerHp=$_POST['nomerHp'];
$username=$_POST['username'];
$pass=md5($_POST['pass1']);

$sql = mysqli_query($conn,"INSERT INTO reseller VALUES('','$username','$pass','$nomerHp','$nama','')");
if ($sql) {
    $_SESSION['sukses'] = "Member Berhasil Ditambahkan";
	header("location:member.php");
} else {
   $_SESSION['info_gagal'] = "Member Gagal Ditambahkan";
	header("location:member.php");
}

 ?>