<?php

/*
 * Classe responsável por atribuir um Status às classes 
 * Aviso e Orcamento
 */

/**
 * Description of Status
 *
 * @author Fabrício Esmério
 */
class Status {
    private $id;
    private $status;
    
    function getId() {
        return $this->id;
    }

    function getStatus() {
        return $this->status;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setStatus($status) {
        $this->status = $status;
    }
}
