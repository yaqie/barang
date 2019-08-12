<?php 
@session_start();
include 'config.php';
$id = $_POST['id'];
$nohp = $_POST['nohp'];

mysqli_query($conn,"update admin set nohp='$nohp' where id='$id'");
$_SESSION['sukses'] = "Nomor Berhasil Diganti";
header("location:profil.php");


?>
