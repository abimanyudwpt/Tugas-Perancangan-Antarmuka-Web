<?php
    session_start();
    if($_SESSION['nama_lengkap']=='')
    {
        header("location:login.php");
    }
    ?>

    Selamat Datang Admin <?php echo $_SESSION['nama_lengkap']?>

