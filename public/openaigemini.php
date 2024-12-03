<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

 = ''; // Ganti dengan kunci API Anda
$base_url = '';

function callGeminiAPI(string $endpoint, string $method = 'GET', array $data = []): ?array {
    global , $base_url;

    $url = $base_url . $endpoint;

    $headers = [
        'Content-Type: application/json',
        'X-GEMINI-APIKEY: ' . ,
    ];

    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => $method,
        CURLOPT_HTTPHEADER => $headers,
        CURLOPT_POSTFIELDS => json_encode($data),
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_VERBOSE => true,
    ]);

    $response = curl_exec($curl);
    
    // Cek apakah ada kesalahan dalam permintaan cURL
    if (curl_errno($curl)) {
        echo 'Error: ' . curl_error($curl) . "\n";
        return null; // Mengembalikan null jika terjadi kesalahan
    }

    // Cek kode status HTTP
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    echo "HTTP Status Code: " . $httpCode . "\n";

    // Tambahkan ini untuk melihat respons mentah dari API
    echo "Raw response: " . $response . "\n";

    curl_close($curl);

    $responseData = json_decode($response, true);
    
    // Cek apakah respons berhasil
    if (isset($responseData['result']) && $responseData['result'] === 'success') {
        echo "oke mantap\n"; // Pesan sukses
    } else {
        // Jika tidak berhasil, tampilkan detail respons
        echo "Terjadi kesalahan: " . print_r($responseData, true) . "\n";
    }

    return $responseData; // Mengembalikan data respons
}
?>