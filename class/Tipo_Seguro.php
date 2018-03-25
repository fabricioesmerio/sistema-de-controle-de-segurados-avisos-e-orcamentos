<?php

class Tipo_Seguro {
    private $id;
    private $tipo;
    
    function getId() {
        return $this->id;
    }

    function getTipo() {
        return $this->tipo;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setTipo($tipo) {
        $this->tipo = $tipo;
    }


}
