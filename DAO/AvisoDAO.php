<?php

require_once '../Config/functions.php';

/**
 * Description of AvisoDAO
 *
 * @author Asus
 */
class AvisoDAO {

    public function insert(Aviso $a) {
        $pdo = connectdb();
        $pdo->beginTransaction();
        try {
            $stmt = $pdo->prepare("INSERT INTO avisos (descricao, data_abertura, status, usuario_respons) VALUES (:desc, :data, :status, :usu)");
            $stmt->bindValue(":desc", $a->getDescricao());
            $stmt->bindValue(":data", $a->getData_abertura());
            $stmt->bindValue(":status", $a->getStatus());
            $stmt->bindValue(":usu", $a->getUsuario_respons());
            $stmt->execute();
            if ($stmt->rowCount()) {
                $pdo->commit();
                return TRUE;
            } else {
                return FALSE;
            }
        } catch (PDOException $e) {
            echo 'Ocorreu um erro ao inserir o aviso. <br /><b>Mensagem: </b>' . $e->getMessage();
            $pdo->rollBack();
            die();
        }
    }

    public function update(Aviso $a) {
        $pdo = connectdb();
        $pdo->beginTransaction();
        try {
            $stmt = $pdo->prepare("UPDATE avisos SET descricao = :desc, data_abertura = :dataA, data_fechamnto = :dataF, "
                    . "status = :status, usuario_respons = :usu WHERE id = :id");
            $stmt->bindValue(":desc", $a->getDescricao());
            $stmt->bindValue(":dataA", $a->getData_abertura());
            $stmt->bindValue(":status", $a->getStatus());
            $stmt->bindValue(":usu", $a->getUsuario_respons());
            $stmt->bindValue(":dataF", $a->getData_fechamnto());
            $stmt->bindValue(":id", $a->getId());
            $stmt->execute();
            if ($stmt->rowCount()) {
                $pdo->commit();
                return TRUE;
            } else {
                return FALSE;
            }
        } catch (PDOException $e) {
            echo 'Ocorreu um erro ao atualizar o aviso. <br /><b>Mensagem: </b>' . $e->getMessage();
            $pdo->rollBack();
            die();
        }
    }

    public function getAll() {
        $pdo = connectdb();
        try {
            $stmt = $pdo->prepare("SELECT * FROM avisos");
            $stmt->execute();
            if ($stmt->rowCount()) {
                $obj = new Aviso();
                $return = array();
                while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                    $obj->setData_abertura($rs->data_abertura);
                    $obj->setData_fechamnto($rs->data_fechamnto);
                    $obj->setDescricao($rs->descricao);
                    $obj->setId($rs->id);
                    $obj->setStatus($rs->status);
                    $obj->setUsuario_respons($rs->usuario_respons);
                    $return[] = clone $obj;
                }
                return $return;
            } else {
                return NULL;
            }
        } catch (PDOException $ex) {
            echo 'Ocorreu um erro ao selecionar todos os avisos do banco.<br /><b>Mensagem</b>: ' . $ex->getMessage();
            die();
        }
    }

    public function getAllAtivos() {
        $pdo = connectdb();
        try {
            $stmt = $pdo->prepare("SELECT * FROM avisos WHERE status = 1");
            $stmt->execute();
            if ($stmt->rowCount()) {
                $obj = new Aviso();
                $return = array();
                while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                    $obj->setData_abertura($rs->data_abertura);
                    $obj->setData_fechamnto($rs->data_fechamnto);
                    $obj->setDescricao($rs->descricao);
                    $obj->setId($rs->id);
                    $obj->setStatus($rs->status);
                    $obj->setUsuario_respons($rs->usuario_respons);
                    $return[] = clone $obj;
                }
                return $return;
            } else {
                return NULL;
            }
        } catch (PDOException $ex) {
            echo 'Ocorreu um erro ao selecionar todos os avisos do banco.<br /><b>Mensagem</b>: ' . $ex->getMessage();
            die();
        }
    }

    public function getById($id) {
        $pdo = connectdb();
        try {
            $stmt = $pdo->prepare("SELECT * FROM avisos WHERE id = :id");
            $stmt->bindValue(":id", $id);
            $stmt->execute();
            if ($stmt->rowCount()) {
                $obj = new Aviso();
                while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                    $obj->setData_abertura($rs->data_abertura);
                    $obj->setData_fechamnto($rs->data_fechamnto);
                    $obj->setDescricao($rs->descricao);
                    $obj->setId($rs->id);
                    $obj->setStatus($rs->status);
                    $obj->setUsuario_respons($rs->usuario_respons);
                    $return = clone $obj;
                }
                return $return;
            } else {
                return NULL;
            }
        } catch (PDOException $ex) {
            echo 'Ocorreu um erro ao selecionar o aviso do banco.<br /><b>Mensagem</b>: ' . $ex->getMessage();
            die();
        }
    }

    public function count() {
        $pdo = connectdb();
        try {
            $stmt = $pdo->prepare("SELECT * FROM avisos WHERE status = 1");
            $stmt->execute();
            return $stmt->rowCount();
        } catch (PDOException $e) {
            echo 'Erro ao contar os avisos salvos no banco de dados. <br /><b>Mensagem: </b>' . $e->getMessage();
            die();
        }
    }

}
