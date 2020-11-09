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
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div id="card">
    <div id="card-content">
        <div id="card-title">
            <h2>REGISTRASI</h2>
            <div class="underline-title"></div>
        </div>
        <form action="" method="post" class="form">
            <label for="user-email" style="padding-top:13px"> Username</label>
            <input type="text" name="username" id="username" class="form-content">
            <div class="form-border"></div>
            <label for="user-password" style="padding-top:22px"> Password</label>
            <input type="password" name="password" id="password" class="form-content">
            <div class="form-border"></div>
            <label for="user-password" style="padding-top:22px"> Konfirmasi Password</label>
            <input type="password" name="password2" id="password2" class="form-content">
            <div class="form-border"></div>
            <button type="submit" name="register" id="submit-btn">Register</button>
        </form>
    </div>
</div>
    </form>
</body>
</html>