<?php

require 'vendor/autoload.php';

header('Content-Type: application/json');

if (!isset($_POST['ccy1'], $_POST['ccy2'], $_POST['amount'])) {
    http_response_code(400);
    die ('{ "error": "missing post data" }');
}

if (!is_numeric($_POST['amount'])) {
    http_response_code(400);
    die ('{ "error": "no amount specified" }');
}

$accessKey = '2b8c7b31337eaf02817884189958789e';
// ?access_key=2b8c7b31337eaf02817884189958789e&symbols=USD,AUD,CAD,PLN,MXN&format=1
$client = new GuzzleHttp\Client(['base_uri' => 'http://data.fixer.io/api/']);
try {
    $symbols = implode(",", [$_POST['ccy1'],$_POST['ccy2']]);
    $response = $client->request('GET', $_POST['date'], [
        'query' => [
            'access_key' => $accessKey,
            'symbols' => $symbols,
            'format' => 1,
        ]
    ]);
    http_response_code($response->getStatusCode());
    $rates = json_decode((string)$response->getBody());

    $amount = floatval($_POST['amount']);
    $ccy1 = floatval($rates->rates->{$_POST['ccy1']});
    $ccy2 = floatval($rates->rates->{$_POST['ccy2']});
    $rate = ($ccy2/$ccy1);
    $convertedAmount = $rate * $amount;

    $results = [
        "currency_pair" => $_POST['ccy1'] . ":" . $_POST['ccy2'],
        "rate" => $rate,
        $_POST['ccy1'] => $amount,
        $_POST['ccy2'] => $convertedAmount,
    ];

    echo json_encode($results);
}
catch (GuzzleHttp\Exception\RequestException $e) {
    die ('{ "error": "fatal error", "details": $e }');
}



