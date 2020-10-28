<?php
    require 'functions.php';

    if ( isset($_POST["register"]) ) {
        if (registrasi ($_POST) > 0 ) {
            echo "<script>
                    alert ('User baru berhasil ditambahkan!');
                    document.location.href = 'login.php';
                  </script>";
        }else {
            echo mysqli_error($conn);
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>
</head>
<body>
    <h1>Registrasi</h1>
    <form action="" method="post">
        <table>
            <tr>
                <td>Username</td>
                <td>:</td>
                <td><input type="text" name="username" id="username"></td>
            </tr>
            <tr>
                <td>Password</td>
                <td>:</td>
                <td><input type="password" name="password" id="password"></td>
            </tr>
            <tr>
                <td>Konfirmasi Password</td>
                <td>:</td>
                <td><input type="password" name="password2" id="password2"></td>
            </tr>
            <tr>
                <td colspan="3"><button type="submit" name="register">Register</button></td>
            </tr>
    </form>
</body>
</html>