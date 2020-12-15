<?php
  session_start();
    if (!isset($_SESSION["login"])) {
        header("Location: login/login.php");
        exit;
    }
  ob_start();
  require_once('config/koneksi.php');
  require_once('models/database.php');

  $connection = new database($host, $user, $pass, $database);
  
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">

    <!-- Add custom CSS here -->
    <link href="assets/css/sb-admin.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
  </head>

  <body>
    <div id="wrapper">

      <!-- Sidebar -->
      <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="?page=dashboard">Admin</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
          <ul class="nav navbar-nav side-nav">
            <li><a href="?page=dashboard"><i class="fa fa-desktop"></i> Wellcome</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-table"></i> Mahasiswa <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="?page=mahasiswa"><i class="fa fa-edit"></i> Data Mahasiswa</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-table"></i> Dosen <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="?page=dosen"><i class="fa fa-edit"></i> Data Dosen</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-table"></i> Matakuliah <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="?page=matakuliah"><i class="fa fa-edit"></i> Daftar Matakuliah</a></li>
              </ul>
            </li>
          </ul>
          <ul class="nav navbar-nav navbar-right navbar-user">
            <li class="dropdown user-dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> Admin <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="login/logout.php"><i class="fa fa-power-off"></i> Log Out</a></li>
              </ul>
            </li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </nav>

      <div id="page-wrapper">

        <?php
          if(@$_GET['page'] == 'dashboard' || @$_GET['page'] == '') {
            include "views/dashboard.php";
          } elseif (@$_GET['page'] == 'mahasiswa') {
            include "views/mahasiswa.php";
          } elseif (@$_GET['page'] == 'dosen') {
             include "views/dosen.php";
          } elseif (@$_GET['page'] == 'matakuliah') {
             include "views/matakuliah.php";
          } 
        ?>

      </div><!-- /#page-wrapper -->

    </div><!-- /#wrapper -->

    <!-- JavaScript -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <script src="assets/js/bootstrap.js"></script>

  </body>
</html>