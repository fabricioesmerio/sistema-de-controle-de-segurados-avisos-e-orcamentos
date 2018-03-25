<?php
session_start();
require_once '../Config/functions.php';
require_once '../DAO/clienteDAO.php';
require_once '../class/Cliente.php';

$acao = (isset($_GET['acao']) ? filter_input(INPUT_GET, 'acao') : "");
$parametro = (isset($_GET['parametro']) ? filter_input(INPUT_GET, 'parametro') : "");

if ($acao == 'autocomplete'){
    $cliDAO = new clienteDAO();
    $dados = $cliDAO->getByLike(!empty($parametro) ? '%'.$parametro.'%' : '');
    $json = json_encode($dados);
    echo $json;
}

if ($acao == 'consulta'){
    $cliDAO = new clienteDAO();
    $dados = $cliDAO->getByLikeLimit(!empty($parametro) ? '%'.$parametro.'%' : '');
    $json = json_encode($dados);
    echo $json;
}


