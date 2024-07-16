<?php

$url = 'https://192.168.40.107/oauth/v2/tokens';
$clientId = '098aydsaashjdilnbgib';
$clientSecret = 'akljsdbn9o8as6d907623h5oihda9f';

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);

// 証明書の検証を無効化
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/x-www-form-urlencoded',
    'Accept: application/json',
    'Authorization: Basic ' . base64_encode($clientId . ':' . $clientSecret),
]);

$postData = [
    'grant_type' => 'authorization_code',
    // 'client_id' => $clientId,
    // 'client_secret' => $clientSecret,
];
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));

$response = curl_exec($ch);

if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close($ch);
echo $response . "\n";
