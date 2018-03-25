<?php


class Bem {
    
    private $id;
    private $marca;
    private $modelo;
    private $anoModelo;
    private $zeroKm;
    private $combustivel;
    private $codFipe;
    private $placa;
    private $chassi;
    private $categoria;
    private $uso;
    /*Pessoas - etc*/
    private $transportes;
    private $blindado;
    private $cepPernoite;
    private $cidadePernoite;
    private $estadoPernoite;
    private $atividadeEco;
    /* Código gerado aleatoriamente para realizar a busca do id no banco de dados*/
    private $cod_verificacao;
    /* objeto da classe Tipo_Bem */
    private $tipoBem;
    /* objeto da classe Cliente */
    private $cliente;
    
    
            
    function getId() {
        return $this->id;
    }

    function getMarca() {
        return $this->marca;
    }

    function getModelo() {
        return $this->modelo;
    }

    function getAnoModelo() {
        return $this->anoModelo;
    }

    function getZeroKm() {
        return $this->zeroKm;
    }

    function getCombustivel() {
        return $this->combustivel;
    }

    function getCodFipe() {
        return $this->codFipe;
    }

    function getPlaca() {
        return $this->placa;
    }

    function getChassi() {
        return $this->chassi;
    }

    function getCategoria() {
        return $this->categoria;
    }

    function getUso() {
        return $this->uso;
    }

    function getTransportes() {
        return $this->transportes;
    }

    function getBlindado() {
        return $this->blindado;
    }

    function getCepPernoite() {
        return $this->cepPernoite;
    }

    function getCidadePernoite() {
        return $this->cidadePernoite;
    }

    function getEstadoPernoite() {
        return $this->estadoPernoite;
    }

    function getAtividadeEco() {
        return $this->atividadeEco;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setMarca($marca) {
        $this->marca = $marca;
    }

    function setModelo($modelo) {
        $this->modelo = $modelo;
    }

    function setAnoModelo($anoModelo) {
        $this->anoModelo = $anoModelo;
    }

    function setZeroKm($zeroKm) {
        $this->zeroKm = $zeroKm;
    }

    function setCombustivel($combustivel) {
        $this->combustivel = $combustivel;
    }

    function setCodFipe($codFipe) {
        $this->codFipe = $codFipe;
    }

    function setPlaca($placa) {
        $this->placa = $placa;
    }

    function setChassi($chassi) {
        $this->chassi = $chassi;
    }

    function setCategoria($categoria) {
        $this->categoria = $categoria;
    }

    function setUso($uso) {
        $this->uso = $uso;
    }

    function setTransportes($transportes) {
        $this->transportes = $transportes;
    }

    function setBlindado($blindado) {
        $this->blindado = $blindado;
    }

    function setCepPernoite($cepPernoite) {
        $this->cepPernoite = $cepPernoite;
    }

    function setCidadePernoite($cidadePernoite) {
        $this->cidadePernoite = $cidadePernoite;
    }

    function setEstadoPernoite($estadoPernoite) {
        $this->estadoPernoite = $estadoPernoite;
    }

    function setAtividadeEco($atividadeEco) {
        $this->atividadeEco = $atividadeEco;
    }

    function getTipoBem() {
        return $this->tipoBem;
    }

    function getCliente() {
        return $this->cliente;
    }

    function setTipoBem($tipoBem) {
        $this->tipoBem = $tipoBem;
    }

    function setCliente($cliente) {
        $this->cliente = $cliente;
    }

    function getCod_verificacao() {
        return $this->cod_verificacao;
    }

    function setCod_verificacao($cod_verificacao) {
        $this->cod_verificacao = $cod_verificacao;
    }


}
