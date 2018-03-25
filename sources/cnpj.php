<?php
//Garantir que seja lido sem problemas
header("Content-Type: text/plain");

//Capturar CNPJ
$cnpj = $_REQUEST["cnpj"];

//Criando Comunicação cURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_CAINFO, dirname(__FILE__).'\cacert-2017-06-07.pem');
curl_setopt($ch, CURLOPT_URL, "https://www.receitaws.com.br/v1/cnpj/".$cnpj);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$retorno = curl_exec($ch);
curl_close($ch);

$retorno = json_decode($retorno); //Ajuda a ser lido mais rapidamente
echo json_encode($retorno, JSON_PRETTY_PRINT);

