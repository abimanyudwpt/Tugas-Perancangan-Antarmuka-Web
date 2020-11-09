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

        $gambar= upload();
        if (!$gambar) {
            return false;
        }

        $query = "INSERT INTO mahasiswa VALUES ('','$nim','$nama','$prodi','$jurusan','$gambar')";
        mysqli_query($conn, $query);
        return mysqli_affected_rows($conn);
    }

    function upload(){
        $namafile = $_FILES['gambar']['name'];
        $ukuranfile = $_FILES['gambar']['size'];
        $error = $_FILES['gambar']['error'];
        $tmpname = $_FILES['gambar']['tmp_name'];

        if ($error===4) {
            echo "<script>
                    alert('Upload gambar terlebih dahulu !');
                  </script>";
            return false;
        }

        $ekstensigambarvalid = ['jpg','jpeg','png'];
        $ekstensigambar = explode('.', $namafile);
        $ekstensigambar = strtolower(end($ekstensigambar));
        if ( !in_array($ekstensigambar, $ekstensigambarvalid) ) {
            echo "<script>
                    alert('Yang anda upload bukan gambar !');
                  </script>";
            return false;
        }
        if ( $ukuranfile > 2000000 ) {
            echo "<script>
                    alert('Ukuran gambar terlalu besar !');
                  </script>";
            return false;
        }

        $namafilebaru = uniqid();
        $namafilebaru .= '.';
        $namafilebaru .= $ekstensigambar;

        move_uploaded_file($tmpname,'img/' .  $namafilebaru);
        return $namafilebaru;
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
        $gambarlama=htmlspecialchars($data["gambarlama"]);

        if ( $_FILES['gambar']['error'] === 4 ) {
            $gambar = $gambarlama;
        }else {
            $gambar = upload();
        }

        
        $query = "UPDATE mahasiswa SET
                    id = '$id', 
                    nim = '$nim',
                    nama = '$nama',
                    prodi = '$prodi',
                    jurusan = '$jurusan'
                    gambar = '$gambar'
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