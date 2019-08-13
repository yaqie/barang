<script>window.onload = function() { window.print(); }</script>
 <?php  
// die(var_dump($_SESSION));
 include 'header.php';

  ?>




 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Edit Barang Penjualan
        <!-- <small>Halaman Utama</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home
        </a></li>
        <li class="active">Entry Penjualan</li>
        <li class="active">Edit Barang Penjualan</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

       <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Detail Barang</h3>
                    &nbsp;
                    &nbsp;
                    <!-- <a class="btn pull-right" href="barang_laku.php"><span class="glyphicon glyphicon-arrow-left"></span>  Kembali</a> -->
                </div>

            

                <!-- /.box-header -->
                <div class="box-body">
                <?php 
                  $id=$_SESSION['id'];
                  $jenis = $_SESSION['jenis'];

                  $barang_lakuuu=mysqli_fetch_array(mysqli_query($conn,"select * from barang_laku where id='$_GET[id]'"));
                  $fo=mysqli_fetch_array(mysqli_query($conn,"select * from admin where id='$barang_lakuuu[id_karyawan]'"));
                ?>
                <h4>Nama Karyawan : <?= $fo['uname'] ?></h4>
                <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th style="width: 3%">No</th>
                    <th style="width: 27%">Nama Barang</th>
                    <th style="width: 20%">Harga</th>
                    <th style="width: 20%">Jumlah</th>
                    <!-- <th style="width: 20%">#</th> -->
                  </tr>
                </thead>
                <tbody>
                <?php
                $id_barang_laku = $_GET['id'];
                $no = 1;
                $jumlah = 0;
                $harga = 0;
                $jumlah_barang = 0;
                $cek = mysqli_query($conn , "SELECT * FROM barang_jual WHERE id_barang_laku = '$id_barang_laku' ORDER BY id_barang_jual DESC");
                while($data_barang = mysqli_fetch_array($cek)){
                $id_barang = $data_barang['id_barang'];
                $dataa = mysqli_query($conn , "SELECT * FROM barang WHERE id = '$id_barang'");
                $d = mysqli_fetch_array($dataa);
                $jumlah += $data_barang['harga'];
                $jumlah_barang += $data_barang['jumlah'];
                $harga += ($d['harga'] - $d['modal']) * $data_barang['jumlah'];
                ?>
                  <tr>
                    <td style="width: 3%"><?= $no++ ?></td>
                    <td style="width: 27%"><?= $d['nama'] ?></td>
                    <td style="width: 20%"><?= $data_barang['harga']  ?></td>
                    <td style="width: 20%"><?= $data_barang['jumlah'] ?></td>
                    <!-- <td style="width: 20%"> <a onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){ location.href='hapuslist_barang.php?id=<?php echo $data_barang['id_barang_jual']; ?>&c=<?= $id_barang_laku; ?>' }" class="btn btn-danger">Hapus</a> </td> -->
                  </tr>
                <?php } ?>
                </tbody>
                <tr>
                  <td colspan="2"><b>Total</b></td>
                  <td><b><?= $jumlah ?></b></td>
                  <td><b><?= $jumlah_barang ?></b></td>
                </tr>
              </table>




                
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

  <script type="text/javascript">
    


    $(document).ready(function(){
      $("#tgl2").datepicker({dateFormat : 'yy/mm/dd', autoclose: true});              
    });

    // function setHarga2a(){
    //   let DDjenis = document.getElementById("jenisPembeli");
    //   let jenis = DDjenis.options[DDjenis.selectedIndex].value;
    //   let textHargaJual = document.getElementById("textHargaJual");

    //   if(jenis == "umum"){
    //     textHargaJual.innerHTML = "Harga Jual / unit (Tanpa Diskon)";
    //   } else if (jenis == "member"){
    //     textHargaJual.innerHTML = "Harga Jual / unit (Diskon 6%)";
    //   } else {
    //     textHargaJual.innerHTML = "Jenis tidak diketahui";
    //   }
      
    // }

        function setHarga3() {
            
            // var data = e.target.value;
            var dd = document.getElementById("DDhargaBarang");
            var data = dd.options[dd.selectedIndex].value;
            var pecah = data.split('|');
            var harga = Number(pecah[1]);
            var idBarang = Number(pecah[2]);
            // alert(idBarang);
            var hargaBarang = document.getElementById("hargaBarang");
            // // alert(document.getElementById("jumlahBarang").value);
            var DDjenis = document.getElementById("jenisPembeli");
            var jenis = DDjenis.options[DDjenis.selectedIndex].value;
            var hidden = document.getElementById("hidden");
            hidden.value = idBarang;
            var jumlah = Number(document.getElementById("jumlahBarang").value);
            var totalHarga = document.getElementById("totalHarga");
            // var diskon6 = harga - (harga*6/100);
            // var diskon10 = harga - (harga*10/100)



            if(jenis == "umum"){
                hargaBarang.value = harga;
                document.getElementById("textHargaJual").innerHTML  = "Harga Jual / unit (Tanpa Diskon)";
                totalHarga.value = hargaBarang.value * jumlah;
            } else if (jenis == "member"){
                document.getElementById("textHargaJual").innerHTML  = "Harga Jual / unit (Diskon 6%)";
                hargaBarang.value = diskon6;
                totalHarga.value = hargaBarang.value * jumlah;
            } else if (jenis == "reseller"){
                // document.getElementById("textHargaJual").innerHTML  = "Harga Jual / unit (beli 10pcs diskon 10%)";
                // if(jumlah < 10){
                //     hargaBarang.value = harga;
                //     totalHarga.value = hargaBarang.value * jumlah;
                // } else {
                //     hargaBarang.value = diskon10;
                //     totalHarga.value = hargaBarang.value * jumlah;
                // }
            }

             
        }
  </script>

  <?php   include 'footer.php'; ?>