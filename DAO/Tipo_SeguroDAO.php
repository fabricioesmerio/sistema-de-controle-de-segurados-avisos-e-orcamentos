<?php
require_once '../Config/functions.php';

class Tipo_SeguroDAO {
    
    public function getAll() {
        $pdo = connectdb();
        try {
            $stmt = $pdo->prepare('SELECT * FROM tipo_seguro ORDER BY tipo_seguro asc');
            $stmt->execute();
            if ($stmt->rowCount() > 0){
                $obj = new Tipo_Seguro();
                $return = array();
                while ($rs = $stmt->fetch(PDO::FETCH_OBJ)){
                    $obj->setId($rs->id);
                    $obj->setTipo($rs->tipo_seguro);
                    $return[] = clone $obj;
                }
                return $return;
            }
        } catch (PDOException $e) {
            echo 'Erro ao listar os tipos de seguro. <br /><b>Mensagem: '.$e->getMessage().'</b>';
        }
    }
    
    public function getById($id) {
        $pdo = connectdb();
        try {
            $stmt = $pdo->prepare("SELECT * FROM tipo_seguro WHERE id = :id");
            $stmt->bindValue(":id", $id);
            $stmt->execute();
            if ($stmt->rowCount() > 0){
                $obj = new Tipo_Seguro();
                while ($rs = $stmt->fetch(PDO::FETCH_OBJ)){
                    $obj->setId($rs->id);
                    $obj->setTipo($rs->tipo_seguro);
                    $return = clone $obj;
                }
                return $return;
            }
        } catch (PDOException $e) {
            echo 'Erro ao buscar o tipo de seguro.<br /><b>Mensagem: '.$e->getMessage().'</b>';
        }
    }
    
}
