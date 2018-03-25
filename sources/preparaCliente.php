<?php
session_start();
require_once '../Config/functions.php';
require_once '../DAO/clienteDAO.php';
require_once '../DAO/Tipo_ClienteDAO.php';
require_once '../class/Cliente.php';
require_once '../class/Tipo_Cliente.php';


/**
 * RECEBE O CODIGO DO CLIENTE ATRAVES DA VARIÁVEL COD UTILIZANDO O MÉTODO GET E, APÓS 
 * RECEBER O OBJETO POVOADO COM OS DADOS DO CLIENTE SELECIONADO, REDIRECIONA PARA A 
 * PÁGINA DE DETALHES. CASO HAJA ERRO, RETORNA MENSAGEM DE ERRO PARA A LISTA DE CLIENTES
 */
if (isset($_GET['cod'])){
    $id = filter_input(INPUT_GET, 'cod', FILTER_SANITIZE_NUMBER_INT);
    
    $cliente = new Cliente();
    $clienteDAO = new clienteDAO();
    $cliente = $clienteDAO->getById($id);
            
    if (empty($cliente)){
        $_SESSION['error'] = 'Ocorreu um erro ao selecionar o cliente.';
        header("Location: ../production/listasClientes.php");
        die();
    }
    if (isset($_SESSION['cliente']) && $_SESSION['cliente'] != NULL){
        unset($_SESSION['cliente']);
    }            
    $objCliente = serialize($cliente);
        
    $_SESSION['cliente'] = $objCliente;
    
    header("Location: ../production/detalhesCliente.php");
    die();
    
}

/**
 * ESSA PARTE É RESPONSÁVEL POR VERFICAR OS CÓDIGOS PARA A TELA DE EDIÇÃO.
 * CASO HAJA SUCESSO AO SELECIONAR OS DADOS DO CLIENTE, SERÁ REDIRECIONADO A TELA DE
 * EDIÇÃO, CASO CONTRÁRIO RETORNA MENSAGEM DE ERRO A LISTA DE CLIENTES.
 */

if (isset($_GET['edit'])){
    $id = filter_input(INPUT_GET, 'edit');
    $cliente = new Cliente();
    $clienteDAO = new clienteDAO();
    $cliente = $clienteDAO->getById($id);
            
    if (empty($cliente) || $cliente == NULL){
        $_SESSION['error'] = 'Ocorreu um erro ao selecionar o cliente.';
        header("Location: ../production/listasClientes.php");
        die();
    }
    
    $tipo = new Tipo_Cliente();
    $tipoDAO = new Tipo_ClienteDAO();
    $tipo = $tipoDAO->getById($cliente->getTipoCliente());
    
    if(isset($_SESSION['tipoCliente_tipo'])){
        unset($_SESSION['tipoCliente_tipo']);
        $_SESSION['tipoCliente_tipo'] = $tipo->getTipo();
    }
    if(isset($_SESSION['tipoCliente_id'])){
        unset($_SESSION['tipoCliente_id']);
        $_SESSION['tipoCliente_id'] = $tipo->getId();
    }
    
    $objCliente = serialize($cliente);
        
    $_SESSION['cliente'] = $objCliente;
    
    header("Location: ../production/editaCliente.php");
    die();
}