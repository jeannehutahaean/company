<?php
session_start();
require './../config/db.php';

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $result = mysqli_query($db_connect, "SELECT * FROM users WHERE email = '$email'");
    $user = mysqli_fetch_assoc($result);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role']; // Pastikan kolom role ada di tabel users

        // Redirect berdasarkan role
        if ($user['role'] == 'admin') {
            header("Location: ./create.php"); // Redirect ke create.php untuk admin
        } else {
            header("Location: ../show.php"); // Redirect ke show.php untuk user
        }
        exit();
    } else {
        echo "Email atau password salah";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../style/style.css">
</head>
<body>
    <h1>Login</h1>
    <form action="" method="post">
        <input type="email" name="email" placeholder="Masukkan email anda" required>
        <input type="password" name="password" placeholder="Masukkan password anda" required>
        <input type="submit" value="Login" name="submit">
    </form>
</body>
</html>