<?php
require 'Database.php';

header('Content-Type: application/json'); // Set respons sebagai JSON

$id = $_GET["id"];

if (hapus($id) > 0) {
    // Jika berhasil dihapus
    echo json_encode([
        'success' => true,
        'message' => 'Data berhasil dihapus!'
    ]);
} else {
    // Jika gagal dihapus
    echo json_encode([
        'success' => false,
        'message' => 'Data gagal dihapus!'
    ]);
}
?>
