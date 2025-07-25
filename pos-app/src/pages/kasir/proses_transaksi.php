<?php
require '../../config/database.php';
session_start();

// Ambil data dari form
$produk_ids = $_POST['produk_id'];
$quantities = $_POST['quantity'];
$payment_method = $_POST['payment_method'];
$paid_amount = floatval($_POST['paid_amount']);
$user_id = $_SESSION['user_id'] ?? 1; // fallback ke user_id = 1 jika belum login

// Fungsi untuk mencatat log aktivitas
function logActivity($conn, $user_id, $action)
{
    $stmt = $conn->prepare("INSERT INTO logs (user_id, action) VALUES (?, ?)");
    $stmt->bind_param("is", $user_id, $action);
    $stmt->execute();
    $stmt->close();
}

// Validasi dasar
if (count($produk_ids) === 0 || count($produk_ids) !== count($quantities)) {
    die("Data tidak valid");
}

// Hitung total
$total_amount = 0;
$items = [];

foreach ($produk_ids as $index => $product_id) {
    $product = $conn->query("SELECT * FROM products WHERE id = $product_id")->fetch_assoc();
    $quantity = intval($quantities[$index]);
    $price = floatval($product['price']);
    $subtotal = $price * $quantity;
    $total_amount += $subtotal;

    $items[] = [
        'product_id' => $product_id,
        'quantity' => $quantity,
        'price' => $price,
        'subtotal' => $subtotal,
        'old_stock' => intval($product['stock']) // simpan stok lama
    ];
}

// Hitung kembalian
$change_amount = $paid_amount - $total_amount;
if ($change_amount < 0) {
    die("Pembayaran kurang dari total belanja.");
}

// Buat invoice number
$invoice_number = 'INV' . time();

// Simpan ke tabel sales
$stmt = $conn->prepare("INSERT INTO sales (invoice_number, user_id, total_amount, payment_method, paid_amount, change_amount) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sidddd", $invoice_number, $user_id, $total_amount, $payment_method, $paid_amount, $change_amount);
$stmt->execute();
$sale_id = $stmt->insert_id;
$stmt->close();

// Simpan ke tabel sale_details + update stok + simpan ke stock_adjustments
foreach ($items as $item) {
    // Simpan ke sale_details
    $stmt = $conn->prepare("INSERT INTO sale_details (sale_id, product_id, quantity, price, subtotal) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("iiidd", $sale_id, $item['product_id'], $item['quantity'], $item['price'], $item['subtotal']);
    $stmt->execute();
    $stmt->close();

    // Hitung stok baru
    $new_stock = $item['old_stock'] - $item['quantity'];

    // Update stok di tabel products
    $stmt = $conn->prepare("UPDATE products SET stock = ? WHERE id = ?");
    $stmt->bind_param("ii", $new_stock, $item['product_id']);
    $stmt->execute();
    $stmt->close();

    // Catat ke stock_adjustments
    $reason = "Pengurangan karena penjualan #$invoice_number";
    $stmt = $conn->prepare("INSERT INTO stock_adjustments (product_id, old_stock, new_stock, reason, adjusted_by) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("iiisi", $item['product_id'], $item['old_stock'], $new_stock, $reason, $user_id);
    $stmt->execute();
    $stmt->close();
}

// Catat aktivitas ke logs
logActivity($conn, $user_id, "Melakukan transaksi penjualan dengan invoice $invoice_number senilai Rp " . number_format($total_amount, 0, ',', '.'));

// Redirect atau tampilkan sukses
echo "<script>alert('Transaksi berhasil!'); window.location.href='riwayat_penjualan.php';</script>";
