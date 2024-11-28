<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
    header("Location: ./backend/login.php"); // Redirect ke login jika bukan user
    exit();
}

require './config/db.php';

$products = mysqli_query($db_connect, "SELECT * FROM products");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Produk</title>
    <link rel="stylesheet" href="./style/style.css"> <!-- Jika Anda memiliki CSS -->
</head>
<body>
    <h1>Data Produk</h1>
    <table border="1">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Gambar Produk</th>
                <th>Opsi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;

            while ($row = mysqli_fetch_assoc($products)) {
            ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= htmlspecialchars($row['name']); ?></td>
                    <td><?= htmlspecialchars($row['price']); ?></td>
                    <td><a href="<?= htmlspecialchars($row['image']); ?>" target="_blank">Unduh</a></td>
                    <td>
                        <a href="edit.php?id=<?= $row['id']; ?>">Edit</a>
                        <a href="delete.php?id=<?= $row['id']; ?>">Hapus</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    
    <a href="logout.php">Logout</a> <!-- Link untuk logout -->
</body>
</html>