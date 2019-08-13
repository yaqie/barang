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
        <small>Karyawan</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Data Karyawan</li>
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
                    $jumlah_record=mysqli_query($conn,"SELECT COUNT(*) from admin where level = 'karyawan'");
                    $jum=mysql_result($jumlah_record, 0);
                   
                    ?>

     <div class="row">
        <div class="col-xs-12">
          

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Jumlah Record : <?php echo $jum; ?></h3>
              &nbsp;
              &nbsp;
              <a href="#" class="pull-right">
                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal">
                  + Tambah Karyawan
                </button>
              </a>
            </div>

            <!-- modals -->
             <div class="modal fade" id="myModal">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Tambah Data Karyawan</h4>
                    </div>
                    <div class="modal-body">
                        
                   <form id="tambahReseller" action="tambah_karyawan_act.php" method="post">
                      <div class="form-group">
                        <label>Username</label>
                        <input name="username" type="text" class="form-control" placeholder="Username .." required>
                      </div>
                      <div class="form-group">
                        <label>Password</label>
                        <input name="password" type="password" class="form-control" placeholder="Password .." required>
                      </div>
                      <div class="form-group">
                        <label>Nomor Handphone</label>
                        <input name="nohp" type="text" class="form-control" placeholder="Nomor Handphone .." required>
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
                  <th style="width: 27%">Username</th>
                  <th style="width: 27%">Nomor Handphone</th>
                    <th style="width: 30%">Opsi</th>
                </tr>
                </thead>
               <tbody>
                <?php 
                    $i = 0;
                  $qry = mysqli_query($conn,"SELECT * from admin where level = 'karyawan' ORDER by id DESC");
                   while($r = mysqli_fetch_array($qry)){
                      $i++;

                      ?>
               
                 <tr>
                    <td><?= $i;?></td>
                    <td><?= $r['uname'];?></td>
                    <td><?= $r['nohp'];?></td>
                    <td>
                        <?php if ($_SESSION['level'] == 'admin'){ ?>
                        <a href="edit_karyawan.php?id=<?php echo $r['id']; ?>" class="btn btn-warning">Edit</a>
                        <a onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){ location.href='hapus_karyawan.php?id=<?php echo $r['id']; ?>' }" class="btn btn-danger">Hapus</a>
                        <?php } ?>
                    </td>
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