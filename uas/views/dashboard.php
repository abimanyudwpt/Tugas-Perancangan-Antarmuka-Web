<?php
    if (!isset($_SESSION["login"])) {
        session_start();
        header("Location: ../login/login.php");
        exit;
    }
?>
<div class="row">
  <div class="col-lg-12">
    <h1>Wellcome <small>Admin</small></h1>
  </div>
</div>
<div class="row">
  <div class="col-lg-12">
    Selamat Datang
  </div>
</div>

