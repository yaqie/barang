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
                    <!-- <h3 class="box-title">Detail Barang</h3> -->
                    &nbsp;
                    &nbsp;
                    <a class="btn pull-right" href="barang_laku.php"><span class="glyphicon glyphicon-arrow-left"></span>  Kembali</a>
                </div>

            

                <!-- /.box-header -->
                <div class="box-body">
                    <?php
                        $id_brg=mysqli_real_escape_string($conn,$_GET['id']);

                        $det=mysqli_query($conn,"select * from barang_laku where id='$id_brg'")or die(mysql_error());
                        while($d=mysqli_fetch_array($det)){
                            ?>					
                            <form action="update_laku.php" method="post">
                                <table class="table">
                                    <tr>
                                        <td></td>
                                        <td><input type="hidden" id="hidden" name="id" value="<?php echo $d['id'] ?>"></td>
                                    </tr>

                                    <?php 

                                    $tanggal = $d['tanggal'];

                                    function ubahTanggal($tanggal){
                                         $pisah = explode('-',$tanggal);
                                         $array = array($pisah[1],$pisah[2],$pisah[0]);
                                         $satukan = implode('/',$array);
                                         return $satukan;
                                    }

                                    $tgl = ubahTanggal($tanggal);

                                     ?>


                                    <tr>
                                        <td style="width: 30%;">Tanggal</td>
                                        <td style="width: 70%;"><input name="tgl" type="text" class="form-control" id="tgl" autocomplete="off" value="<?= $tgl; ?>"></td>
                                    </tr>
                                
                                      <!-- <tr>
                                          <td>Jenis Pembeli</td>
                                          <td>
                                            <select id="jenisPembeli" onchange="setHarga3();" class="form-control" name="jenis">

                                              <option  value="umum">Umum</option>
                                              <option value="umum">Umum</option>
                                              <option value="member" >Member</option>
                                            </select> 

                                          </td>
                                      </tr> -->
                                    <tr>
                                        <td>Nama</td>
                                        <td>
                                            <select class="form-control" name="nama" id="DDhargaBarang" onchange="setHarga3()">
                                                <?php 
                                                $brg=mysqli_query($conn,"select * from barang");
                                                while($b=mysqli_fetch_array($brg)){
                                                    ?>	
                                                    <option <?php if($d['nama']==$b['nama']){echo "selected"; } ?> value="<?php echo $b['nama'].'|'.$b["harga"].'|'.$b["id"]; ?>"><?php echo $b['nama'] ?></option>
                                                    <?php 
                                                }
                                                ?>
                                            </select>
                                        </td>
                                    </tr>		

                                    <tr>
                                        <td><span id="textHargaJual">Harga Jual / unit (Tanpa Diskon)</span></td>
                                        <td><input type="number" oninput="setHarga3()" id="hargaBarang" class="form-control" name="harga" value="<?php echo $d['harga'] ?>"></td>
                                    </tr>
                                    <tr>
                                        <td>Jumlah</td>
                                        <td><input type="number" oninput="setHarga3()" id="jumlahBarang" class="form-control" name="jumlah" value="<?php echo $d['jumlah'] ?>"></td>
                                    </tr>

                                        <input oninput="setHarga3()" id="totalHarga" name="total" type="hidden" class="form-control" placeholder="Total harga" autocomplete="off" value="<?php echo $d['total_harga'] ?>">
                               
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