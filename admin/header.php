<?php
@session_start();
include 'cek.php';
include 'config.php';

// include "secure-admin.php";
// // include "../../format_tanggal.php";

// $tgl = $data['created'];

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>KP - Barang</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../assets/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../assets/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../assets/dist/css/AdminLTE.min.css">
  
  <link rel="stylesheet" href="../assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  
  <link rel="stylesheet" href="../assets/dist/css/skins/_all-skins.min.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="../assets/plugins/iCheck/all.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="../assets/bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="../assets/plugins/timepicker/bootstrap-timepicker.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="../assets/bower_components/select2/dist/css/select2.min.css">
    <!-- DataTables -->
  <link rel="stylesheet" href="../assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
   <!-- <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
  <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script> -->

  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> 
  <script type="text/javascript">
		$(document).ready(function(){
			$("#tgl").datepicker({dateFormat : 'yy/mm/dd', autoclose: true});							
		});

        function setHarga2() {
            
            // var data = e.target.value;
            var dd = document.getElementById("DDhargaBarang");
            var data = dd.options[dd.selectedIndex].value;
            var pecah = data.split('|');
            var harga = Number(pecah[1]);
            var idBarang = Number(pecah[2]);
            var hargaBarang = document.getElementById("hargaBarang");
            
            var DDjenis = document.getElementById("jenisPembeli");
            var jenis = DDjenis.options[DDjenis.selectedIndex].value;
            var hidden = document.getElementById("hidden");
            hidden.value = idBarang;
            var jumlah = Number(document.getElementById("jumlahBarang").value);
            var totalHarga = document.getElementById("totalHarga");
            var diskon6 = harga - (harga*6/100);
            var diskon10 = harga - (harga*10/100)

            if(jenis == "umum"){
                hargaBarang.value = harga;
                document.getElementById("textHargaJual").innerHTML  = "Harga Jual / unit (Tanpa Diskon)";
                totalHarga.value = hargaBarang.value * jumlah;
            } else if (jenis == "member"){
                document.getElementById("textHargaJual").innerHTML  = "Harga Jual / unit (Diskon 6%)";
                hargaBarang.value = diskon6;
                totalHarga.value = hargaBarang.value * jumlah;
            } else if (jenis == "reseller"){
                document.getElementById("textHargaJual").innerHTML  = "Harga Jual / unit (beli 10pcs diskon 10%)";
                if(jumlah < 10){
                    hargaBarang.value = harga;
                    totalHarga.value = hargaBarang.value * jumlah;
                } else {
                    hargaBarang.value = diskon10;
                    totalHarga.value = hargaBarang.value * jumlah;
                }
            }

             
        }
	</script>

 
   
</head>
<body class="hold-transition skin-blue sidebar-mini"">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="../assets/index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>KP</b>B</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>KP </b>Barang</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">

            <?php 
				$id=$_SESSION['id'];
				$jenis = $_SESSION['jenis'];

				$fo=mysqli_fetch_array(mysqli_query($conn,"select foto from admin where id='$id'"));
				$fo2=mysqli_fetch_array(mysqli_query($conn,"select foto from reseller where id_reseller='$id'"));
			?>

              <img src="foto/<?php if($jenis == "admin"){ echo $fo['foto']; } else { echo $fo2['foto']; }  ?>" class="user-image" alt="User Image">
              <span class="hidden-xs">Hy , <?php echo $_SESSION['uname']  ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="foto/<?php if($jenis == "admin"){ echo $fo['foto']; } else { echo $fo2['foto']; }  ?>" class="img-circle" alt="User Image">

                <p>
                 <?php echo $_SESSION['uname']  ?>
                </p>
              </li>
             
              <li class="user-footer">
               <!--  <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profil</a>
                </div> -->
                <div class="pull-right">
                  <!-- <a href="ganti-password" class="btn btn-default btn-flat">Ganti Password</a>&nbsp; -->
                  <a href="logout.php" class="btn btn-default btn-flat">Logout</a>
                </div>
              </li>
            </ul>
          </li>
         
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="foto/<?php if($jenis == "admin"){ echo $fo['foto']; } else { echo $fo2['foto']; }  ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $_SESSION['uname']  ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <div id="modalpesan" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Pesan Notification</h4>
				</div>
				<div class="modal-body">
					<?php 
					$periksa=mysqli_query($conn,"select * from barang where jumlah <=3");
					while($q=mysqli_fetch_array($periksa)){	
						if($q['jumlah']<=3){			
							echo "<div style='padding:5px' class='alert alert-warning'><span class='glyphicon glyphicon-info-sign'></span> Stok  <a style='color:red'>". $q['nama']."</a> yang tersisa sudah kurang dari 3 . silahkan pesan lagi !!</div>";	
						}
					}
					?>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>						
				</div>
				
			</div>
		</div>
	</div>
     
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MENU</li>
       
        <li><a href="index.php"> <i class="fa fa-dashboard"></i><span>Dashboard</span></a></li>
        <li><a href="barang.php"> <i class="fa fa-database"></i><span>Data Barang</span></a></li>
        <!-- <li><a href="profil-petugas"> <i class="fa fa-user"></i><span>Profil</span></a></li> -->
        <?php 
				if($_SESSION['jenis'] == "admin"){ ?>
          <li><a href="barang_laku.php"> <i class="fa fa-book"></i><span>Entry Penjualan</span></a></li>
          <li><a href="member.php"> <i class="fa fa-users"></i><span>Member</span></a></li>
        <?php } ?>
        <?php if ($_SESSION['level'] == 'admin'){ ?>
          <li><a href="karyawan.php"> <i class="fa fa-users"></i><span>Karyawan</span></a></li>
        <?php } ?>
        <li><a href="ganti_foto.php"> <i class="fa fa-image"></i><span>Ganti Foto</span></a></li>
        <li><a href="ganti_pass.php"> <i class="fa fa-lock"></i><span>Ganti Password</span></a></li>
        <li><a href="logout.php"> <i class="fa fa-sign-out"></i><span>Logout</span></a></li>


       
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

 

 