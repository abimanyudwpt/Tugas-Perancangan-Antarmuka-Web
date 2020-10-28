<?php
    $conn = mysqli_connect("localhost","root","","phpdasar");

    function query($query){
        global $conn;
        $result = mysqli_query($conn, $query);
        $rows = [];
        while ( $row = mysqli_fetch_assoc($result) ) {
            $rows[] = $row;
        }
        return $rows;
    }

    function tambah ($data) {
        global $conn;

        $nim= htmlspecialchars($data["nim"]);
        $nama= htmlspecialchars($data["nama"]);
        $prodi= htmlspecialchars($data["prodi"]);
        $jurusan= htmlspecialchars($data["jurusan"]);

        $query = "INSERT INTO mahasiswa VALUES ('','$nim','$nama','$prodi','$jurusan')";
        mysqli_query($conn, $query);
        return mysqli_affected_rows($conn);
    }

    function hapus($id){
        global $conn;
        mysqli_query($conn, "DELETE FROM mahasiswa WHERE id=$id");

        return mysqli_affected_rows($conn);
    }

    function ubah($data){
        global $conn;

        $id= $data["id"];
        $nim= htmlspecialchars($data["nim"]);
        $nama= htmlspecialchars($data["nama"]);
        $prodi= htmlspecialchars($data["prodi"]);
        $jurusan= htmlspecialchars($data["jurusan"]);

        $query = "UPDATE mahasiswa SET
                    id = '$id', 
                    nim = '$nim',
                    nama = '$nama',
                    prodi = '$prodi',
                    jurusan = '$jurusan'
                 WHERE id = $id
                 ";
        mysqli_query($conn, $query);
        return mysqli_affected_rows($conn);
    }

    function registrasi($data){
        global $conn;

        $username = strtolower(stripslashes($data["username"]));
        $password = mysqli_real_escape_string($conn, $data["password"]);
        $password2 = mysqli_real_escape_string($conn, $data["password2"]);

        if ($password !== $password2) {
            echo "<script>
                    alert ('Konfirmasi password tidak sesuai !');
                  </script>";
            return false;
        }

        $result =mysqli_query($conn, "SELECT username FROM users WHERE username = '$username'");
        if (mysqli_fetch_assoc($result)) {
            echo "<script>
                    alert ('Username sudah terdaftar !');
                  </script>";
            return false;
        }

        $password = password_hash($password, PASSWORD_DEFAULT);
        mysqli_query($conn, "INSERT INTO users VALUES ('','$username','$password')");
        
        return mysqli_affected_rows($conn);
    }

?>