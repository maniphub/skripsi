<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Logat Dayak</title>

  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  
  <link href="../css/sb-admin-2.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard.php">
        <div class="sidebar-brand-icon">
          <!-- <i class="fab fa-twitch"></i> -->
        </div>
        <div class="sidebar-brand-text mx-3">LOGAT DAYAK</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="dashboard.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Interface
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link" href="bindo.php">
          <i class="fas fa-fw fa-table"></i>
          <span>Data Bahasa Indonesia</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="masterdayak.php">
          <i class="fas fa-fw fa-table"></i>
          <span>Data Master Bahasa Dayak</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="bdayak.php">
          <i class="fas fa-fw fa-table"></i>
          <span>Data Kata Bahasa Dayak</span></a>
      </li> 
      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>
          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">
            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Admin</span>
                <img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800">Update Data Bahasa Dayak</h1>
            <br>
            
                
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
              <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Udate Data Bahasa Dayak</h6>
              </div>
              <div class="card-body">
                <div class="table-responsive">

                <?php 
                    include('php/db_connect.php');
                    $id = $_GET['id_dayakkata'];
                    $query = "SELECT * FROM `dayakkata` INNER JOIN bindo ON dayakkata.id_bindo = bindo.id_bindo INNER JOIN dayakmaster ON dayakkata.id_dayakmaster = dayakmaster.id_dayakmaster WHERE dayakkata.id_dayakkata = '$id'";
                    $st=mysqli_query($link,$query);
                    $dt=mysqli_fetch_array($st);

                ?>
                    <form action="php/update_bdayak.php" method="POST"  enctype="multipart/form-data" >

                        <input type="hidden" name="id_dayakkata" class="form-control" id="formGroupExampleInput2" value="<?php echo $dt['id_dayakkata'] ; ?>">
                        
                        <div class="form-group">
                          <label for="sel1">Pilih Bahasa Indonesia</label>
                          <select class="form-control" id="bindo" name="id_bindo" style="width: 100%">
                            <option value="<?php echo $dt ['id_bindo']; ?>"><?php echo $dt ['teks_indo']; ?></option>
                            <?php 
                              include('php/db_connect.php');
                              $bindo = "SELECT * FROM bindo";
                              $bi=mysqli_query($link,$bindo);
                                while ($bt=mysqli_fetch_array($bi)){
                            ?>
                            <option value="<?php echo $bt ['id_bindo']; ?>"><?php echo $bt ['teks_indo']; ?></option>
                            <?php }?>
                          </select>
                        </div>
                          
                        <div class="form-group">
                          <label for="sel1">Pilih Bahasa Dayak</label>
                          <select class="form-control" id="dayakmaster" name="id_dayakmaster" style="width : 100% ">
                            <option value="<?php echo $dt ['id_dayakmaster']; ?>"><?php echo $dt ['dayak_sub']; ?></option>
                          <?php 
                            include('php/db_connect.php');
                            $dayakmaster = "SELECT * FROM dayakmaster";
                            $dyt=mysqli_query($link,$dayakmaster);
                              while ($dty=mysqli_fetch_array($dyt)){
                          ?>
                            <option value="<?php echo $dty ['id_dayakmaster']; ?>"><?php echo $dty ['dayak_sub']; ?></option>
                          <?php }?>
                          </select>
                        </div> 
                        <div class="form-group">
                          <label for="formGroupExampleInput2">Terjemahan</label>
                          <input type="text" name="teks_dayak" class="form-control" id="formGroupExampleInput2" value="<?php echo $dt['teks_dayak'];?>">
                        </div> 
                        <div class="form-group">
                          <label for="formGroupExampleInput2">Suara</label>
                          <input type="file" name="suara_dayak" class="form-control-file" id="exampleFormControlFile1" value="<?php echo $dt['suara_dayak'] ; ?>">
                        </div>   
                        <button type="submit" class="btn btn-primary">Update Data</button>
                    </form>

                </div>
              </div>
            </div>
  
          </div>
          <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Logatdayak.com</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.php">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
  
  <!-- Bootstrap core JavaScript-->
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../js/sb-admin-2.min.js"></script>

  <script>
  $(document).ready(function() {
      $('#bindo').select2();
      $('#dayakmaster').select2();
  });
  </script>

</body>

</html>
