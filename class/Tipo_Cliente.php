<?php


class Tipo_Cliente {
    
    private $id;
    private $tipo_cliente;
    
    function getId() {
        return $this->id;
    }

    function getTipo() {
        return $this->tipo_cliente;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setTipo($tipo) {
        $this->tipo_cliente = $tipo;
    }

    
}
