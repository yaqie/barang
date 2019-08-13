 <?php  
include 'header.php'; 
// function mysql_result($res, $row, $field=0) { 
//     $res->data_seek($row); 
//     $datarow = $res->fetch_array(); 
//     return $datarow[$field]; 
// }


?>

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data
        <small>Laporan</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Data Laporan</li>
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
            <div class="box-header">
              <h3 class="box-title">Periksa Laporan</h3>
            </div>

            <!-- /.box-header -->
            <div class="box-body">
              <form action="laporan.php" method="get">
                <div class="form-group">
                  <label>Tanggal Pertama</label>
                  <input type="date" class="form-control" name="tgl1" autocomplete="off">
                </div>
                <div class="form-group">
                  <label>Tanggal Kedua</label>
                  <input type="date" class="form-control" name="tgl2" autocomplete="off">
                </div>

                <div class="form-group">
                  <input type="submit" class="btn btn-primary width-125" value="Tampil">                      
                </div>
              </form>
            </div>
            <!-- /.box-body -->




            <?php
            if(isset($_GET['tgl1']) && isset($_GET['tgl2'])){
            ?>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th style="width: 3%">No</th>
                    <th style="width: 27%">Tanggal</th>
                    <th style="width: 27%">Jenis</th>
                    <th style="width: 20%">Barang</th>
                    <th style="width: 20%">Bayar</th>
                    <th style="width: 20%">Kembali</th>
                    <th style="width: 20%">Total Harga</th>
                    <th style="width: 20%">Laba</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                $no = 1;
                $date1 = $_GET['tgl1'];
                $date2 = $_GET['tgl2'];
                $tampil_laporan = mysqli_query($conn , "SELECT * FROM barang_laku WHERE tanggal >= '$date1' AND tanggal <= '$date2'");
                while($dta = mysqli_fetch_object($tampil_laporan)){
                ?>
                  <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $dta->tanggal ?></td>
                    <td><?= $dta->jenis ?></td>
                    
                    <td>
                    <?php
                    $i = 1;
                    $id = $dta->id;
                    $tampil_barang = mysqli_query($conn , "SELECT * FROM barang_jual WHERE id_barang_laku = '$id' ");
                    while($dta2 = mysqli_fetch_object($tampil_barang)){
                      $tampil_barang2 = mysqli_fetch_object(mysqli_query($conn , "SELECT * FROM barang WHERE id = '$dta2->id_barang' "));
                      echo $i++ . ". ". $tampil_barang2->nama . "<br>";
                    }
                    ?>
                    </td>
                    
                    <td><?= "Rp ".number_format($dta->bayar) ?></td>
                    <td><?= "Rp ".number_format($dta->kembali) ?></td>
                    <td><?= "Rp ".number_format($dta->total_harga) ?></td>
                    <td><?= "Rp ".number_format($dta->laba) ?></td>
                  </tr>
                <?php } ?>
                </tbody>
              </table>
              <a href="print.php?tgl1=<?= $date1 ?>&tgl2=<?= $date2 ?>" class="btn btn-danger width-125">Print <i class="fa fa-print"></i></a>
            </div>
            <!-- /.box-body -->
            <?php } ?>
          </div>
          <!-- /.box -->

        

        </div>
        <!-- /.col -->
      </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <script>
        function checkPassword(form) { 
                var password1 = form.pass1.value;
                var password2 = form.pass2.value;
                var nama  = form.nama.value;
                var nomerHp  = form.nomerHp.value;
                var username  = form.username.value;
                

                if(nama == ''){
                    alert ("Nama Belum diisi !"); 
                    return false;
                }

                else if (nomerHp == ''){ 
                    alert ("nomer Hp Belum diisi !"); 
                    return false;
                }

                else if (username == ''){ 
                    alert ("username Belum diisi !"); 
                    return false;
                }

                // If password not entered 
                else if (password1 == ''){ 
                    alert ("Password Belum diisi !"); 
                    return false;
                }

                // If confirm password not entered 
                else if (password2 == ''){ 
                    alert ("Konfirmasi password Belum diisi !"); 
                    return false;
                }

                // If Not same return False.     
                else if (password1 != password2) { 
                    alert ("\nKonfirmasi Password Salah !") 
                    return false; 
                } else{
                    return true;
                }
            } 

</script>

                    



  <?php   include 'footer.php'; ?>