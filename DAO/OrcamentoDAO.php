<?php

require_once '../Config/functions.php';

/**
 * Description of OrcamentoDAO
 *
 * @author Asus
 */
class OrcamentoDAO {

    public function insert(Orcamento $o) {
        $pdo = connectdb();
        $pdo->beginTransaction();
        try {
            $stmt = $pdo->prepare("INSERT INTO orcamento (data_abertura, descricao, status, cliente) VALUES (:dataA, :desc, "
                    . ":status, :cli)");
            $stmt->bindValue(":dataA", $o->getData_abertura());
            $stmt->bindValue(":desc", $o->getDescricao());
            $stmt->bindValue(":status", $o->getStatus());
            $stmt->bindValue(":cli", $o->getCliente());
            $stmt->execute();
            if ($stmt->rowCount()) {
                $pdo->commit();
                return TRUE;
            } else {
                $pdo->rollBack();
                return FALSE;
            }
        } catch (PDOException $e) {
            echo 'Ocorreu um erro ao salvar o orçamento. <br /><b>Mensagem:</b> ' . $e->getMessage();
            $pdo->rollBack();
        }
    }

    public function update(Orcamento $o) {
        $pdo = connectdb();
        $pdo->beginTransaction();
        try {
            $stmt = $pdo->prepare("UPDATE orcamento SET data_abertura = :dataA, data_fechmto = :dataF, "
                    . "descricao = :desc, status = :status, cliente = :cli WHERE id = :id");
            $stmt->bindValue(":dataA", $o->getData_abertura());
            $stmt->bindValue(":desc", $o->getDescricao());
            $stmt->bindValue(":status", $o->getStatus());
            $stmt->bindValue(":cli", $o->getCliente());
            $stmt->bindValue(":dataF", $o->getData_fechmto());
            $stmt->bindValue(":id", $o->getId());
            $stmt->execute();
            if ($stmt->rowCount()) {
                $pdo->commit();
                return TRUE;
            } else {
                $pdo->rollBack();
                return FALSE;
            }
        } catch (PDOException $e) {
            echo 'Ocorreu um erro ao atualizar o orçamento. <br /><b>Mensagem:</b> ' . $e->getMessage();
            $pdo->rollBack();
        }
    }

    public function getAll() {
        $pdo = connectdb();
        try {
            $stmt = $pdo->prepare("SELECT * FROM orcamento");
            $stmt->execute();
            if ($stmt->rowCount()) {
                $obj = new Orcamento();
                $return = array();
                while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                    $obj->setCliente($rs->cliente);
                    $obj->setData_abertura($rs->data_abertura);
                    $obj->setData_fechmto($rs->data_fechmto);
                    $obj->setDescricao($rs->descricao);
                    $obj->setId($rs->id);
                    $obj->setStatus($rs->status);
                    $return[] = clone $obj;
                }
                return $return;
            } else {
                return NULL;
            }
        } catch (PDOException $e) {
            
        }
    }

    /**
     * Função que retorna todos os orçamentos com status ativo.
     * @return \Orcamento
     */
    public function getAllAtivo() {
        $pdo = connectdb();
        try {
            $stmt = $pdo->prepare("SELECT * FROM orcamento WHERE status = 1");
            $stmt->execute();
            if ($stmt->rowCount()) {
                $obj = new Orcamento();
                $return = array();
                while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                    $obj->setCliente($rs->cliente);
                    $obj->setData_abertura($rs->data_abertura);
                    $obj->setData_fechmto($rs->data_fechmto);
                    $obj->setDescricao($rs->descricao);
                    $obj->setId($rs->id);
                    $obj->setStatus($rs->status);
                    $return[] = clone $obj;
                }
                return $return;
            } else {
                return NULL;
            }
        } catch (PDOException $e) {
            
        }
    }

    public function getById($id) {
        $pdo = connectdb();
        try {
            $stmt = $pdo->prepare("SELECT * FROM orcamento WHERE id = :id");
            $stmt->bindValue(":id", $id);
            $stmt->execute();
            if ($stmt->rowCount()) {
                $obj = new Orcamento();
                while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                    $obj->setCliente($rs->cliente);
                    $obj->setData_abertura($rs->data_abertura);
                    $obj->setData_fechmto($rs->data_fechmto);
                    $obj->setDescricao($rs->descricao);
                    $obj->setId($rs->id);
                    $obj->setStatus($rs->status);
                    $return = clone $obj;
                }
                return $return;
            } else {
                return NULL;
            }
        } catch (PDOException $e) {
            echo 'Ocorreu um erro ao selecionar o orçamento.<br /><b>Mensagem:</b> ' . $e->getMessage();
            die();
        }
    }

    public function count() {
        $pdo = connectdb();
        try {
            $stmt = $pdo->prepare("SELECT * FROM orcamento WHERE status = 1");
            $stmt->execute();
            return $stmt->rowCount();
        } catch (PDOException $e) {
            echo 'Ocorreu um erro ao contar os orçamentos salvos no banco de dados.<br /><b>Mensagem: </b>' . $e->getMessage();
            die();
        }
    }

}
