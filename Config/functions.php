<?php
include_once 'config.php';

date_default_timezone_set('America/Sao_Paulo');

function connectdb() {
    $dns = "mysql:host=" . HOST . ";dbname=" . NAMEDB;
    $opcoes = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8', PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
    try {
        $conexao = new PDO($dns, USER, PASS, $opcoes);
        $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conexao;
    } catch (PDOException $ex) {
        echo 'Erro ao se conectar ao banco de dados. Erro: ' . $ex->getMessage();
    }
}

function geraCodVerificador() {
    $length = 20;
    $salt = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $len = strlen($salt);
    $pass = '';
    mt_srand(10000000 * (double) microtime());
    for ($i = 0; $i < $length; $i++) {
        $pass .= $salt[mt_rand(0, $len - 1)];
    }
    return $pass;
}

function dateForDB($data) {
    $dataMani = $data;
    $dt = explode('/', $dataMani);
    $dataNova = $dt[1] . '/' . $dt[0] . '/' . $dt[2];
    return (date("Y-m-d", strtotime($dataNova)));
}

function dateForForm($data) {
    return date('d/m/Y', strtotime($data));
}

function pegaSegurosAVencerMesAno(){
    require_once '../DAO/SeguroDAO.php';
    $dao = new SeguroDAO();
    $rs = $dao->verificaSegurosAVencer(date("m"), date("Y"), 1);
    if($rs){
        return $rs;
    } else {
        return "0";
    }
}

function verificaSessao() {
    if (isset($_SESSION)){
        if (!(isset($_SESSION['id']) && isset($_SESSION['logado']) == TRUE)){
            header("Location:../index.html");
        }
    } else {
        header("Location:../index.html");
    }
}

function countAvisos(){
    require_once '../DAO/AvisoDAO.php';
    $aviso = new AvisoDAO();
    return $aviso->count();
}

function countOrcamentos(){
    require_once '../DAO/OrcamentoDAO.php';
    $orcamnto = new OrcamentoDAO();
    return $orcamnto->count();
}