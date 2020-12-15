<?php
    require_once('../config/koneksi.php');
    require_once('../models/database.php');
    include "../models/m_matakuliah.php";

    $connection = new database($host, $user, $pass, $database);
    $mk = new matakuliah($connection);

    $id_mk = $_POST['id_mk'];
    $kode = $connection->conn->real_escape_string($_POST['kode']);
    $matakuliah = $connection->conn->real_escape_string($_POST['matakuliah']);
    $sks = $connection->conn->real_escape_string($_POST['sks']);

    $mk->edit("UPDATE matakuliah SET 
        kode = '$kode', 
        matakuliah = '$matakuliah', 
        sks = '$sks' 
        WHERE id_mk = '$id_mk'");
        echo "<script>window.location='?page=matakuliah'</script>";
?>