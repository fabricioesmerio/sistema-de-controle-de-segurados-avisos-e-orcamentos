<?php

require_once '../Config/functions.php';

class EmpresaDAO {
    public function insert(Empresa $emp) {
        
        $pdo = connectdb();
        $pdo->beginTransaction();
        try {
            $smt = $pdo->prepare('INSERT INTO empresa (nome, razao, cnpj, logo, telefone, rua, '
                    . 'numero, cep, cidade, estado) VALUES (:nome, :razao, :cnpj, :logo, :telefone, :rua, :numero, '
                    . ':cep, :cidade, :estado)');
            $smt->bindValue(":nome", $emp->getNome());
            $smt->bindValue(":razao", $emp->getRazao());
            $smt->bindValue(":cnpj", $emp->getCnpj());
            $smt->bindValue(":logo", $emp->getLogo());
            $smt->bindValue(":telefone", $emp->getTelefone());
            $smt->bindValue(":rua", $emp->getRua());
            $smt->bindValue(":numero", $emp->getNumero());
            $smt->bindValue(":cep", $emp->getCep());
            $smt->bindValue(":cidade", $emp->getCidade());
            $smt->bindValue(":estado", $emp->getEstado());
            $smt->execute();
            if ($smt->rowCount() > 0){
                $pdo->commit();
                return TRUE;
            }
        } catch (PDOException $e) {
            echo 'Erro ao inserir a Empresa: '.$e->getMessage();
            $pdo->rollBack();
            return FALSE;
        }
    }
    
    public function update(Empresa $emp) {
        $pdo = connectdb();
        $pdo->beginTransaction();
        try {
            $smt = $pdo->prepare('UPDATE empresa SET nome = :nome, razao = :razao, cnpj = :cnpj, logo = :logo, '
                    . 'telefone = :telefone, rua = :rua, numero = :numero, cep = :cep, cidade = :cidade, estado = :estado'
                    . ' WHERE id = :id');
            $smt->bindValue(":nome", $emp->getNome());
            $smt->bindValue(":razao", $emp->getRazao());
            $smt->bindValue(":cnpj", $emp->getCnpj());
            $smt->bindValue(":logo", $emp->getLogo());
            $smt->bindValue(":telefone", $emp->getTelefone());
            $smt->bindValue(":rua", $emp->getRua());
            $smt->bindValue(":numero", $emp->getNumero());
            $smt->bindValue(":cep", $emp->getCep());
            $smt->bindValue(":cidade", $emp->getCidade());
            $smt->bindValue(":estado", $emp->getEstado());
            $smt->bindValue(":id", $emp->getId());
            $smt->execute();
            if ($smt->rowCount() > 0){
                $pdo->commit();
            }
        } catch (PDOException $e) {
            echo 'Erro ao atualizar os dados da Empresa: '.$e->getMessage();
            $pdo->rollBack();
        }
    }
    
    public function getEmpresa() {
        $pdo = connectdb();
        try {
            $stmt = $pdo->prepare("SELECT * FROM empresa");
            $stmt->execute();
            if ($stmt->rowCount()){
                $obj = new Empresa();
                while ($rs = $stmt->fetch(PDO::FETCH_OBJ)){
                    $obj->setCep($rs->cep);
                    $obj->setCidade($rs->cidade);
                    $obj->setCnpj($rs->cnpj);
                    $obj->setEstado($rs->estado);
                    $obj->setId($rs->id);
                    $obj->setNome($rs->nome);
                    $obj->setNumero($rs->numero);
                    $obj->setRazao($rs->razao);
                    $obj->setRua($rs->rua);
                    $obj->setTelefone($rs->telefone);
                    $return = clone $obj;
                }
                return $return;
            } else {
                return FALSE;
            }
        } catch (PDOException $e) {
            echo 'Ocorreu um erro ao selecionar a empresa. <br /><b>Mensagem: </b>'.$e->getMessage();
            die();
        }
    }
}
