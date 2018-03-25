<?php


class Tipo_Bem {
    
    private $id;
    private $tipoBem;
    
    function getId() {
        return $this->id;
    }

    function getTipo() {
        return $this->tipoBem;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setTipo($tipo) {
        $this->tipoBem = $tipo;
    }


    
}
