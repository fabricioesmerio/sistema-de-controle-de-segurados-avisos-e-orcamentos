<?php

class Seguro {

    private $id;
    private $dataInicio;
    private $dataFinal;
    /* Se houve ou não sinistro no seguro vegente */
    private $sinistro;
    private $classe;
    private $is_closed;

    /* objeto da classe Bem */
    private $bem;
    /* objeto da classe Tipo_Bem */
    private $cliente;

    function getId() {
        return $this->id;
    }

    function getDataInicio() {
        return $this->dataInicio;
    }

    function getDataFinal() {
        return $this->dataFinal;
    }

    function getSinistro() {
        return $this->sinistro;
    }

    function getClasse() {
        return $this->classe;
    }

    function getBem() {
        return $this->bem;
    }

    function getCliente() {
        return $this->cliente;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setDataInicio($dataInicio) {
        $this->dataInicio = $dataInicio;
    }

    function setDataFinal($dataFinal) {
        $this->dataFinal = $dataFinal;
    }

    function setSinistro($sinistro) {
        $this->sinistro = $sinistro;
    }

    function setClasse($classe) {
        $this->classe = $classe;
    }

    function setBem($bem) {
        $this->bem = $bem;
    }

    function setCliente($cliente) {
        $this->cliente = $cliente;
    }
    function getIs_closed() {
        return $this->is_closed;
    }

    function setIs_closed($is_closed) {
        $this->is_closed = $is_closed;
    }



}
