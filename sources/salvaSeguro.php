<?php

session_start();
require_once '../Config/functions.php';
require_once '../DAO/SeguroDAO.php';
require_once '../class/Seguro.php';


if (isset($_POST['id_seguro'])) { // Atualizar Seguro
    $idSeguro = filter_input(INPUT_POST, 'id_seguro');
    $seg = new Seguro();
    $seg->setBem(filter_input(INPUT_POST, 'id_bem'));
    $seg->setClasse(filter_input(INPUT_POST, 'classe'));
    $seg->setCliente(filter_input(INPUT_POST, 'cod'));
    $seg->setDataFinal(dateForDB(filter_input(INPUT_POST, 'data_fim')));
    $seg->setDataInicio(dateForDB(filter_input(INPUT_POST, 'data_inicio')));
    $seg->setId($idSeguro);
    $seg->setSinistro((isset($_POST['sinistro'])) ? '1' : '0');
    $segDAO = new SeguroDAO();

    if ($segDAO->update($seg)) {
        $_SESSION['success'] = "Seguro atualizado com sucesso.";
        header("Location: ../production/listaSeguros.php");
        die();
    } else {
        $_SESSION['error'] = "Ocorreu um erro ao atualizar o seguro.";
        header("Location: ../production/listaSeguros.php");
        die();
    }
} elseif (!isset($_POST['id_seguro']) && isset($_POST['cod']) && !(isset($_GET['action']))) { //Novo Seguro
    $seg = new Seguro();
    $seg->setBem(filter_input(INPUT_POST, 'id_bem'));
    $seg->setClasse(filter_input(INPUT_POST, 'classe'));
    $seg->setCliente(filter_input(INPUT_POST, 'cod'));
    $seg->setDataFinal(dateForDB(filter_input(INPUT_POST, 'data_fim')));
    $seg->setDataInicio(dateForDB(filter_input(INPUT_POST, 'data_inicio')));
    $seg->setSinistro(FALSE);
    $seg->setIs_closed('');

    $segDAO = new SeguroDAO();

    if ($segDAO->insert($seg)) {
        echo '<div class="alert alert-success" role="alert">
                Seguro salvo com sucesso.
              </div>';
    } else {
        echo '<div class="alert alert-success" role="alert">
                Ocorreu um erro ao salvar o seguro.
              </div>';
    }
} elseif (!isset($_POST['id_seguro']) && isset($_POST['cod']) && (isset($_GET['action']) && $_GET['action'] == 2)) { //Renova Seguro
    $seg = new Seguro();
    $seg->setBem(filter_input(INPUT_POST, 'id_bem'));
    $seg->setClasse(filter_input(INPUT_POST, 'classe'));
    $seg->setCliente(filter_input(INPUT_POST, 'cod'));
    $seg->setDataFinal(dateForDB(filter_input(INPUT_POST, 'data_fim')));
    $seg->setDataInicio(dateForDB(filter_input(INPUT_POST, 'data_inicio')));
    $seg->setSinistro(FALSE);
    $seg->setIs_closed('nao');
    
    $idAntigo = filter_input(INPUT_POST, 'id_antigo');
    
    
    $segAntigo = new Seguro();
    $segAntigoDAO = new SeguroDAO();
    $segAntigo = $segAntigoDAO->getById($idAntigo);
    $segAntigo->setIs_closed('sim');
    $segAntigoDAO->closedSeguro($segAntigo);
    
    unset($segAntigo);
    unset($segAntigoDAO);

    $segDAO = new SeguroDAO();

    if ($segDAO->insert($seg)) {
        echo '<div class="alert alert-success" role="alert">
                Seguro salvo com sucesso.
              </div>';
    } else {
        echo '<div class="alert alert-success" role="alert">
                Ocorreu um erro ao salvar o seguro.
              </div>';
    }
} else {
    echo ' <div class="alert alert-danger" role="alert">
                Ocorreu um erro ao passar os dados do formulário! <br />Verifique os dados e tente novamente.
           </div>';
}