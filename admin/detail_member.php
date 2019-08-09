 <?php  include 'header.php'; ?>

 <?php
$a = mysqli_query($conn,"select * from barang_laku");
?>


 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Detail Member
        <!-- <small>Halaman Utama</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home
        </a></li>
        <li class="active">Member</li>
        <li class="active">Detail Member</li>
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
                                <table class="table">
                                    <tr>
                                        <td>Nama Member</td>
                                        <td><?php echo $d['nama_reseller'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Username</td>
                                        <td><?php echo $d['username'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Nomer Hp</td>
                                        <td><?php echo $d['no_hp'] ?></td>
                                    </tr>
                                </table>
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