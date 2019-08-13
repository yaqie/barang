<?php 
@session_start();
include 'config.php';
$id_reseller=$_GET['id_reseller'];
$sql = mysqli_query($conn,"DELETE FROM member WHERE id_reseller='$id_reseller'");
if ($sql) {
    $_SESSION['sukses'] = "Member Berhasil Dihapus";
	header("location:member.php");
} else {
   $_SESSION['info_gagal'] = "Member Gagal Dihapus";
	header("location:member.php");
}

?>