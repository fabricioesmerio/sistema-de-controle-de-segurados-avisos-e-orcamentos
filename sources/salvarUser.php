<?php

session_start();
require_once '../DAO/UsuarioDAO.php';
require_once '../class/Usuario.php';


if (isset($_POST['novo_user'])) {
    $user = new Usuario();
    $userDAO = new UsuarioDAO();

    if (!(filter_input(INPUT_POST, 'name') == "" || filter_input(INPUT_POST, 'login') == "" || filter_input(INPUT_POST, 'senha') == "" || filter_input(INPUT_POST, 'nivelAcesso') == "" || filter_input(INPUT_POST, 'status') == "")) {

        $user->setNome(addslashes(filter_input(INPUT_POST, 'name')));
        $user->setLogin(addslashes(filter_input(INPUT_POST, 'login')));
        $user->setPass(md5(addslashes((filter_input(INPUT_POST, 'senha')))));
        $user->setNivelAcesso(addslashes(filter_input(INPUT_POST, 'nivelAcesso')));
        $user->setStatus(addslashes(filter_input(INPUT_POST, 'status')));

        if ($userDAO->insert($user)) {
            $_SESSION['success'] = "Usuário Salvo com sucesso.";
            header("Location: ../production/cadUsuario.php");
            die();
        } else {
            $_SESSION['error'] = "Ocorreu um erro ao salvar o usuário.";
            header("Location: ../production/cadUsuario.php");
            die();
        }
    } else {
        $_SESSION['error'] = "Os campos marcados com (*) são obrigatórios.";
        header("Location: ../production/cadUsuario.php");
        die();
    }
} elseif (isset($_POST['altera_user'])) {
    $user = new Usuario();
    $userDAO = new UsuarioDAO();
    $id = addslashes(filter_input(INPUT_POST, 'id_usuario'));
    if (!isset($_POST['name']) || $_POST['name'] == '') {
        $_SESSION['error'] = "Os campos marcados com (*) são obrigatórios.";
        header("Location: ../production/cadUsuario.php");
        die();
    }

    $user->setId($id);
    $user->setLogin(addslashes(filter_input(INPUT_POST, 'login')));
    $user->setNivelAcesso(addslashes(filter_input(INPUT_POST, 'nivelAcesso')));
    $user->setNome(addslashes(filter_input(INPUT_POST, 'name')));
    $user->setStatus(addslashes(filter_input(INPUT_POST, 'status')));
    if ($userDAO->update($user)) {
        $_SESSION['success'] = "Usuário Atualizado com sucesso.";
        header("Location: ../production/cadUsuario.php");
        die();
    } else {
        $_SESSION['error'] = "O usuário não pode ser salvo.";
        header("Location: ../production/cadUsuario.php");
        die();
    }
}

if (isset($_GET['action']) && $_GET['action'] == 'new_pass') {
    $id_usuario = addslashes(filter_input(INPUT_POST, 'id_usuario'));
    $new_pass = md5(addslashes(filter_input(INPUT_POST, 'new_pass')));
    $user = new Usuario();
    $userDAO = new UsuarioDAO();
    $user = $userDAO->getByID($id_usuario);
    $user->setPass($new_pass);

    if ($userDAO->alteraSenha($user)) {
        $_SESSION['success'] = "Senha Alterada com sucesso.";
        header("Location: ../production/cadUsuario.php");
        die();
    } else {
        $_SESSION['error'] = "A senha não pode ser alterada devido a um erro.";
        header("Location: ../production/cadUsuario.php");
        die();
    }
}