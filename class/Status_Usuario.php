<?php


class Status_Usuario {
    
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
