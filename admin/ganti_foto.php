 <?php  include 'header.php'; ?>

 <?php
$a = mysqli_query($conn,"select * from barang_laku");
?>


 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Ganti Foto
        <!-- <small>Halaman Utama</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home
        </a></li>
        <li class="active">Ganti Foto</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
       <?php
                @session_start();
                if (!empty($_SESSION['info_gagal'])){
                    echo "
                   <div class='alert alert-danger alert-dismissible'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <h4><i class='icon fa fa-ban'></i> Gagal!</h4>
                    $_SESSION[info_gagal]
                  </div>
                    ";
                    unset($_SESSION['info_gagal']);
                }
                if (!empty($_SESSION['sukses'])){
                    echo "
                 <div class='alert alert-success alert-dismissible'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <h4><i class='icon fa fa-check'></i> Berhasil!</h4>
                    $_SESSION[sukses]
                  </div>
                   
                    ";
                    unset($_SESSION['sukses']);
                }
              ?>

       <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <!-- /.box-header -->
                <div class="box-body">
                   <div class="col-md-5 col-md-offset-3">
                      <form action="ganti_foto_act.php" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                          <input name="user" type="hidden" value="<?php echo $_SESSION['uname']; ?>">
                          <input type="hidden" value="<?= $_SESSION['id']; ?>" name="id"/>
                          <input type="hidden" value="<?= $_SESSION['jenis']; ?>" name="jenis"/>
                        </div>
                        <div class="form-group">
                          <label>Foto</label>
                          <input name="foto" type="file" class="form-control" placeholder="Password Lama ..">
                        </div>		
                        <div class="form-group">
                          <label></label>
                          <input type="submit" class="btn btn-info" value="Ganti">
                          <input type="reset" class="btn btn-danger" value="reset">
                        </div>																	
                      </form>
                    </div>
                
                </div>
                <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php   include 'footer.php'; ?>