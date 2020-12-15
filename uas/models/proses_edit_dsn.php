<?php
    require_once('../config/koneksi.php');
    require_once('../models/database.php');
    include "../models/m_dosen.php";

    $connection = new database($host, $user, $pass, $database);
    $dsn = new dosen($connection);

    $id_dsn = $_POST['id_dsn'];
    $nip = $connection->conn->real_escape_string($_POST['nip']);
    $nama_dsn = $connection->conn->real_escape_string($_POST['nama_dsn']);
    $j_kelamin = $connection->conn->real_escape_string($_POST['j_kelamin']);
    
    $pict = $_FILES['gambar_dsn']['name'];
    $extensi = explode(".", $_FILES['gambar_dsn']['name']);
    $gambar_dsn = "gbr-".round(microtime(true)).".".end($extensi);
    $sumber = $_FILES['gambar_dsn']['tmp_name'];

    if ($pict == '') {
        $dsn->edit("UPDATE dosen SET 
            nip = '$nip', 
            nama_dsn = '$nama_dsn', 
            j_kelamin = '$j_kelamin'
            WHERE id_dsn = '$id_dsn'");
            echo "<script>window.location='?page=dosen'</script>";
    } else {
        $gbr_awal = $dsn->tampil($id)->fetch_object()->gambar_dsn;
        unlink("../assets/img/gambardsn/".$gbr_awal);

        $upload = move_uploaded_file($sumber, "../assets/img/gambardsn/".$gambar_dsn);
        if ($upload) {
            $dsn->edit("UPDATE dosen SET 
                nip = '$nip', 
                nama_dsn = '$nama_dsn', 
                j_kelamin = '$j_kelamin',
                gambar_dsn = '$gambar_dsn' 
                WHERE id_dsn = '$id_dsn'");
            echo "<script>window.location='?page=dosen'</script>";
        } else {
            echo "<script>alert('Upload gambar gagal!')</script>";
        }
    }
?>