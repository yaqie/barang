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
                    &nbsp;
                    &nbsp;
                    <a class="btn pull-right" href="barang_laku.php"><span class="glyphicon glyphicon-arrow-left"></span>  Kembali</a>
                </div>

            

                <!-- /.box-header -->
                <div class="box-body">
                   <form action="barang_laku_act.php" method="post">
                      <!-- <div class="form-group">
                        <label>Tanggal</label>
                       <input type="text" class="form-control" value="<?= date("Y-m-d"); ?>" name="tgl" autocomplete="off" readonly>
                      </div>   -->
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