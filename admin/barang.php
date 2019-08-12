 <?php  
include 'header.php'; 
function mysql_result($res, $row, $field=0) { 
    $res->data_seek($row); 
    $datarow = $res->fetch_array(); 
    return $datarow[$field]; 
}


?>

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data
        <small>Barang</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Data Barang</li>
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

              <?php 
                $periksa=mysqli_query($conn,"select * from barang where jumlah <=3");
                while($q=mysqli_fetch_array($periksa)){	
                    if($q['jumlah']<=3){	
                        ?>	
                        <script>
                            $(document).ready(function(){
                                $('#pesan_sedia').css("color","red");
                                $('#pesan_sedia').append("<span class='glyphicon glyphicon-asterisk'></span>");
                            });
                        </script>
                        <?php
                        echo "
                        <div class='alert alert-danger alert-dismissible'>
                            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                            Stok <b>". $q['nama']."</b> yang tersisa sudah kurang dari 3 . silahkan pesan lagi !!
                        </div>
                        ";	
                    }
                }
                ?>

                <?php 
                    $jumlah_record=mysqli_query($conn,"SELECT COUNT(*) from barang");
                    $jum=mysql_result($jumlah_record, 0);
                   
                    ?>

     <div class="row">
        <div class="col-xs-12">
          

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Jumlah Record : <?php echo $jum; ?></h3>
              &nbsp;
              &nbsp;
              &nbsp;
               
              &nbsp;
              <a href="#" class="pull-right">
                  <?php if($_SESSION['jenis'] == "admin"){ ?>
                    
                   
                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal">
                  + Tambah Barang
                 
                </button>
                <a style="margin-bottom:10px" href="lap_barang.php" target="_blank" class="btn btn-default"><span class='glyphicon glyphicon-print'></span>  Cetak</a>&nbsp;
                
                
                <?php } ?>
              </a>
            </div>

            <!-- modals -->
             <div class="modal fade" id="myModal">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Tambah Data Barang</h4>
                    </div>
                    <div class="modal-body">
                        
                    <form action="tmb_brg_act.php" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Nama Barang</label>
                            <input name="nama" type="text" class="form-control" placeholder="Nama Barang ..">
                        </div>
                        <div class="form-group">
                          <label>Jenis Barang</label>
                          <select class="form-control select2" style="width: 100%;" name="jenis">
                            <option>Silahkan Pilih</option>
                           <?php 
                            $qry = mysqli_query($conn, "SELECT * from jenis_barang");
                            while ($r=mysqli_fetch_assoc($qry)) {
                              ?>
                             <option value="<?= $r['id_jenis'] ?>"><?= $r['nama_jenis']?></option>
                             <?php
                            }
                          ?>
                          </select>
                        </div>
                        <div class="form-group">
                          <label>Supplier</label>
                          <select class="form-control select2" style="width: 100%;" name="suplier">
                            <option>Silahkan Pilih</option>
                           <?php 
                            $qry = mysqli_query($conn, "SELECT * from supplier");
                            while ($r=mysqli_fetch_assoc($qry)) {
                              ?>
                             <option value="<?= $r['id_supplier'] ?>"><?= $r['nama_supplier']?></option>
                             <?php
                            }
                          ?>
                          </select>
                        </div>
                        <div class="form-group">
                            <label>Harga Modal</label>
                            <input name="modal" type="text" class="form-control" placeholder="Modal per unit">
                        </div>	
                        <div class="form-group">
                            <label>Harga Jual</label>
                            <input name="harga" type="text" class="form-control" placeholder="Harga Jual per unit">
                        </div>	
                        <div class="form-group">
                            <label>Jumlah</label>
                            <input name="jumlah" type="text" class="form-control" placeholder="Jumlah">
                        </div>	
                        <div class="form-group">
                          <label>Foto Barang</label>
                          <input name="foto" type="file" class="form-control" placeholder="Foto Barang">
                        </div>	
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        <input type="submit" class="btn btn-primary" value="Simpan">
                    </div>
                    </form>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
              <!-- /.modal -->


            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th style="width: 3%">No</th>
                  <th style="width: 27%">Nama Barang</th>
                  <th style="width: 20%">Harga Jual</th>
                  <th style="width: 20%">Jumlah</th>
                  <!-- <th style="width: 10%">Status</th> -->
                  <?php if($_SESSION['jenis'] == "admin"){ ?>
                    <th style="width: 30%">Aksi</th>
                  <?php } ?>
                </tr>
                </thead>
               <tbody>
                <?php 
                    $i = 0;
                  $qry = mysqli_query($conn,"SELECT * from barang ORDER by id DESC");
                   while($r = mysqli_fetch_array($qry)){
                      $i++;

                      ?>
               
                 <tr>
                    <td><?= $i;?></td>
                    <td><?= $r['nama'];?></td>
                    <td><?= number_format($r['harga']);?></td>
                    <td><?= $r['jumlah'];?></td>
                    <?php if($_SESSION['jenis'] == "admin"){ ?>
                    <td>
                        <a href="det_barang.php?id=<?php echo $r['id']; ?>" class="btn btn-info">Detail</a>
                        <?php if ($_SESSION['level'] == 'admin'){ ?>
                        <a href="edit.php?id=<?php echo $r['id']; ?>" class="btn btn-warning">Edit</a>
                        <a onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){ location.href='hapus.php?id=<?php echo $r['id']; ?>' }" class="btn btn-danger">Hapus</a>
                        <?php } ?>
                    </td>
                <?php } ?>
                </tr>
                 <?php
                  }
                 ?>
            

               </tbody>
               
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <div class="box">
            <?php
                    $x=mysqli_query($conn,"select sum(modal) as total from barang");	
                    $xx=mysqli_fetch_array($x);		
                ?>
            <!-- /.box-header -->
            <div class="box-body">
                  Total Modal : <?= "<b> Rp.". number_format($xx['total']).",-</b>";?>
            </div>
            <!-- /.box-body -->
          </div>

        </div>
        <!-- /.col -->
      </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

                    



  <?php   include 'footer.php'; ?>