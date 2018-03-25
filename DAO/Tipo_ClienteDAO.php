<?php

require_once '../Config/functions.php';

class Tipo_ClienteDAO {
    public function getByDescri($descri) {
        $pdo = connectdb();
        $pdo->beginTransaction();
        try {
            $stmt = $pdo->prepare("SELECT * FROM tipocliente WHERE tipo_cliente = :d");
            $stmt->bindValue(":d", $descri);
            $stmt->execute();
            if ($stmt->rowCount() > 0){
                $tc = new Tipo_Cliente();
                $rs = $stmt->fetch(PDO::FETCH_OBJ);
                $tc->setId($rs->id);
                $tc->setTipo($rs->tipo_cliente);
                return $tc;
            }
            
        } catch (Exception $e) {
            echo 'Erro ao selecionar o Tipo de cliente. Mensagem de erro: '.$e->getMessage();
        }
    }
    
    public function getById($id) {
        $pdo = connectdb();
        $pdo->beginTransaction();
        try {
            $stmt = $pdo->prepare("SELECT * FROM tipocliente WHERE id = :d");
            $stmt->bindValue(":d", $id);
            $stmt->execute();
            if ($stmt->rowCount() > 0){
                $tc = new Tipo_Cliente();
                $rs = $stmt->fetch(PDO::FETCH_OBJ);
                $tc->setId($rs->id);
                $tc->setTipo($rs->tipo_cliente);
                return $tc;
            }
            
        } catch (Exception $e) {
            echo 'Erro ao selecionar o Tipo de cliente. Mensagem de erro: '.$e->getMessage();
        }
    }
}
