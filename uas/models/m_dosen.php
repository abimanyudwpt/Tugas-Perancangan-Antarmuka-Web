<?php
    class dosen {
        private $mysqli;

        function __construct($conn) {
            $this->mysqli = $conn;
        }

        public function tampil($id_dsn = null) {
            $db = $this->mysqli->conn;
            $sql = "SELECT * FROM dosen";
            if ($id_dsn != null) {
                $sql .= " WHERE id_dsn = $id_dsn";
            }
            $query = $db->query($sql) or die ($db->error);
            return $query;
        }

        public function tambah($nip, $nama_dsn, $j_kelamin, $gambar_dsn) {
            $db = $this->mysqli->conn;
            $db->query("INSERT INTO dosen VALUES ('', '$nip', '$nama_dsn', '$j_kelamin', '$gambar_dsn')") or die ($db->error);
        }

        public function edit($sql) {
            $db = $this->mysqli->conn;
            $db->query($sql) or die ($db->error);
        }

        public function hapus($id_dsn) {
            $db = $this->mysqli->conn;
            $db->query("DELETE FROM dosen WHERE id_dsn = '$id_dsn' ") or die ($db->error);
        }

        function __destruct() {
            $db = $this->mysqli->conn;
            $db->close();
        }

    }
?>