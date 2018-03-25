<?php

session_start();
require_once '../Config/functions.php';
require_once '../DAO/AvisoDAO.php';
require_once '../class/Aviso.php';


if (isset($_GET['action']) && $_GET['action'] == 'insert') {
    $aviso = new Aviso();
    $aviso->setData_abertura(dateForDB(addslashes(filter_input(INPUT_POST, 'data_abertura'))));
    $aviso->setDescricao(addslashes(filter_input(INPUT_POST, 'descricao')));
    $aviso->setStatus(addslashes(filter_input(INPUT_POST, 'status')));
    $aviso->setUsuario_respons($_SESSION['id']);

    $avisoDAO = new AvisoDAO();
    if ($avisoDAO->insert($aviso)) {
        $_SESSION['success'] = "Aviso salvo com sucesso.";
        header("Location: ../production/cadAviso.php");
        die();
    } else {
        $_SESSION['error'] = "Ocorreu um erro ao salvar o aviso.";
        header("Location: ../production/cadAviso.php");
        die();
    }
} elseif (isset($_GET['action']) && $_GET['action'] == 'update') {
    $aviso = new Aviso();
    $avisoDAO = new AvisoDAO();
    $aviso = $avisoDAO->getById(addslashes(filter_input(INPUT_POST, 'id_aviso')));
    $aviso->setDescricao(addslashes(filter_input(INPUT_POST, 'descricao')));
    $aviso->setData_abertura(addslashes(dateForDB(filter_input(INPUT_POST, 'data_abertura'))));
    $aviso->setData_fechamnto(($_POST['data_fechamento'] != '' || $_POST['data_fechamento'] != NULL) ? addslashes(dateForDB(filter_input(INPUT_POST, 'data_fechamento'))) : NULL);
    if ($_POST['data_fechamento'] != '' || $_POST['data_fechamento'] != NULL){
        $aviso->setStatus(2);
    } else {
        $aviso->setStatus(addslashes(filter_input(INPUT_POST, 'status')));
    }
    
    $aviso->setUsuario_respons($_SESSION['id']);
    
    if($avisoDAO->update($aviso)){
        $_SESSION['success'] = "Aviso atualizado com sucesso.";
        header("Location: ../production/cadAviso.php");
        die();
    } else {
        $_SESSION['error'] = "Ocorreu um erro ao atualizar o aviso.";
        header("Location: ../production/cadAviso.php");
        die();
    }
}