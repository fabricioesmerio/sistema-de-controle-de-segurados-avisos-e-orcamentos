<?php


class Endereco {
    
    private $id;
    private $rua;
    private $numero;
    private $complemento;
    private $bairro;
    private $cidade;
    private $estado;
    private $cep;
    private $cliente;
            
    
    function getId() {
        return $this->id;
    }

    function getRua() {
        return $this->rua;
    }

    function getNumero() {
        return $this->numero;
    }

    function getBairro() {
        return $this->bairro;
    }

    function getCidade() {
        return $this->cidade;
    }

    function getCep() {
        return $this->cep;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setRua($rua) {
        $this->rua = $rua;
    }

    function setNumero($numero) {
        $this->numero = $numero;
    }

    function setBairro($bairro) {
        $this->bairro = $bairro;
    }

    function setCidade($cidade) {
        $this->cidade = $cidade;
    }

    function setCep($cep) {
        $this->cep = $cep;
    }

    function getCliente() {
        return $this->cliente;
    }

    function setCliente($cliente) {
        $this->cliente = $cliente;
    }
    
    function getComplemento() {
        return $this->complemento;
    }

    function setComplemento($complemento) {
        $this->complemento = $complemento;
    }
    function getEstado() {
        return $this->estado;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }
}
