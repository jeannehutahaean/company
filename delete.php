<?php
require './config/db.php';

// Mendapatkan ID produk dari parameter URL
$id = $_GET['id'];

// Hapus data produk
if (mysqli_query($db_connect, "DELETE FROM products WHERE id = $id")) {
    $message = "Produk berhasil dihapus.";
} else {
    $message = "Gagal menghapus produk: " . mysqli_error($db_connect);
}

// Redirect ke halaman data produk setelah 3 detik
header("refresh:3;url=show.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hapus Produk</title>
    <link rel="stylesheet" href="/style/style.css">
</head>
<body>
    <div class="wrapper">
        <h1>Hapus Produk</h1>
        <p><?php echo $message; ?></p>
        <p>Anda akan diarahkan kembali ke halaman produk dalam 3 detik.</p>
        <a href="show.php">Kembali ke daftar produk sekarang</a>
    </div>
</body>
</html>