<?php 
@session_start();
include 'config.php';
$id_reseller=$_POST['id_reseller'];
$nama_reseller=$_POST['nama_reseller'];
$username=$_POST['username'];
$no_hp=$_POST['no_hp'];

$sql = mysqli_query($conn,"UPDATE reseller SET nama_reseller='$nama_reseller', username='$username', no_hp='$no_hp' WHERE id_reseller='$id_reseller'");
if ($sql) {
    $_SESSION['sukses'] = "Member Berhasil Diedit";
	header("location:member.php");
} else {
   $_SESSION['info_gagal'] = "Member Gagal Diedit";
	header("location:member.php");
}

?>