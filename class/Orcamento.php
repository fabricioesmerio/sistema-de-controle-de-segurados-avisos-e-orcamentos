<?php


/**
 * Description of Orcamento
 *
 * @author Fabrício Esmério
 */
class Orcamento {
    private $id;
    private $data_abertura;
    private $data_fechmto;
    private $descricao;
    private $status;
    private $cliente;
    
    function getId() {
        return $this->id;
    }

    function getData_abertura() {
        return $this->data_abertura;
    }

    function getData_fechmto() {
        return $this->data_fechmto;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function getStatus() {
        return $this->status;
    }

    function getCliente() {
        return $this->cliente;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setData_abertura($data_abertura) {
        $this->data_abertura = $data_abertura;
    }

    function setData_fechmto($data_fechmto) {
        $this->data_fechmto = $data_fechmto;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    function setStatus($status) {
        $this->status = $status;
    }

    function setCliente($cliente) {
        $this->cliente = $cliente;
    }

}
