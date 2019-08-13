<?php 
@session_start();
include 'config.php';
$username=$_POST['username'];
$pass=md5($_POST['password']);
$nohp=$_POST['nohp'];

$sql = mysqli_query($conn,"INSERT INTO `admin` (`id`, `uname`, `pass`, `nohp`, `foto`, `otp`, `level`) VALUES (NULL, '$username', '$pass', '$nohp', '', '', 'karyawan');");
if ($sql) {
    $_SESSION['sukses'] = "Karyawan Berhasil Ditambahkan";
	header("location:karyawan.php");
} else {
   $_SESSION['info_gagal'] = "Karyawan Gagal Ditambahkan";
	header("location:karyawan.php");
}

 ?>