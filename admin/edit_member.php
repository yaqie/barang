 <?php  include 'header.php'; ?>

 <?php
$a = mysqli_query($conn,"select * from barang_laku");
?>


 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Edit Member
        <!-- <small>Halaman Utama</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home
        </a></li>
        <li class="active">Member</li>
        <li class="active">Edit Member</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

       <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <!-- <h3 class="box-title">Detail Barang</h3> -->
                    &nbsp;
                    &nbsp;
                    <a class="btn pull-right" href="member.php"><span class="glyphicon glyphicon-arrow-left"></span>  Kembali</a>
                </div>

            

                <!-- /.box-header -->
                <div class="box-body">
                 <?php
                        $id_res=mysqli_real_escape_string($conn,$_GET['id']);
                        $det=mysqli_query($conn,"select * from reseller where id_reseller='$id_res'") or die(mysql_error());
                        while($d=mysqli_fetch_array($det)){
                        ?>					
                            <form action="update_member.php" method="post">
                                <table class="table">
                                    <tr>
                                        <td></td>
                                        <td><input type="hidden" name="id_reseller" value="<?php echo $d['id_reseller'] ?>"></td>
                                    </tr>
                                    <tr>
                                        <td>Nama Member</td>
                                        <td><input type="text" class="form-control" name="nama_reseller" value="<?php echo $d['nama_reseller'] ?>"></td>
                                    </tr>
                                    <tr>
                                        <td>Username</td>
                                        <td><input type="text" class="form-control" name="username" value="<?php echo $d['username'] ?>"></td>
                                    </tr>
                                    <tr>
                                        <td>Nomer Hp</td>
                                        <td><input type="text" class="form-control" name="no_hp" value="<?php echo $d['no_hp'] ?>"></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td><input type="submit" class="btn btn-info" value="Edit Data"></td>
                                    </tr>
                                </table>
                            </form>
                            <?php 
                        }
                        ?>
                
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