<?php 
session_start();
include 'admin/config.php';
$uname=$_POST['uname'];
$pass=$_POST['pass'];
$pas=md5($pass);
$query=mysqli_query($conn,"select * from admin where uname='$uname' and pass='$pas'")or die(mysql_error());
$data = mysqli_fetch_array($query);
if(mysqli_num_rows($query)==1){
	$_SESSION['uname']=$uname;
	$_SESSION['jenis']="admin";
	$_SESSION['id'] = $data['id'];
	$_SESSION['level'] = $data['level'];
	header("location:admin/index.php");
	// die($_SESSION['id']);
}else{
	$_SESSION['info_gagal'] = "<strong>Maaf!</strong> username atau password salah";
	header("location:index.php");
	// mysql_error();
}
// echo $pas;

 ?>