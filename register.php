<?php
require './../config/db.php';

if(isset($_POST['submit'])) {
    global $db_connect;

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];

    if($confirm != $password) {
        echo "Password tidak sesuai dengan konfirmasi password";
        die;
    }

    $usedEmail = mysqli_query($db_connect, "SELECT email FROM users WHERE email = '$email'");
    if(mysqli_num_rows($usedEmail) > 0) {
        echo "Email sudah digunakan";
        die;
    }

    $password = password_hash($password, PASSWORD_DEFAULT);
    $created_at = date('Y-m-d H:i:s', time());
        
    $users = mysqli_query($db_connect, "INSERT INTO users (name, email, password, created_at) VALUES ('$name', '$email', '$password', '$created_at')");

    echo "Registrasi berhasil";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="../style/style.css">
</head>
<body>
    <h1>Register</h1>
    <form action="" method="post">
        <input type="text" name="name" placeholder="Masukkan nama anda" required>
        <input type="email" name="email" placeholder="Masukkan email anda" required>
        <input type="password" name="password" placeholder="Masukkan password anda" required>
        <input type="password" name="confirm" placeholder="Konfirmasi password anda" required>
        <input type="submit" value="Register" name="submit">
    </form>
</body>
</html>