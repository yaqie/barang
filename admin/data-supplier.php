 <?php  
include 'header.php'; 


?>

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data
        <small>Supplier</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Data Supplier</li>
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
                    $jum=mysqli_num_rows(mysqli_query($conn,"SELECT id_supplier from supplier"));
                    
                   
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
                  + Tambah Supplier
                </button>
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
                      <h4 class="modal-title">Tambah Supplier</h4>
                    </div>
                    <div class="modal-body">
                        
                    <form action="master-data-act.php?aksi=tambah-supplier" method="post" role="form">
                        <div class="form-group">
                            <label>Nama Supplier</label>
                            <input name="nama_supplier" type="text" class="form-control" placeholder="Nama Supplier ..">
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
                  <th style="width: 27%">Id Supplier</th>
                  <th style="width: 20%">Nama Supplier</th>
                  <!-- <th style="width: 10%">Status</th> -->
                  <?php if($_SESSION['jenis'] == "admin"){ ?>
                    <th style="width: 30%">Aksi</th>
                  <?php } ?>
                </tr>
                </thead>
               <tbody>
                <?php 
                    $i = 0;
                  $qry = mysqli_query($conn,"SELECT * from supplier ORDER by id_supplier DESC");
                   while($r = mysqli_fetch_array($qry)){
                      $i++;

                      ?>
               
                 <tr>
                    <td><?= $i;?></td>
                    <td><?= $r['id_supplier'];?></td>
                    <td><?= $r['nama_supplier'];?></td>
                    <?php if($_SESSION['jenis'] == "admin"){ ?>
                    <td>
                        <?php if ($_SESSION['level'] == 'admin'){ ?>
                      <!--   <a href="edit.php?id=<?php echo $r['id']; ?>" class="btn btn-warning">Edit</a>
                        <a onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){ location.href='hapus.php?id=<?php echo $r['id']; ?>' }" class="btn btn-danger">Hapus</a> -->
                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#myy<?= $r['id_supplier']; ?>" title="Edit Data">Edit Data</button>
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#id<?= $r['id_supplier'];?>" title="Hapus Data">Hapus Data</button>
                      
                        <?php } ?>

                      
                        <!-- modals Hapus Laporan-->
                         <div class="modal fade" id="id<?= $r['id_supplier'];?>">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                  <h4 class="modal-title">Hapus Data Supplier</h4>
                                </div>
                                <div class="modal-body">
                                  <form class="form-horizontal" action="master-data-act.php?aksi=hapus-supplier" method="POST" role="form">
                                    <p align="left">Apakah anda yakin ingin menghapus supplier ini?</p>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                  <button type="submit" class="btn btn-danger" name="hapus" value="<?= $r['id_supplier'];?>">Ya, Saya yakin</button>
                                  </form>
                                </div>
                              </div>
                              <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                          </div>
                        <!-- /.modal -->

                         <!-- modals -->
                         <div class="modal fade" id="myy<?= $r['id_supplier']; ?>">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                  <h4 class="modal-title">Edit Supplier</h4>
                                </div>
                                <div class="modal-body">
                                    
                                <form action="master-data-act.php?aksi=edit-supplier" method="post" role="form">
                                    <div class="form-group">
                                        <label>Nama Supplier</label>
                                        &nbsp;
                                        &nbsp;
                                        &nbsp;
                                        &nbsp;

                                        <input name="id" type="hidden" class="form-control" value="<?= $r['id_supplier']?>">
                                          
                                        <input name="nama" type="text" class="form-control" value="<?= $r['nama_supplier']?>">
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


        </div>
        <!-- /.col -->
      </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

                    



  <?php   include 'footer.php'; ?>