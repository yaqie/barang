<?php 
@session_start();
include 'config.php';
$nama=$_POST['nama'];
$nomerHp=$_POST['nomerHp'];
$cek = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM member WHERE no_hp = '$nomerHp' "));
if ($cek >= 1) {
    $_SESSION['info_gagal'] = "Member Gagal Ditambahkan. Nomor handphone telah digunakan";
	header("location:member.php");
} else {
    $sql = mysqli_query($conn,"INSERT INTO `member` (`id_reseller`, `username`, `password`, `no_hp`, `nama_reseller`, `foto`) VALUES (NULL, '', '', '$nomerHp', '$nama', '');");
    if ($sql) {
        $_SESSION['sukses'] = "Member Berhasil Ditambahkan";
        header("location:member.php");
    } else {
       $_SESSION['info_gagal'] = "Member Gagal Ditambahkan";
        header("location:member.php");
    }
}

 ?>