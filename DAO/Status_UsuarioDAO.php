<?php

require_once '../Config/functions.php';

class Status_UsuarioDAO {
    
    public function getAll() {
        $pdo = connectdb();
        try {
            $stmt = $pdo->prepare("SELECT * FROM statususuario ORDER BY id");
            $stmt->execute();
            if ($stmt->rowCount() > 0){
                $obj = new Status_Usuario();
                $return = array();
                while ($rs = $stmt->fetch(PDO::FETCH_OBJ)){
                    $obj->setId($rs->id);
                    $obj->setStatus($rs->status);
                    $return[] = clone $obj;
                }
                return $return;
            }
        } catch (PDOException $e) {
            echo 'Ocorreu um erro ao tentar buscar os status do usuário. <br />Mensagem de erro: '.$e->getMessage();
        }
    }
    
    public function getById($id) {
        $pdo = connectdb();
        try {
            $stmt = $pdo->prepare("SELECT * FROM statususuario WHERE id = :id");
            $stmt->bindValue(":id", $id);
            $stmt->execute();
            if ($stmt->rowCount() > 0){
                $obj = new Status_Usuario();
                while ($rs = $stmt->fetch(PDO::FETCH_OBJ)){
                    $obj->setId($rs->id);
                    $obj->setStatus($rs->status);
                    $return = clone $obj;
                }
                return $return;
            }
        } catch (PDOException $e) {
            echo 'Ocorreu um erro ao tentar buscar os status do usuário. <br />Mensagem de erro: '.$e->getMessage();
        }
    }
    
}
