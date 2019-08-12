 <?php  include 'header.php'; ?>

 <?php
$a = mysqli_query($conn,"select * from barang_laku");
?>


 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Edit Barang
        <!-- <small>Halaman Utama</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home
        </a></li>
        <li class="active">Data Barang</li>
        <li class="active">Edit Barang</li>
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
                    <a class="btn pull-right" href="barang.php"><span class="glyphicon glyphicon-arrow-left"></span>  Kembali</a>
                </div>

            

                <!-- /.box-header -->
                <div class="box-body">
                  <?php
                    $id_brg=mysqli_real_escape_string($conn,$_GET['id']);
                    $det=mysqli_query($conn,"select * from barang where id='$id_brg'")or die(mysql_error());
                    while($d=mysqli_fetch_array($det)){
                    ?>					
                        <form action="update.php" method="post" enctype="multipart/form-data">
                            <table class="table">
                                <tr>
                                    <td></td>
                                    <td><input type="hidden" name="id" value="<?php echo $d['id'] ?>"></td>
                                </tr>
                                <tr>
                                    <td>Nama</td>
                                    <td><input type="text" class="form-control" name="nama" value="<?php echo $d['nama'] ?>"></td>
                                </tr>
                                <tr>
                                    <td>Jenis</td>
                                    <td>
                                        <select class="form-control select2" style="width: 100%;" name="jenis">
                                       <?php 
                                        $qry = mysqli_query($conn, "SELECT * from jenis_barang");
                                        while ($r=mysqli_fetch_assoc($qry)) {
                                          ?>
                                         <option <?php if ($d['id_jenis'] == $r['id_jenis']) {
                                             echo "selected";
                                         } ?> value="<?= $r['id_jenis'] ?>"><?= $r['nama_jenis']?></option>
                                         <?php
                                        }
                                      ?>
                                      </select>
                                  </td>
                                </tr>
                                <tr>
                                    <td>Suplier</td>
                                    <td>
                                         <select class="form-control select2" style="width: 100%;" name="suplier">
                                       <?php 
                                        $qry = mysqli_query($conn, "SELECT * from supplier");
                                        while ($r=mysqli_fetch_assoc($qry)) {
                                          ?>
                                         <option <?php if ($d['id_supplier'] == $r['id_supplier']) {
                                             echo "selected";
                                         } ?> value="<?= $r['id_supplier'] ?>"><?= $r['nama_supplier']?></option>
                                         <?php
                                        }
                                      ?>
                                      </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Modal</td>
                                    <td><input type="text" class="form-control" name="modal" value="<?php echo $d['modal'] ?>"></td>
                                </tr>
                                <tr>
                                    <td>Harga</td>
                                    <td><input type="text" class="form-control" name="harga" value="<?php echo $d['harga'] ?>"></td>
                                </tr>
                                <tr>
                                    <td>Jumlah</td>
                                    <td><input type="text" class="form-control" name="jumlah" value="<?php echo $d['jumlah'] ?>"></td>
                                </tr>
                                 <tr>
                                    <td>Foto Barang</td>
                                    <td><input name="foto" type="file" class="form-control" value="<?php echo $d['foto'] ?>"></td>
                                </tr>
                                <!-- <div class="form-group">
                                    <label>Foto Barang</label>
                                    <input name="foto" type="file" class="form-control" value="<?php echo $d['foto'] ?>">
                                </div>	 -->
                                <tr>
                                    <td></td>
                                    <td><input type="submit" class="btn btn-info" value="Edit Barang"></td>
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