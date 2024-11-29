<?php
// Pastikan Anda sudah menghubungkan ke database di sini
require 'Database.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk menghapus produk berdasarkan ID
    $query = "DELETE FROM produk WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // Jika berhasil, kirimkan response JSON success
        echo json_encode(['success' => true]);
    } else {
        // Jika gagal, kirimkan response JSON error
        echo json_encode(['success' => false, 'message' => 'Gagal menghapus produk']);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['success' => false, 'message' => 'ID tidak ditemukan']);
}
?>
