<?php
session_start();
require_once '../DAO/Tipo_ClienteDAO.php';
require_once '../class/Tipo_Cliente.php';;
if (isset($_GET['list'])) {
    if (($_GET['list']) == 'f') {
        $termo = 'Pessoa Física';
        $tc = new Tipo_Cliente();
        $tcDAO = new Tipo_ClienteDAO();
        $tc = $tcDAO->getByDescri($termo);
        $_SESSION['tipoCliente_id'] = $tc->getId();
        $_SESSION['tipoCliente_tipo'] = $tc->getTipo();
        header("Location: ../production/listasClientes.php");
        die();
    } elseif (($_GET['list']) == 'j') {
        $termo = 'Pessoa Jurídica';
        $tcDAO = new Tipo_ClienteDAO();
        $tc = new Tipo_Cliente();
        $tc = $tcDAO->getByDescri($termo);
        $_SESSION['tipoCliente_id'] = $tc->getId();
        $_SESSION['tipoCliente_tipo'] = $tc->getTipo();
        header("Location: ../production/listasClientes.php");
        die();
    } else {
        header("Location: ../production/");
        die();
    }
}