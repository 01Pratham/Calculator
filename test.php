<?php
require "model/database.php";
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://swayatta.esds.co.in:31199/uat/sku_api_rest.php',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_HTTPHEADER => array(
    'Authorization:  Basic Y3JtaWFwaWNsaWVudDo2QUc/eFIkczQ7UDkkPz8hSw=='
  ),
));

$response = curl_exec($curl);

curl_close($curl);

$array = (json_decode($response , true));

PPrint($array);
