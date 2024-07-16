<?php

$url = 'https://192.168.40.107/graphql-playground';

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
// 証明書の検証を無効化
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

$query = <<< GRAPHQL
query getClients {
    client_id
    client_secret
}
GRAPHQL;

curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($query));


$response = curl_exec($ch);

if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close($ch);

$fp = fopen('result.txt', 'w');
fwrite($fp, $response);
fclose($fp);
