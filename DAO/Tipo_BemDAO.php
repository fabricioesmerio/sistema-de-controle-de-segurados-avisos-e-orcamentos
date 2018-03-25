<?php
require_once '../Config/functions.php';

class Tipo_BemDAO {
    public function insert(Tipo_Bem $tipo) {
        $pdo = connectdb();
        $pdo->beginTransaction();
        try {
            $stmt = $pdo->prepare("INSERT INTO tipobem (`tipoBem`) VALUES (:tipo)");
            $stmt->bindValue(":tipo", $tipo->getTipo());
            $stmt->execute();
            if ($stmt->rowCount() > 0){
                $pdo->commit();
                return TRUE;
            }
        } catch (PDOException $e) {
            echo 'Erro ao inserir o tipo de bem. Mensagem: '.$e->getMessage();
            $pdo->rollBack();
        }
    }
    
    public function update(Tipo_Bem $tipo) {
        $pdo = connectdb();
        $pdo->beginTransaction();
        try {
            $stmt = $pdo->prepare("UPDATE tipobem SET `tipoBem` = :tipo WHERE id = :id");
            $stmt->bindValue(":tipo", $tipo->getTipo());
            $stmt->bindValue(":id", $tipo->getId());
            $stmt->execute();
            if ($stmt->rowCount() > 0){
                $pdo->commit();
                return TRUE;
            }
        } catch (PDOException $e) {
            echo 'Erro ao atualizar. Mensagem: '.$e->getMessage();
            $pdo->rollBack();
        }
    }
    
    public function getAll() {
        $pdo = connectdb();
        try {
            $stmt = $pdo->prepare("SELECT * FROM tipobem");
            $stmt->execute();
            if($stmt->rowCount() > 0){
                $return = array();
                $tipo = new Tipo_Bem();
                while ($rs = $stmt->fetch(PDO::FETCH_OBJ)){
                    $tipo->setId($rs->id);
                    $tipo->setTipo(utf8_decode($rs->tipoBem));
                    $return[] = clone $tipo;
                }
                return $return;
            }
        } catch (PDOException $e) {
            echo 'Erro ao selecionar os tipos de bens. Mensagem: '.$e->getMessage();
        }
    }
    
    public function getById($id) {
        $pdo = connectdb();
        try {
            $stmt = $pdo->prepare('SELECT * FROM tipobem WHERE id = :id');
            $stmt->bindValue(":id", $id);
            $stmt->execute();
            if($stmt->rowCount() > 0){
                $obj = new Tipo_Bem();
                while ($rs = $stmt->fetch(PDO::FETCH_OBJ)){
                    $obj->setId($rs->id);
                    $obj->setTipo($rs->tipoBem);
                    $return = clone $obj;
                }
                return $return;
            }
        } catch (PDOException $e) {
            echo 'Erro ao buscar no banco de dados. <br /><b>Mensagem:</b> '.$e->getMessage();
        }
    }
}
