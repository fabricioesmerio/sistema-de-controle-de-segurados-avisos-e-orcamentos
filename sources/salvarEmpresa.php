<?php
session_start();
include_once '../class/Empresa.php';
include_once '../DAO/EmpresaDAO.php';
include_once '../Config/config.php';


if (isset($_POST['salvar_empresa'])) {
    $emp = new Empresa();
    $emp->setNome(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS));
    $emp->setRazao(filter_input(INPUT_POST, 'razao', FILTER_SANITIZE_SPECIAL_CHARS));
    $emp->setCnpj(filter_input(INPUT_POST, 'cnpj', FILTER_SANITIZE_SPECIAL_CHARS));
    $emp->setTelefone(filter_input(INPUT_POST, 'tel', FILTER_SANITIZE_SPECIAL_CHARS));
    $emp->setCep(filter_input(INPUT_POST, 'cep', FILTER_SANITIZE_SPECIAL_CHARS));
    $emp->setRua(filter_input(INPUT_POST, 'rua', FILTER_SANITIZE_SPECIAL_CHARS));
    $emp->setNumero(filter_input(INPUT_POST, 'num', FILTER_SANITIZE_SPECIAL_CHARS));
    $emp->setCidade(filter_input(INPUT_POST, 'cidade', FILTER_SANITIZE_SPECIAL_CHARS));
    $emp->setEstado(filter_input(INPUT_POST, 'estado', FILTER_SANITIZE_SPECIAL_CHARS));


    $empDAO = new EmpresaDAO();

    if ($empDAO->insert($emp)) {
        $_SESSION['success'] = "Empresa salva com sucesso.";
        header("Location: ../production/cadEmpresa.php");
        die();
    } else {
        $_SESSION['error'] = "Ocorreu um erro ao salvar a empresa.";
        header("Location: ../production/cadEmpresa.php");
        die();
    }
}