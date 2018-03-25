<?php
require_once '../DAO/UsuarioDAO.php';
require_once '../class/Usuario.php';

$username = addslashes(filter_input(INPUT_POST, 'login'));

$user = new Usuario();
$userDAO = new UsuarioDAO();
$rows = $userDAO->validaUserName($username);

if ($rows == 0){
    echo '';
} else {
    echo 'Este login já está em uso';
}