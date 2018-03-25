<?php
require_once '../Config/functions.php';
/**
 * Description of StatusDAO
 *
 * @author Fabrício Esmério
 */
class StatusDAO {
    
    public function getAll() {
        $pdo = connectdb();
        try {
            $stmt = $pdo->prepare("SELECT * FROM status");
            $stmt->execute();
            if ($stmt->rowCount()){
                $obj = new Status();
                $return = array();
                while ($rs = $stmt->fetch(PDO::FETCH_OBJ)){
                    $obj->setId($rs->id);
                    $obj->setStatus($rs->status);
                    $return[] = clone $obj;
                }
                return $return;
            } else {
                return NULL;
            }
        } catch (PDOException $e) {
            echo 'Erro ao selecionar os status no banco de dados.<br /><b>Mensagem:</b> '.$e->getMessage();
            die();
        }
    }
    
    public function getById($id) {
        $pdo = connectdb();
        try {
            $stmt = $pdo->prepare("SELECT * FROM status WHERE id = :id");
            $stmt->bindValue(":id", $id);
            $stmt->execute();
            if ($stmt->rowCount()){
                $obj = new Status();
                while ($rs = $stmt->fetch(PDO::FETCH_OBJ)){
                    $obj->setId($rs->id);
                    $obj->setStatus($rs->status);
                    $return = clone $obj;
                }
                return $return;
            } else {
                return NULL;
            }
        } catch (PDOException $e) {
            echo 'Erro ao selecionar o status no banco de dados.<br /><b>Mensagem:</b> '.$e->getMessage();
            die();
        }
    }
}
