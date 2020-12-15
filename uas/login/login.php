<?php
    session_start();

    require '../config/functions.php';

    if (isset($_POST["login"])) {
        $username=$_POST["username"];
        $password=$_POST["password"];

        $result = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");

        if (mysqli_num_rows($result)==1) {

            $row = mysqli_fetch_assoc($result);
            
            if (password_verify($password, $row["password"])){
                $_SESSION["login"] = true;
                header("location: ../index.php");
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
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div id="card">
        <div id="card-content">
            <div id="card-title">
                <h2>HALAMAN LOGIN</h2>
                <div class="underline-title"></div>
            </div>
            <form action="" method="post" class="form">
                <label for="user-email" style="padding-top:13px"> Username</label>
                <input type="text" name="username" id="username" class="form-content">
                <div class="form-border"></div>
                <label for="user-password" style="padding-top:22px"> Password</label>
                <input type="password" name="password" id="password" class="form-content">
                <div class="form-border"></div>
                <div class="wrong">
                    <?php if (isset($error)) : ?>
                        <p class="wrong">Username / Password Salah</p>
                    <?php endif; ?>
                </div>
                <button type="submit" name="login" id="submit-btn">Login</button>
                <a href="registrasi.php" id="signup">Buat Akun Disini !</a>
            </form>
        </div>
    </div>
</body>
</html>