<?php
    require_once('../config/koneksi.php');
    require_once('../models/database.php');
    include "../models/m_mahasiswa.php";

    $connection = new database($host, $user, $pass, $database);
    $mhs = new mahasiswa($connection);

    $id = $_POST['id'];
    $nim = $connection->conn->real_escape_string($_POST['nim']);
    $nama = $connection->conn->real_escape_string($_POST['nama']);
    $jurusan = $connection->conn->real_escape_string($_POST['jurusan']);
    $prodi = $connection->conn->real_escape_string($_POST['prodi']);
    
    $pict = $_FILES['gambar']['name'];
    $extensi = explode(".", $_FILES['gambar']['name']);
    $gambar = "gbr-".round(microtime(true)).".".end($extensi);
    $sumber = $_FILES['gambar']['tmp_name'];

    if ($pict == '') {
        $mhs->edit("UPDATE mahasiswa SET 
            nim = '$nim', 
            nama = '$nama', 
            jurusan = '$jurusan', 
            prodi = '$prodi' 
            WHERE id = '$id'");
            echo "<script>window.location='?page=mahasiswa'</script>";
    } else {
        $gbr_awal = $mhs->tampil($id)->fetch_object()->gambar;
        unlink("../assets/img/gambarmhs/".$gbr_awal);

        $upload = move_uploaded_file($sumber, "../assets/img/gambarmhs/".$gambar);
        if ($upload) {
            $mhs->edit("UPDATE mahasiswa SET 
                nim = '$nim', 
                nama = '$nama', 
                jurusan = '$jurusan', 
                prodi = '$prodi',
                gambar = '$gambar' 
                WHERE id = '$id'");
            echo "<script>window.location='?page=mahasiswa'</script>";
        } else {
            echo "<script>alert('Upload gambar gagal!')</script>";
        }
    }
?>