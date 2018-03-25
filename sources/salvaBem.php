<?php

require_once '../DAO/BemDAO.php';
require_once '../class/Bem.php';

$bem = new Bem();
$bem->setTipoBem(filter_input(INPUT_POST, 'tipo_bem'));
$bem->setCliente(filter_input(INPUT_POST, 'cod'));
$bem->setMarca(filter_input(INPUT_POST, 'marca'));
$bem->setModelo(filter_input(INPUT_POST, 'modelo'));
$bem->setAnoModelo(filter_input(INPUT_POST, 'ano_modelo'));
$bem->setCodFipe(filter_input(INPUT_POST, 'fipe'));
$bem->setCombustivel(filter_input(INPUT_POST, 'combustivel'));
$bem->setPlaca(filter_input(INPUT_POST, 'placa'));
$bem->setAtividadeEco(filter_input(INPUT_POST, 'atividade'));
$bem->setChassi(filter_input(INPUT_POST, 'chassi'));
$bem->setCategoria(filter_input(INPUT_POST, 'categoria'));
$bem->setUso(filter_input(INPUT_POST, 'uso'));
$bem->setZeroKm((isset($_POST['zero']) ? 'sim' : 'não'));
$bem->setBlindado((isset($_POST['blindado']) ? 'sim' : 'não'));
$bem->setTransportes(filter_input(INPUT_POST, 'transporte'));
$bem->setCepPernoite(filter_input(INPUT_POST, 'cep'));
$bem->setCidadePernoite(filter_input(INPUT_POST, 'cidade'));
$bem->setEstadoPernoite(filter_input(INPUT_POST, 'estado'));
$bemDAO = new BemDAO();

if ($bemDAO->insert($bem)){
    echo '<div class="alert alert-success" role="alert">Salvo com sucesso</div>';
} else {
    echo '<div class="alert alert-danger" role="alert">Ocorreu um erro ao salvar!</div>';
}
