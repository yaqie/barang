<?php 
@session_start();
include 'config.php';
$id=$_POST['id'];
$username=$_POST['username'];
$password=md5($_POST['password']);

if($_POST['password'] == ''){
    $sql = mysqli_query($conn,"UPDATE admin SET uname='$username' WHERE id='$id'");
} else {
    $sql = mysqli_query($conn,"UPDATE admin SET uname='$username',pass = '$password' WHERE id='$id'");
}
if ($sql) {
    $_SESSION['sukses'] = "Karyawan Berhasil Diedit";
	header("location:karyawan.php");
} else {
   $_SESSION['info_gagal'] = "Karyawan Gagal Diedit";
	header("location:karyawan.php");
}

?>