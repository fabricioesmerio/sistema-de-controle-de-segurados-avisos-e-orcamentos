<?php

session_start();
require_once '../DAO/OrcamentoDAO.php';
require_once '../class/Orcamento.php';

if (isset($_GET['action']) && $_GET['action'] == 'insert') {
    $orcamento = new Orcamento();
    $orcamento->setCliente($_SESSION['id_cliente']);
    $orcamento->setData_abertura(dateForDB(addslashes(filter_input(INPUT_POST, 'data_abertura'))));
    $orcamento->setDescricao(addslashes(filter_input(INPUT_POST, 'descricao')));
    $orcamento->setStatus(addslashes(filter_input(INPUT_POST, 'status')));

    unset($_SESSION['id_cliente']);

    $orcamentoDAO = new OrcamentoDAO();
    if ($orcamentoDAO->insert($orcamento)) {
        $_SESSION['success'] = "Orçamento salvo com sucesso.";
        header("Location: ../production/listasClientes.php?view=orc");
        die();
    } else {
        $_SESSION['error'] = "OCorreu um erro ao salvar o orçamento.";
        header("Location: ../production/listasClientes.php?view=orc");
        die();
    }
} elseif (isset($_GET['action']) && $_GET['action'] == 'update') {
    $orcamento = new Orcamento();
    $orcamentoDAO = new OrcamentoDAO();
    $orcamento = $orcamentoDAO->getById(addslashes(filter_input(INPUT_POST, 'id_orcamento')));
    $orcamento->setCliente($_SESSION['id_cliente']);
    $orcamento->getData_abertura(dateForDB(addslashes(filter_input(INPUT_POST, 'data_abertura'))));
    $orcamento->setData_fechmto(($_POST['data_fechamento'] != NULL || $_POST['data_fechamento'] != '') ? dateForDB(addslashes(filter_input(INPUT_POST, 'data_fechamento'))) : NULL);
    $orcamento->setDescricao(addslashes(filter_input(INPUT_POST, 'descricao')));
    if ($_POST['data_fechamento'] != NULL || $_POST['data_fechamento'] != '') {
        $orcamento->setStatus(2);
    } else {
        $orcamento->setStatus(addslashes(filter_input(INPUT_POST, 'status')));
    }
    unset($_SESSION['id_cliente']);

    if ($orcamentoDAO->update($orcamento)){
        $_SESSION['success'] = "Orçamento atualizado com sucesso.";
        header("Location: ../production/listarOrcamentos.php?view=all");
        die();
    } else {
        $_SESSION['error'] = "Ocorreu um erro ao atualizar o orçamento.";
        header("Location: ../production/listarOrcamentos.php?view=all");
        die();
    }
    
}