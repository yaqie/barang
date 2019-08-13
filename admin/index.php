 <?php  include 'header.php'; ?>

 <?php
$a = mysqli_query($conn,"select * from barang_laku");
?>


 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Halaman Utama</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home
        </a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

       <div class="callout callout-info">
        <h4>Selamat Datang</h4>

        <p>Selamat Bekerja Di Halaman Administrator</p>
      </div>

      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
                <?php $q =mysqli_num_rows(mysqli_query($conn, "SELECT * from barang"));?>
              <h3><?= $q;?></h3>

              <p>Data Barang</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="barang.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
                <?php $d =mysqli_num_rows(mysqli_query($conn, "SELECT * from barang_laku"));?>
              <h3><?= $d;?></h3>

              <p>Data Penjualan</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="barang_laku.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
                <?php $x =mysqli_num_rows(mysqli_query($conn, "SELECT * from member"));?>
              <h3><?= $x;?></h3>

              <p>Member</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="member.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php   include 'footer.php'; ?>