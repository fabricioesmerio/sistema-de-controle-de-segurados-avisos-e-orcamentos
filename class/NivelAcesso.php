<?php


class NivelAcesso {
    
    private $id;
    private $nivel;
    
    function getId() {
        return $this->id;
    }

    function getNivel() {
        return $this->nivel;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNivel($nivel) {
        $this->nivel = $nivel;
    }


    
}
