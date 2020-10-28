<?php
    session_start();

    require 'functions.php';

    if (isset($_POST["login"])) {
        $username=$_POST["username"];
        $password=$_POST["password"];

        $result = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");

        if (mysqli_num_rows($result)==1) {

            $row = mysqli_fetch_assoc($result);
            
            if (password_verify($password, $row["password"])){
                $_SESSION["login"] = true;
                header("Location: index.php");
                exit;
            }
        }
        $error = true;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1>Halaman Login</h1>

    <?php if (isset($error)) : ?>
        <p>Username / Password Salah</p>
    <?php endif; ?>

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
                <td colspan="3">Buat akun <a href="registrasi.php">disini</a></td>
            </tr>
            <tr align="right">
                <td colspan="3"><button type="submit" name="login">Login</button></td>
            </tr>
    </form>
</body>
</html>