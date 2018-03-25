<?php

class Empresa {
    
    private $id;
    private $nome;
    private $razao;
    private $cnpj;
    private $logo;
    private $telefone;
    private $rua;
    private $numero;
    private $cep;
    private $cidade;
    private $estado;
    
    
    function getId() {
        return $this->id;
    }

    function getNome() {
        return $this->nome;
    }

    function getRazao() {
        return $this->razao;
    }

    function getCnpj() {
        return $this->cnpj;
    }

    function getLogo() {
        return $this->logo;
    }

    function getTelefone() {
        return $this->telefone;
    }

    function getRua() {
        return $this->rua;
    }

    function getNumero() {
        return $this->numero;
    }

    function getCep() {
        return $this->cep;
    }

    function getCidade() {
        return $this->cidade;
    }

    function getEstado() {
        return $this->estado;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setRazao($razao) {
        $this->razao = $razao;
    }

    function setCnpj($cnpj) {
        $this->cnpj = $cnpj;
    }

    function setLogo($logo) {
        $this->logo = $logo;
    }

    function setTelefone($telefone) {
        $this->telefone = $telefone;
    }

    function setRua($rua) {
        $this->rua = $rua;
    }

    function setNumero($numero) {
        $this->numero = $numero;
    }

    function setCep($cep) {
        $this->cep = $cep;
    }

    function setCidade($cidade) {
        $this->cidade = $cidade;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }


    
}
