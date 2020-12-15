<?php
    class matakuliah {
        private $mysqli;

        function __construct($conn) {
            $this->mysqli = $conn;
        }

        public function tampil($id_mk = null) {
            $db = $this->mysqli->conn;
            $sql = "SELECT * FROM matakuliah";
            if ($id_mk != null) {
                $sql .= " WHERE id_mk = $id_mk";
            }
            $query = $db->query($sql) or die ($db->error);
            return $query;
        }

        public function tambah($kode, $matakuliah, $sks) {
            $db = $this->mysqli->conn;
            $db->query("INSERT INTO matakuliah VALUES ('', '$kode', '$matakuliah', '$sks')") or die ($db->error);
        }

        public function edit($sql) {
            $db = $this->mysqli->conn;
            $db->query($sql) or die ($db->error);
        }

        public function hapus($id_mk) {
            $db = $this->mysqli->conn;
            $db->query("DELETE FROM matakuliah WHERE id_mk = '$id_mk' ") or die ($db->error);
        }

        function __destruct() {
            $db = $this->mysqli->conn;
            $db->close();
        }

    }
?>