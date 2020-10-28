<?php
    session_start();
    if (!isset($_SESSION["login"])) {
        header("Location: login.php");
        exit;
    }

require'functions.php';
$conn = mysqli_connect("localhost","root","","phpdasar");

if( isset($_POST["submit"]) ) {
   if(tambah ($_POST) > 0 ){
       echo"
        <script>
            alert('Data berhasil ditambahkan !');
            document.location.href = 'index.php';
        </script>
       ";
   }else {
       echo"
        <script>
            alert('Data gagal ditambahkan !');
            document.location.href='index.php';
        </script>
       ";
   }
   
}
?>

<!DOCTYPE html>
<html lang="en">
<body bgcolor="#f5f6fa">
<html>
<head>
    <title>Tambah Data Mahasiswa</title>
</head>
<body>
    <h1>Tambahkan Data Mahasiswa</h1>
    <form action="" method="post">
       <table>
          <tr>
             <td>NIM</td>
             <td>:</td>
             <td><input type="text" name="nim" id="nim"></td>
          </tr>
          <tr>
             <td>Nama</td>
             <td>:</td>
             <td><input type="text" name="nama" id="nama"></td>
          </tr>
          <tr>
             <td>Prodi</td>
             <td>:</td>
             <td><input type="text" name="prodi" id="prodi"></td>
          </tr>
          <tr>
             <td>Jurusan</td>
             <td>:</td>
             <td><input type="text" name="jurusan" id="jurusan"></td>
          </tr>
          <tr align="right">
             <td colspan="3"><button type="submit" name="submit">Tambah Data</button></td>
          </tr>
       </table>
    </form>
</body>
</html>