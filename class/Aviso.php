<?php

/**
 * Description of Aviso
 *
 * @author Fabrício Esmério
 */
class Aviso {
    private $id;
    private $descricao;
    private $data_abertura;
    private $data_fechamnto;
    private $status;
    private $usuario_respons;
    
    function getId() {
        return $this->id;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function getData_abertura() {
        return $this->data_abertura;
    }

    function getData_fechamnto() {
        return $this->data_fechamnto;
    }

    function getStatus() {
        return $this->status;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    function setData_abertura($data_abertura) {
        $this->data_abertura = $data_abertura;
    }

    function setData_fechamnto($data_fechamnto) {
        $this->data_fechamnto = $data_fechamnto;
    }

    function setStatus($status) {
        $this->status = $status;
    }

    function getUsuario_respons() {
        return $this->usuario_respons;
    }

    function setUsuario_respons($usuario_respons) {
        $this->usuario_respons = $usuario_respons;
    }

}
