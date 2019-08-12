 <?php  include 'header.php'; ?>

 <?php
$a = mysqli_query($conn,"select * from barang_laku");
?>


 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Detail Barang
        <!-- <small>Halaman Utama</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home
        </a></li>
        <li class="active">Data Barang</li>
        <li class="active">Detail Barang</li>
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


                        $det=mysqli_query($conn,"SELECT barang.*,supplier.nama_supplier,jenis_barang.nama_jenis from barang INNER JOIN supplier on barang.id_supplier=supplier.id_supplier INNER JOIN jenis_barang on barang.id_jenis=jenis_barang.id_jenis WHERE barang.id='$id_brg'")or die(mysqli_error());
                        while($d=mysqli_fetch_array($det)){
                            ?>					
                            <table class="table">
                                <tr>
                                    <td>Gambar Barang</td>
                                    <td>
                                        <?php if ($d['foto'] == '') {?>
                                            <img src="foto_barang/default.jpg" style="width:130px; height:100px;" alt="">
                                        <?php } 
                                        else {?>
                                            <img src="foto_barang/<?= $d['foto'];?>" style="width:130px; height:100px;" alt="">
                                        <?php
                                        }
                                        ?>
                                    </td>
                                </tr>
                                  <tr>
                                    <td>Nama Barang</td>
                                    <td><?php echo $d['nama'] ?></td>
                                </tr>
                                <tr>
                                    <td>Jenis Barang</td>
                                    <td><?php echo $d['nama_jenis'] ?></td>
                                </tr>
                                <tr>
                                    <td>Suplier</td>
                                    <td><?php echo $d['nama_supplier'] ?></td>
                                </tr>
                                <tr>
                                    <td>Modal</td>
                                    <td>Rp.<?php echo number_format($d['modal']); ?>,-</td>
                                </tr>
                                <tr>
                                    <td>Harga</td>
                                    <td>Rp.<?php echo number_format($d['harga']) ?>,-</td>
                                </tr>
                                <tr>
                                    <td>Jumlah</td>
                                    <td><?php echo $d['jumlah'] ?></td>
                                </tr>
                                <tr>
                                    <td>Sisa</td>
                                    <td><?php echo $d['sisa'] ?></td>
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