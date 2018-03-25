<?php


class Usuario {
    
    private $id;
    private $nome;
    private $login;
    private $pass;
    private $nivelAcesso;
    private $status;
    
    function getId() {
        return $this->id;
    }

    function getNome() {
        return $this->nome;
    }

    function getLogin() {
        return $this->login;
    }

    function getPass() {
        return $this->pass;
    }

    function getNivelAcesso() {
        return $this->nivelAcesso;
    }

    function getStatus() {
        return $this->status;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setLogin($login) {
        $this->login = $login;
    }

    function setPass($pass) {
        $this->pass = $pass;
    }

    function setNivelAcesso($nivelAcesso) {
        $this->nivelAcesso = $nivelAcesso;
    }

    function setStatus($status) {
        $this->status = $status;
    }


    
}
