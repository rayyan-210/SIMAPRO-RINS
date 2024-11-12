<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "simapro";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
<?php
// upload gambar
if (isset($_POST['uploadType'])) {
    $uploadType = $_POST['uploadType'];
    if ($uploadType === 'image') {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
            $file = $_FILES['file'];
            $uploadDir = "C:/Users/ASUS/OneDrive/Desktop/coding/HTML/SIMAPRO/public/AsetFoto/carousel/";
            $response = [];


            if ($file['error'] !== UPLOAD_ERR_OK) {
                exit(json_encode(["message" => "File upload error code: " . $file['error']]));
            }
            if (!in_array($file['type'], ['image/jpeg', 'image/png', 'image/gif'])) {
                exit(json_encode(["message" => "Invalid file type. Only JPG, PNG, and GIF files are allowed."]));
            }

            // Buat direktori jika belum ada
            if (!is_dir($uploadDir))
                mkdir($uploadDir, 0777, true);

            // Tentukan nama file yang unik
            $fileName = basename($file["name"]);
            $filePath = $uploadDir . $fileName;
            $counter = 1;
            while (file_exists($filePath)) {
                $filePath = $uploadDir . pathinfo($fileName, PATHINFO_FILENAME) . "_{$counter}." . pathinfo($fileName, PATHINFO_EXTENSION);
                $counter++;
            }

            // Simpan file dan data ke database
            if (move_uploaded_file($file["tmp_name"], $filePath)) {
                $stmt = $conn->prepare("INSERT INTO promosi (gambar, tanggal) VALUES (?, NOW())");
                if ($stmt) {
                    $stmt->bind_param("s", $fileName);
                    $result = $stmt->execute();
                    $stmt->close();
                    echo json_encode($result ? ["success" => true, "message" => "Image saved successfully"] : ["message" => "Failed to save to database"]);
                } else {
                    echo json_encode(["message" => "Database statement error"]);
                }
            } else {
                echo json_encode(["message" => "Failed to move uploaded file"]);
            }
        }
    }
}
?>

<?php
//  hapus gambar 
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET["id"];
    $uploadDir = "C:/Users/ASUS/OneDrive/Desktop/coding/HTML/SIMAPRO/public/AsetFoto/carousel/";

    $stmt_select = $conn->prepare("SELECT gambar FROM promosi WHERE id_promosi = ?");
    $stmt_select->bind_param("i", $id);
    $stmt_select->execute();
    $result = $stmt_select->get_result();

    if ($row = $result->fetch_assoc()) {
        $fileName = $row['gambar'];
        $stmt_delete = $conn->prepare("DELETE FROM promosi WHERE id_promosi = ?");
        $stmt_delete->bind_param("i", $id);

        if ($stmt_delete->execute()) {
            echo json_encode(["success" => true, "message" => "Gambar berhasil dihapus dari database. File tetap ada di server."]);
        } else {
            echo json_encode(["success" => false, "message" => "Gagal menghapus gambar dari database."]);
        }

        $stmt_delete->close();
    } else {
        echo json_encode(["success" => false, "message" => "Gambar tidak ditemukan."]);
    }

    $stmt_select->close();
}
?>

<?php
// excel ke database
if (isset($_POST['uploadType'])) {
    $uploadType = $_POST['uploadType'];
    if ($uploadType === 'csv') {
        if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['file']['tmp_name'];

            // Buka file CSV yang diunggah
            if (($handle = fopen($fileTmpPath, 'r')) !== FALSE) {

                // Ambil header dan trim spasi di sekitar nama kolom
                $header = array_map('trim', fgetcsv($handle, 1000, ','));

                // Periksa apakah header sesuai dengan kolom yang diharapkan
                $expected_header = ['tanggal', 'nama', 'stok'];
                if ($header !== $expected_header) {
                    die(json_encode(["status" => "error", "message" => "Header CSV tidak sesuai dengan kolom tabel."]));
                }

                // Membaca data CSV baris demi baris
                while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
                    $data = array_map('trim', $data);
                    if (count($data) === 3) {

                        $sql = "INSERT INTO penjualan (tanggal, nama, stok) VALUES ('" . implode("', '", $data) . "')";

                        if ($conn->query($sql) !== TRUE) {
                            die(json_encode(["status" => "error", "message" => "Error menyisipkan data: " . $conn->error]));
                        }
                    } else {
                        die(json_encode(["status" => "error", "message" => "Data tidak lengkap: " . implode(", ", $data)]));
                    }
                }

                fclose($handle);
                echo json_encode(["status" => "success", "message" => "File berhasil dimasukkan ke dalam database."]);
            } else {
                echo json_encode(["status" => "error", "message" => "Error membuka file."]);
            }
        }
    }
}
?>
<?php
// membuat chart
if (isset($_GET['json']) && $_GET['json'] === 'true') {
    header('Content-Type: application/json');

    // Aktifkan error reporting
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    $sql = "SELECT tanggal, nama, stok FROM penjualan ORDER BY tanggal ASC";
    $result = $conn->query($sql);

    if (!$result) {
        echo json_encode(["error" => "Query failed: " . $conn->error]);
        exit;
    }

    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }


    echo json_encode($data);
    $conn->close();
    exit;
}
?>

<?php
// Pastikan koneksi database sudah benar
if (isset($_POST['aksi']) && $_POST['aksi'] == 'hapus_semua') {

    // Query untuk mengosongkan tabel
    $query = "TRUNCATE TABLE penjualan";
    
    // Eksekusi query
    if (mysqli_query($conn, $query)) {
        echo json_encode([
            'status' => 'success', 
            'pesan' => 'Semua data berhasil dihapus'
        ]);
    } else {
        echo json_encode([
            'status' => 'error', 
            'pesan' => 'Gagal menghapus data: ' . mysqli_error($conn)
        ]);
    }
    
    exit();
}
?>
