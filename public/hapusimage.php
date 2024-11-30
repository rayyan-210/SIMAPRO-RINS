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
