<?php
include '../../../config/database.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Hapus produk berdasarkan ID
    $query = "DELETE FROM products WHERE id = $id";
    $result = mysqli_query($conn, $query);

    if ($result) {
        header("Location: index.php?success=hapus");
        exit();
    } else {
        echo "Gagal menghapus produk.";
    }
} else {
    echo "ID produk tidak ditemukan.";
}
