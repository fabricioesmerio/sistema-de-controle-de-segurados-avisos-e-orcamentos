<?php

require_once '../DAO/Tipo_ClienteDAO.php';
require_once '../class/Tipo_Cliente.php';;
session_start();
if (isset($_GET['form'])) {
    if (($_GET['form']) == 'f') {
        $termo = 'Pessoa Física';
        $tc = new Tipo_Cliente();
        $tcDAO = new Tipo_ClienteDAO();
        $tc = $tcDAO->getByDescri($termo);
        $_SESSION['tipoCliente_id'] = $tc->getId();
        $_SESSION['tipoCliente_tipo'] = $tc->getTipo();
        header("Location: ../production/cadCliente.php");
        die();
    } elseif (($_GET['form']) == 'j') {
        $termo = 'Pessoa Jurídica';
        $tcDAO = new Tipo_ClienteDAO();
        $tc = new Tipo_Cliente();
        $tc = $tcDAO->getByDescri($termo);
        $_SESSION['tipoCliente_id'] = $tc->getId();
        $_SESSION['tipoCliente_tipo'] = $tc->getTipo();
        header("Location: ../production/cadCliente.php");
        die();
    } else {
        header("Location: ../production/");
        die();
    }
}