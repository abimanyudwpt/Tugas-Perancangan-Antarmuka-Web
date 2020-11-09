<?php
    session_start();
    if (!isset($_SESSION["login"])) {
        header("Location: login.php");
        exit;
    }

    require 'functions.php';
    $mahasiswa = query("SELECT * FROM mahasiswa");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="style2.css">
</head>
<body>
    <h1>Daftar Data Mahasiswa </h1>
    <a href="tambah.php" class="btn">Tambah Data</a>
    <a href="logout.php" class="btn">Logout</a>
    <br><br>
    <table border="1" cellpadding="10" cellspacing="0" class="table">
        <tr>
            <th>#</th>
            <th>Gambar</th>
            <th>NIM</th>
            <th>Nama</th>
            <th>Prodi</th>
            <th>Jurusan</th>
            <th>Action</th>
        <tr>
        <?php $i=1; ?>
        <?php foreach ($mahasiswa as $row) : ?>
        <tr>
            <td><?= $i ?></td>
            <td><img src="img/<?= $row["gambar"]; ?>" width="50"></td>
            <td><?= $row["nim"]; ?></td>
            <td><?= $row["nama"]; ?></td>
            <td><?= $row["prodi"]; ?></td>
            <td><?= $row["jurusan"]; ?></td>
            <td>
                <a href="ubah.php?id=<?=$row["id"];?>" class="btn">Ubah</a> | 
                <a href="hapus.php?id=<?=$row["id"];?>" onclick="return confirm ('Yakin ?');" class="btn">Hapus</a>
            </td>
        </tr>
        <?php $i++; ?>
        <?php endforeach; ?>
    </table>
</body>
</html>