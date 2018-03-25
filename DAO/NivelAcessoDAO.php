<?php
require_once '../Config/functions.php';

class NivelAcessoDAO {
    
    public function getAll() {
        $pdo = connectdb();
        try {
            $stmt = $pdo->prepare("SELECT * FROM nivelacesso ORDER BY id");
            $stmt->execute();
            if ($stmt->rowCount() > 0){
               $nA = new NivelAcesso();
               $return = array();
               while ($rs = $stmt->fetch(PDO::FETCH_OBJ)){
                   $nA->setId($rs->id);
                   $nA->setNivel($rs->nivel);
                   $return[] = clone $nA;
               }
               return $return;
            }
        } catch (PDOException $e) {
            echo 'Ocorreu um erro ao tentar buscar os níveis de acesso. <br />Mensagem de erro: '.$e->getMessage();
        }
    }
    
    public function getById($id) {
        $pdo = connectdb();
        try {
            $stmt = $pdo->prepare("SELECT * FROM nivelacesso WHERE id = :id");
            $stmt->bindValue(":id", $id);
            $stmt->execute();
            if ($stmt->rowCount()){
               $nA = new NivelAcesso();
               while ($rs = $stmt->fetch(PDO::FETCH_OBJ)){
                   $nA->setId($rs->id);
                   $nA->setNivel($rs->nivel);
                   $return = clone $nA;
               }
               return $return;
            } else {
                return NULL;
            }
        } catch (PDOException $e) {
            echo 'Ocorreu um erro ao tentar buscar os níveis de acesso. <br />Mensagem de erro: '.$e->getMessage();
            die();
        }
    }
    
}
