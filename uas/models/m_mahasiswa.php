<?php    
    class mahasiswa {
        private $mysqli;

        function __construct($conn) {
            $this->mysqli = $conn;
        }

        public function tampil($id = null) {
            $db = $this->mysqli->conn;
            $sql = "SELECT * FROM mahasiswa";
            if ($id != null) {
                $sql .= " WHERE id = $id";
            }
            $query = $db->query($sql) or die ($db->error);
            return $query;
        }

        public function tambah($nim, $nama, $jurusan, $prodi, $gambar) {
            $db = $this->mysqli->conn;
            $db->query("INSERT INTO mahasiswa VALUES ('', '$nim', '$nama', '$jurusan', '$prodi', '$gambar')") or die ($db->error);
        }

        public function edit($sql) {
            $db = $this->mysqli->conn;
            $db->query($sql) or die ($db->error);
        }

        public function hapus($id) {
            $db = $this->mysqli->conn;
            $db->query("DELETE FROM mahasiswa WHERE id = '$id' ") or die ($db->error);
        }

        function __destruct() {
            $db = $this->mysqli->conn;
            $db->close();
        }

    }
?>