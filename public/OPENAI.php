<?php
// Koneksi database
require_once 'database.php';

// Ambil data terbaru
$result = $conn->query("SELECT * FROM penjualan ORDER BY tanggal DESC LIMIT 10");
$data = [];

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
} else {
    echo "Error fetching data: " . $conn->error;
    exit;
}

// Format data untuk GPT
$data_text = "Berikut adalah data penjualan terakhir:\n";
foreach ($data as $item) {
    $data_text .= "Tanggal: {$item['tanggal']}, Barang: {$item['nama']}, Jumlah: {$item['stok']}\n";
}

// Kirim ke GPT
$api_key ="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";

$curl = curl_init();

curl_setopt_array($curl, [
    CURLOPT_URL => "https://api.openai.com/v1/chat/completions",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_HTTPHEADER => [
        "Content-Type: application/json",
        "Authorization: Bearer $api_key",
    ],
    CURLOPT_POSTFIELDS => json_encode([
        "model" => "gpt-3.5-turbo",
        "messages" => [
            ["role" => "system", "content" => "Anda adalah asisten untuk membuat promosi."],
            ["role" => "user", "content" => "Berikan rekomendasi promosi untuk data penjualan saya:\n$data_text"]
        ]
    ]),
]);

$response = curl_exec($curl);

if (curl_errno($curl)) {
    echo "Error: " . curl_error($curl);
} else {
    $response_data = json_decode($response, true);
    // Menampilkan hasil dari OpenAI
    if (isset($response_data['choices'][0]['message']['content'])) {
        $saran_promosi = $response_data['choices'][0]['message']['content'];
        
        // Masukkan hasil ke dalam database
        $stmt = $conn->prepare("INSERT INTO promosi (saran) VALUES (?)");
        $stmt->bind_param("s", $saran_promosi);
        
        if ($stmt->execute()) {
            echo "Saran promosi berhasil disimpan ke dalam database.";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Respons dari OpenAI: " . $response;
    }
}
echo function_exists('curl_version') ? "cURL Aktif" : "cURL Tidak Aktif";

curl_close($curl);
 // Menutup koneksi database
?>