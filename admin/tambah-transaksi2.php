 <?php  
// die(var_dump($_SESSION));
 include 'header.php';

  ?>




 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Entry Penjualan
        <!-- <small>Halaman Utama</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home
        </a></li>
        <li class="active">Entry Penjualan</li>
        <li class="active">Tambah Transaksi</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

       <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Tambah Transaksi</h3>
                </div>
                
                <?php
                $id_barang_laku = $_GET['id'];
                $cek = mysqli_query($conn , "SELECT * FROM barang_laku WHERE id = '$id_barang_laku'");
                $data = mysqli_fetch_object($cek);
                
                ?>
                <!-- /.box-header -->
                <div class="box-body">
                   <form action="barang_laku_act2.php" method="post">
                      <div class="form-group">
                        <label>Jenis Pembeli</label>
                        <select id="jenisPembeli" onchange="setHarga2();" class="form-control" name="jenis" readonly>
                          <option value="umum" <?php if($data->jenis == 'umum') { echo 'selected'; } ?>>Umum</option>
                          <option value="member" <?php if($data->jenis == 'member') { echo 'selected'; } ?>>Member</option>
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
                      
                      <!-- <div class="form-group">
                        <label>Total Harga</label>
                        <input oninput="setHarga2()" id="totalHarga" name="total" type="number" class="form-control" placeholder="Total harga" autocomplete="off">
                      </div>   -->
                      <!-- <div class="form-group">
                        <label>Jumlah Uang</label>
                        <input oninput="setHarga2()" id="jumlahUang" name="jumlahUang" type="number" class="form-control" placeholder="Jumlah Uang Pembeli" autocomplete="off">
                      </div> 
                      <div class="form-group">
                        <label>Kembalian</label>
                        <input oninput="setHarga2()" id="kembalian" name="kembalian" type="number" class="form-control" placeholder="Kembalian" autocomplete="off" required>
                      </div>  -->
                      <div class="form-group">
                            <input id="id_barang_laku" name="id_barang_laku" type="hidden" value="<?= $id_barang_laku ?>">
                            <input id="hidden" name="id" type="hidden">
                            <input type="submit" class="btn btn-primary width-125" value="Tambah">                     
                            <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button> -->
                       </div>
                    
                </form>
                </div>
                <!-- /.box-body -->
          </div>
          <!-- /.box -->








          <div class="box">
            <div class="box-header">
                <h3 class="box-title">List Barang</h3>
            </div>
            <div class="box-body">
            <?php
            $hitung_barang = mysqli_num_rows(mysqli_query($conn , "SELECT * FROM barang_jual WHERE id_barang_laku = '$id_barang_laku' ORDER BY id_barang_jual DESC"));
            if ($hitung_barang > 0) {
            ?>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th style="width: 3%">No</th>
                    <th style="width: 27%">Nama Barang</th>
                    <th style="width: 20%">Harga</th>
                    <th style="width: 20%">Jumlah</th>
                    <th style="width: 20%">#</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                $no = 1;
                $jumlah = 0;
                $harga = 0;
                $cek = mysqli_query($conn , "SELECT * FROM barang_jual WHERE id_barang_laku = '$id_barang_laku' ORDER BY id_barang_jual DESC");
                while($data_barang = mysqli_fetch_array($cek)){
                $id_barang = $data_barang['id_barang'];
                $dataa = mysqli_query($conn , "SELECT * FROM barang WHERE id = '$id_barang'");
                $d = mysqli_fetch_array($dataa);
                $jumlah += $data_barang['harga'];
                $harga += ($d['harga'] - $d['modal']) * $data_barang['jumlah'];
                
                ?>
                  <tr>
                    <td style="width: 3%"><?= $no++ ?></td>
                    <td style="width: 27%"><?= $d['nama'] ?></td>
                    <td style="width: 20%"><?= $data_barang['harga']  ?></td>
                    <td style="width: 20%"><?= $data_barang['jumlah'] ?></td>
                    <td style="width: 20%"> <a onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){ location.href='hapuslist_barang.php?id=<?php echo $data_barang['id_barang_jual']; ?>&c=<?= $id_barang_laku; ?>' }" class="btn btn-danger">Hapus</a> </td>
                  </tr>
                <?php } ?>
                </tbody>
                <tr>
                  <td colspan="3"><b>Total</b></td>
                  <td><b><?= $jumlah ?></b></td>
                  <td></td>
                </tr>
              </table>

              <div class="form-group">
                  <input id="id_barang_laku" name="id_barang_laku" type="hidden" value="<?= $id_barang_laku ?>">
                  <input id="hidden" name="id" type="hidden">
                  <a href="" class="btn btn-primary width-125" data-toggle="modal" data-target="#modal-default">Lanjut</a>
              </div>






              <div class="modal fade" id="modal-default">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Pembayaran</h4>
                    </div>
                    <div class="modal-body">
                      <form action="barang_laku_act3.php" method="post">
                        <div class="form-group">
                          <label>Bayar</label>
                          <input type="hidden" id="id_karyawan" name="id_karyawan" value="<?= $_SESSION['id'] ?>" class="form-control">
                          <input type="hidden" id="id_barang_laku" name="id_barang_laku" value="<?= $id_barang_laku ?>" class="form-control">
                          <input type="hidden" id="harga" name="laba" value="<?= $harga ?>" class="form-control">
                          <input type="hidden" id="asd" name="total" value="<?= $jumlah ?>" class="form-control">
                          <input type="text" oninput="setHarga4()" id="bayar" name="bayar" class="form-control">
                        </div>
                        <div class="form-group">
                          <label>Kembali</label>
                          <input type="text" id="kembaliii" name="kembali" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                      </form>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
              <!-- /.modal -->
              <?php } ?>
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
        function setHarga4() {
          
          var ddd = Number(document.getElementById("asd").value);
          var bayar = Number(document.getElementById("bayar").value);
          // alert(ddd);
          var kembali = document.getElementById("kembaliii")
          kembaliii.value = bayar - ddd;
        }
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
            var jumlahUang = document.getElementById("jumlahUang");
            var kembali = document.getElementById("kembalian");


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