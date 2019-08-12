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
        Data Barang
        <small>Terjual</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Entry Penjualan</li>
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
                    $jumlah_record=mysqli_query($conn,"SELECT COUNT(*) from barang");
                    $jum=mysql_result($jumlah_record, 0);
                   
                    ?>

     <div class="row">
        <div class="col-xs-12">
          

          <div class="box">
            <div class="box-header">
              <a href="tambah-transaksi.php">
                
                  <button type="button" class="btn btn-info btn col-md-2">
                    + Entry
                  </button>
              </a>
                <form action="" method="get">
              <div class="input-group col-md-5 col-md-offset-7">
                
               
                <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-calendar"></span></span>
                <select type="submit" name="tanggal" class="form-control" onchange="this.form.submit()">
                  <option>Pilih tanggal ..</option>
                  <?php 
                  $pil=mysqli_query($conn,"SELECT distinct tanggal from barang_laku order by tanggal desc");
                  while($p=mysqli_fetch_array($pil)){
                    ?>
                    <option><?php echo $p['tanggal'] ?></option>
                    <?php
                  }
                  ?>			
                </select>
              </div>

            </form>
            </div>

          


            <!-- /.box-header -->
            <div class="box-body">
              <?php 
                  if(isset($_GET['tanggal'])){
                    $tanggal=mysqli_real_escape_string($conn,$_GET['tanggal']);
                    $tg="lap_barang_laku.php?tanggal='$tanggal'";
                    ?><a style="margin-bottom:10px" href="<?php echo $tg ?>" target="_blank" class="btn btn-default pull-right"><span class='glyphicon glyphicon-print'></span>  Cetak</a><?php
                  }else{
                    $tg="lap_barang_laku.php";
                  }
                  ?>

                  <br/>
                  <?php 
                  if(isset($_GET['tanggal'])){
                    echo "<h4> Data Penjualan Tanggal  <a style='color:blue'> ". $_GET['tanggal']."</a></h4>";
                  }
                  ?>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Tanggal</th>
                  <th>Nama Barang</th>
                  <th>Harga Terjual /pc</th>
                  <th>Total Harga</th>
                  <th>Jumlah</th>
                  <th>Laba</th>
                  <?php if ($_SESSION['level'] == 'admin'){ ?>			
                  <th>Opsi</th>
                  <?php } ?>
                </tr>
                </thead>
               <tbody>
               <?php 
                if(isset($_GET['tanggal'])){
                  $tanggal=mysqli_real_escape_string($conn,$_GET['tanggal']);
                  $brg=mysqli_query($conn,"select * from barang_laku where tanggal like '$tanggal' order by tanggal desc");
                }else{
                  $brg=mysqli_query($conn,"select * from barang_laku order by tanggal desc");
                }
                $no=1;
                while($b=mysqli_fetch_array($brg)){

                  ?>
               
                 <tr>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo $b['tanggal'] ?></td>
                    <td><?php echo $b['nama'] ?></td>
                    <td>Rp.<?php echo number_format($b['harga']) ?>,-</td>
                    <td>Rp.<?php echo number_format($b['total_harga']) ?>,-</td>
                    <td><?php echo $b['jumlah'] ?></td>		
                    <td>Rp.<?php echo number_format($b['laba']) ?>,-</td>   
                    <?php if ($_SESSION['level'] == 'admin'){ ?>	
                    <td>		
                      <a href="edit_laku.php?id=<?php echo $b['id']; ?>" class="btn btn-warning">Edit</a>
                      <a onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){ location.href='hapus_laku.php?id=<?php echo $b['id']; ?>&jumlah=<?php echo $b['jumlah'] ?>&nama=<?php echo $b['nama']; ?>' }" class="btn btn-danger">Hapus</a>
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
            // if(isset($_GET['tanggal'])){
            //   $tanggal=mysqli_real_escape_string($conn,$_GET['tanggal']);
            //   $x=mysqli_query($conn,"select sum(total_harga) as total from barang_laku where tanggal='$tanggal'");	
            //   $xx=mysqli_fetch_array($x);			
            //   $d=mysqli_query($conn,"select sum(laba) as total from barang_laku where tanggal='$tanggal'");	
            //   $dd=mysqli_fetch_array($d);		
              // echo "<td><b> Rp.". number_format($xx['total']).",-</b></td>";
            // }

            ?>
            <!-- /.box-header -->
            <div class="box-body">
                  Total Pemasukan :  
                  <?php 
                    if(isset($_GET['tanggal'])){
                      $tanggal=mysqli_real_escape_string($conn,$_GET['tanggal']);
                      $x=mysqli_query($conn,"select sum(total_harga) as total from barang_laku where tanggal='$tanggal'");	
                      $xx=mysqli_fetch_array($x);		
                      echo "<b> Rp.". number_format($xx['total']).",-</b>";
                    }else{
                      $z=mysqli_query($conn,"select sum(total_harga) as total from barang_laku");  
                      $zz=mysqli_fetch_array($z);   
                      echo "<b> Rp.". number_format($zz['total']).",-</b>";
                    }

                    ?>
                    <br>
                     Total Laba :  
                  <?php 
                    if(isset($_GET['tanggal'])){
                      $tanggal=mysqli_real_escape_string($conn,$_GET['tanggal']);
                     $d=mysqli_query($conn,"select sum(laba) as total from barang_laku where tanggal='$tanggal'");  
                      $dd=mysqli_fetch_array($d);    
                      echo "<b> Rp.". number_format($dd['total']).",-</b>";
                    }
                    else{
                       $r=mysqli_query($conn,"select sum(laba) as total from barang_laku");  
                      $rr=mysqli_fetch_array($r);    
                      echo "<b> Rp.". number_format($rr['total']).",-</b>";
                    }

                    ?>
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
                        
                   <form action="barang_laku_act.php" method="post">
                      <div class="form-group">
                        <label>Tanggal</label>
                       <input type="text" class="form-control" value="<?= date("Y-m-d"); ?>" name="tgl" autocomplete="off" readonly>
                      </div>  
                      <div class="form-group">
                        <label>Jenis Pembeli</label>
                        <select id="jenisPembeli" onchange="setHarga2();" class="form-control" name="jenis">
                          <option value="umum" selected>Umum</option>
                          <option value="member" >Member</option>
                          <!-- <option value="reseller" >Reseller</option> -->
                        </select> 
                      </div>
                      <div class="form-group">
                        <label>Nama Barang</label>                
                        <!-- <select id="DDhargaBarang" onchange="setHarga2()" name="nama" data-show-subtext="true" data-live-search="true"> -->
                          <select class="form-control" name="nama" id="DDhargaBarang" onchange="setHarga2()">
                          <option value="0|0" disabled selected>Pilih Barang</option>
                          <?php 
                          
                          $brg=mysqli_query($conn,"select * from barang");
                          while($b=mysqli_fetch_array($brg)){
                            ?>  
                            <option value="<?= $b['nama'].'|'.$b["harga"].'|'.$b["id"]?>"><?php echo $b['nama'] ?></option>
                            <?php 
                          }
                          ?>
                        </select>

                      </div>                  
                      <div class="form-group">
                        <label id="textHargaJual">Harga Jual / unit (Tanpa Diskon)</label>
                        <input oninput="setHarga2()" id="hargaBarang" name="harga" type="number" class="form-control" placeholder="Harga" autocomplete="off">
                      </div>  
                      <div class="form-group">
                        <label>Jumlah</label>
                        <input oninput="setHarga2()" id="jumlahBarang" name="jumlah" type="number" class="form-control" placeholder="Jumlah" autocomplete="off">
                      </div>    
                      
                      <div class="form-group">
                        <label>Total Harga</label>
                        <input oninput="setHarga2()" id="totalHarga" name="total" type="number" class="form-control" placeholder="Total harga" autocomplete="off">
                      </div>  
                    </div>
                   <div class="modal-footer">
                    <input id="hidden" name="id" type="hidden" value="">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <input type="reset" class="btn btn-danger" value="Reset">                       
                    <input type="submit" class="btn btn-primary" value="Simpan">
                  </div>
                    </form>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
              <!-- /.modal -->

                    


<?php include 'footer.php';?>