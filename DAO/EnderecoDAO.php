<?php

require_once '../Config/functions.php';

class EnderecoDAO {

    public function insert(Endereco $end, $cli) {
        if ($cli == NULL || $cli == '')
            return FALSE;
        $pdo = connectdb();
        $pdo->beginTransaction();
        try {
            $stmt = $pdo->prepare('INSERT INTO endereco (rua, numero, complemento, bairro, cidade, cep, estado, cliente) '
                    . 'VALUES (:rua, :num, :com, :bair, :ci, :cep, :est, :cli )');
            $stmt->bindValue(":rua", $end->getRua());
            $stmt->bindValue(":num", $end->getNumero());
            $stmt->bindValue(":com", $end->getComplemento());
            $stmt->bindValue(":bair", $end->getBairro());
            $stmt->bindValue(":ci", $end->getCidade());
            $stmt->bindValue(":cep", $end->getCep());
            $stmt->bindValue(":est", $end->getEstado());
            $stmt->bindValue(":cli", $cli);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $pdo->commit();
                return TRUE;
            } else {
                return FALSE;
            }
        } catch (Exception $e) {
            echo 'Erro ao inserir o endereço. Mensagem: ' . $e->getMessage();
            $pdo->rollBack();
        }
    }

    public function update(Endereco $end) {
        $pdo = connectdb();
        $pdo->beginTransaction();
        try {

            $stmt = $pdo->prepare("UPDATE endereco SET rua = :rua, numero = :num, complemento = :com, bairro = :bair, "
                    . "cidade = :ci, estado = :est, cep = :cep, cliente = :cli WHERE id = :id");
            $stmt->bindValue(":id", $end->getId());
            $stmt->bindValue(":rua", $end->getRua());
            $stmt->bindValue(":num", $end->getNumero());
            $stmt->bindValue(":com", $end->getComplemento());
            $stmt->bindValue(":bair", $end->getBairro());
            $stmt->bindValue(":ci", $end->getCidade());
            $stmt->bindValue(":cep", $end->getCep());
            $stmt->bindValue(":est", $end->getEstado());
            $stmt->bindValue(":cli", $end->getCliente());
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $pdo->commit();
                return TRUE;
            }
        } catch (PDOException $e) {
            echo "Erro ao atualizar o endereço: " . $e->getMessage();
            $pdo->rollBack();
            die();
        }
    }

    public function getByCliente($cliente) {
        $pdo = connectdb();
        try {
            $stmt = $pdo->prepare("SELECT * FROM endereco WHERE cliente = :cli");
            $stmt->bindValue(":cli", $cliente);
            $stmt->execute();
            if ($stmt->rowCount() >= 1) {
                $obj = new Endereco();
                while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                    $obj->setId($rs->id);
                    $obj->setRua(stripslashes($rs->rua));
                    $obj->setNumero($rs->numero);
                    $obj->setComplemento($rs->complemento);
                    $obj->setBairro($rs->bairro);
                    $obj->setCep($rs->cep);
                    $obj->setCidade($rs->cidade);
                    $obj->setEstado($rs->estado);
                    $return = clone $obj;
                }
                return $return;
            }
        } catch (PDOException $e) {
            echo 'Ocorreu um erro ao acessar o endereço. Erro :' . $e->getMessage();
        }
    }

}
