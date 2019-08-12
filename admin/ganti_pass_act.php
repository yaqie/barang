<?php 
@session_start();
include 'config.php';


if($_GET['aksi'] == 'kirimotp'){
	$nohp=$_POST['nohp'];
	$user=$_POST['user'];
	$lama=md5($_POST['lama']);
	$baru=$_POST['baru'];
	$ulang=$_POST['ulang'];
	$id=$_POST['id']; 
	$jenis=$_POST['jenis'];
	
	$cek=mysqli_query($conn,"select * from admin where pass='$lama' and id='$id'");


	if(mysqli_num_rows($cek)==1){
		if($baru==$ulang){
			$b = md5($baru);
			
			$_SESSION['new_password'] = $b;
			$rand = rand(100000,999999);
			$message = 'otp anda '.$rand;
			$post = array(
				"nohp" => $nohp,
				"message" => $message,
			);
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL,"http://projeku.site/sms/kirimsms.php");
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_exec ($ch);    
			curl_close ($ch);

			mysqli_query($conn,"update admin set otp='$rand' where id='$id'");
			header("location:otp.php");

		} else {
			$_SESSION['info_gagal'] = "Password Tidak Sama";
			header("location:ganti_pass.php");
		}
		
	} else {
		$_SESSION['info_gagal'] = "Password Gagal Diubah";
		header("location:ganti_pass.php");
	}
}

if($_GET['aksi'] == 'change'){
	$id=$_POST['id'];
	$otp=$_POST['otp'];

	$cek=mysqli_query($conn,"select * from admin where id='$id'");
	$data = mysqli_fetch_object($cek);
	if ($data->otp == $otp) {
		$b = $_SESSION['new_password'];
		mysqli_query($conn,"update admin set pass='$b' where id='$id'");
		$_SESSION['sukses'] = "Password Berhasil Diubah";
		unset($_SESSION['new_password']);
		header("location:ganti_pass.php");
	} else {
		$_SESSION['info_gagal'] = "OTP tidak valid";
		header("location:otp.php");
	}

	
}

 ?>