<?php

class Cliente {

    private $id;
    private $nome;
    private $razao;
    private $cpf;
    private $cnpj;
    private $cnh;
    private $telefone;
    private $celular;
    private $sexo;
    private $estadoCivil;
    private $dataNasc;
    private $obs;
    private $finalidadeEco;
    private $tipoCliente;
    private $lastModified;

    function getId() {
        return $this->id;
    }

    function getNome() {
        return $this->nome;
    }

    function getRazao() {
        return $this->razao;
    }

    function getCnh() {
        return $this->cnh;
    }

    function setCnh($cnh) {
        $this->cnh = $cnh;
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

    function getSexo() {
        return $this->sexo;
    }

    function getEstadoCivil() {
        return $this->estadoCivil;
    }

    function getDataNasc() {
        return $this->dataNasc;
    }

    function setSexo($sexo) {
        $this->sexo = $sexo;
    }

    function setEstadoCivil($estadoCivil) {
        $this->estadoCivil = $estadoCivil;
    }

    function setDataNasc($dataNasc) {
        $this->dataNasc = $dataNasc;
    }

    function getTipoCliente() {
        return $this->tipoCliente;
    }

    function setTipoCliente($tipoCliente) {
        $this->tipoCliente = $tipoCliente;
    }

    function getCelular() {
        return $this->celular;
    }

    function setCelular($celular) {
        $this->celular = $celular;
    }

    function getObs() {
        return $this->obs;
    }

    function setObs($obs) {
        $this->obs = $obs;
    }

    function getCpf() {
        return $this->cpf;
    }

    function getCnpj() {
        return $this->cnpj;
    }

    function setCpf($cpf) {
        $this->cpf = $cpf;
    }

    function setCnpj($cnpj) {
        $this->cnpj = $cnpj;
    }

    function getTelefone() {
        return $this->telefone;
    }

    function setTelefone($telefone) {
        $this->telefone = $telefone;
    }

    function getFinalidadeEco() {
        return $this->finalidadeEco;
    }

    function setFinalidadeEco($finalidadeEco) {
        $this->finalidadeEco = $finalidadeEco;
    }
    function getLastModified() {
        return $this->lastModified;
    }

    function setLastModified($lastModified) {
        $this->lastModified = $lastModified;
    }


}
