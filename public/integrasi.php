<?php
// Ganti dengan API key Anda
$apiKey = 'AIzaSyDrXFf6moOQJ8dbZucoQGJ5sD9XZPxKfFs';

// Data yang akan dikirim ke API
$data = json_encode([
    'contents' => [
        [
            'parts' => [
                ['text' => 'Explain how AI works']
            ]
        ]
    ]
]);

// Inisialisasi cURL
$ch = curl_init();

// Set opsi cURL
curl_setopt($ch, CURLOPT_URL, "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_HTTPHEADER, 
 array(
    'Content-Type: application/json',
    'Authorization: Bearer   
 ' . $apiKey
));

// Eksekusi cURL
$response = curl_exec($ch);

if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
} else {
    $responseData = json_decode($response, true);

    // Check if the response is valid and contains the expected data
    if (isset($responseData['contents']) && is_array($responseData['contents']) && count($responseData['contents']) > 0) {
        $text = $responseData['contents'][0]['parts'][0]['text'];
        echo $text;
    } else {
        echo "Error: Invalid API response format";
    }
}

curl_close($ch);