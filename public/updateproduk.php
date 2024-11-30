<?php 
require 'Database.php';

    global $conn;

    // Ambil data dari POST
    $idProduk = $_POST['idProduk'];
    $namaProduk = $_POST['namaProduk'];
    $kodeProduk = $_POST['kodeProduk'];
    $jenisProduk = $_POST['jenisProduk'];
    $harga = $_POST['harga'];

    // Periksa apakah ada file gambar yang diupload
    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        $file = $_FILES['file'];
        $uploadDir = "./AsetFoto/Catalog/";

        // Validasi dan simpan file baru
        if (!in_array($file['type'], ['image/jpeg', 'image/png', 'image/gif'])) {
            exit(json_encode(["message" => "Invalid file type. Only JPG, PNG, and GIF files are allowed."]));
        }

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $fileName = basename($file["name"]);
        $filePath = $uploadDir . $fileName;
        $counter = 1;
        while (file_exists($filePath)) {
            $filePath = $uploadDir . pathinfo($fileName, PATHINFO_FILENAME) . "_{$counter}." . pathinfo($fileName, PATHINFO_EXTENSION);
            $counter++;
        }

        if (move_uploaded_file($file["tmp_name"], $filePath)) {
            $fileNameForDB = basename($filePath);
        } else {
            exit(json_encode(["message" => "Gagal memindahkan file yang diupload"]));
        }
    } else {
        // Jika tidak ada file baru, gunakan gambar lama
        $query = "SELECT gambar FROM produk WHERE id = ?";
        $stmt = $conn->prepare($query);
        if ($stmt) {
            $stmt->bind_param("i", $idProduk);
            $stmt->execute();
            $stmt->bind_result($fileNameForDB);
            $stmt->fetch();
            $stmt->close();
        } else {
            exit(json_encode(["message" => "Kesalahan pada statement database"]));
        }
    }

    // Update data produk
    $stmt = $conn->prepare("UPDATE produk SET kodeproduk = ?, nama = ?, gambar = ?, harga = ?, jenis = ? WHERE id = ?");
    if ($stmt) {
        $stmt->bind_param("sssisi", $kodeProduk, $namaProduk, $fileNameForDB, $harga, $jenisProduk, $idProduk); // s: string, i: integer
        $result = $stmt->execute();
        $stmt->close();

        echo json_encode($result ? ["success" => true, "message" => "Produk berhasil diperbarui"] : ["message" => "Gagal memperbarui data di database"]);
    } else {
        echo json_encode(["message" => "Kesalahan pada statement database"]);
    }

?>