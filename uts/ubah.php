<?php
    session_start();
    if (!isset($_SESSION["login"])) {
        header("Location: login.php");
        exit;
    }
require'functions.php';

$id = $_GET["id"];

$mhs = query("SELECT * FROM mahasiswa WHERE id = $id")[0];

if( isset($_POST["submit"]) ) {
   if(ubah ($_POST) > 0 ){
       echo"
        <script>
            alert('Data berhasil diubah !');
            document.location.href = 'index.php';
        </script>
       ";
   }else {
       echo"
        <script>
            alert('Data gagal diubah !');
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
    <title>Update Data Mahasiswa</title>
</head>
<body>
    <h1>Ubah Data Mahasiswa</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $mhs["id"]; ?>">
        <input type="hidden" name="gambarlama" value="<?= $mhs["gambar"]; ?>">
       <table>
          <tr>
             <td>NIM</td>
             <td>:</td>
             <td><input type="text" name="nim" id="nim" value="<?= $mhs["nim"]; ?>"></td>
          </tr>
          <tr>
             <td>Nama</td>
             <td>:</td>
             <td><input type="text" name="nama" id="nama" value="<?= $mhs["nama"]; ?>"> </td>
          </tr>
          <tr>
             <td>Prodi</td>
             <td>:</td>
             <td><input type="text" name="prodi" id="prodi" value="<?= $mhs["prodi"]; ?>"></td>
          </tr>
          <tr>
             <td>Jurusan</td>
             <td>:</td>
             <td><input type="text" name="jurusan" id="jurusan" value="<?= $mhs["jurusan"]; ?>"></td>
          </tr>
          <tr>
             <td>Gambar</td>
             <td>:</td>
             <td> <img src="img/<?= $mhs['gambar']; ?>" width="40"> <input type="file" name="gambar" id="gambar"></td>
          </tr>
          <tr align="right">
             <td colspan="3"><button type="submit" name="submit">Ubah Data</button></td>
          </tr>
       </table>
    </form>
</body>
</html>