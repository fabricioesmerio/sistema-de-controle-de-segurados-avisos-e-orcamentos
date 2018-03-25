<?php

require_once '../Config/functions.php';

class clienteDAO {

    public function insert(Cliente $c) {
        $pdo = connectdb();
        $pdo->beginTransaction();
        try {
            $stmt = $pdo->prepare('INSERT INTO cliente (nome, razao, cpf, cnpj, cnh, estado_civil, celular, '
                    . 'telefone, sexo, data_nasc, obs, tipo_cliente, finali_eco) '
                    . 'VALUES(:nom, :raz, :cpf, :cnpj, :cnh, :estcvil, :cel, :tel, :sex, :dtnasc, :obs, :tipo, :finali)');
            $stmt->bindValue(":nom", $c->getNome());
            $stmt->bindValue(":raz", $c->getRazao());
            $stmt->bindValue(":cpf", $c->getCpf());
            $stmt->bindValue(":cnpj", $c->getCnpj());
            $stmt->bindValue(":cnh", $c->getCnh());
            $stmt->bindValue(":estcvil", $c->getEstadoCivil());
            $stmt->bindValue(":dtnasc", $c->getDataNasc());
            $stmt->bindValue(":cel", $c->getCelular());
            $stmt->bindValue(":tel", $c->getTelefone());
            $stmt->bindValue(":sex", $c->getSexo());
            $stmt->bindValue(":obs", $c->getObs());
            $stmt->bindValue(":tipo", $c->getTipoCliente());
            $stmt->bindValue(":finali", $c->getFinalidadeEco());
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $id = $pdo->lastInsertId();
                $pdo->commit();
                return $id;
            }
        } catch (PDOException $e) {
            echo 'Erro ao inserir o cliente. Erro: ' . $e->getMessage();
            $pdo->rollBack();
        }
    }

    public function update(Cliente $c) {
        $pdo = connectdb();
        $pdo->beginTransaction();
        try {
            $stmt = $pdo->prepare("UPDATE cliente SET nome = :nom, cpf = :cpf, cnpj = :cnpj, tipo_cliente = :tipo, "
                    . "razao = :raz, celular = :cel, cnh = :cnh, sexo = :sex, estado_civil = :estcvil, data_nasc = :dtnasc, "
                    . "obs = :obs, telefone = :tel, finali_eco = :finali, last_modified = :last WHERE cod = :cod");
            $stmt->bindValue(":cod", $c->getId());
            $stmt->bindValue(":nom", $c->getNome());
            $stmt->bindValue(":raz", $c->getRazao());
            $stmt->bindValue(":cpf", $c->getCpf());
            $stmt->bindValue(":cnpj", $c->getCnpj());
            $stmt->bindValue(":cnh", $c->getCnh());
            $stmt->bindValue(":estcvil", $c->getEstadoCivil());
            $stmt->bindValue(":dtnasc", $c->getDataNasc());
            $stmt->bindValue(":cel", $c->getCelular());
            $stmt->bindValue(":tel", $c->getTelefone());
            $stmt->bindValue(":sex", $c->getSexo());
            $stmt->bindValue(":obs", $c->getObs());
            $stmt->bindValue(":tipo", $c->getTipoCliente());
            $stmt->bindValue(":finali", $c->getFinalidadeEco());
            $stmt->bindValue(":last", $c->getLastModified());
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $linhas = $stmt->rowCount();
                $pdo->commit();
                return $linhas;
            }
        } catch (PDOException $e) {
            echo 'Erro ao atualizar: ' . $e->getMessage();
            $pdo->rollBack();
            die();
        }
    }

    public function getAllByTipo($tipo) {
        $pdo = connectdb();
        try {
            $stmt = $pdo->prepare("SELECT * FROM cliente WHERE tipo_cliente = :tipo");
            $stmt->bindValue(":tipo", $tipo);
            $stmt->execute();
            if ($stmt->rowCount() >= 1) {
                $return = array();
                $obj = new Cliente();
                while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                    $obj->setId($rs->cod);
                    $obj->setNome($rs->nome);
                    $obj->setCelular($rs->celular);
                    $obj->setTelefone($rs->telefone);
                    $obj->setCnpj($rs->cnpj);
                    $obj->setCpf($rs->cpf);
                    $return[] = clone $obj;
                }
                return $return;
            }
        } catch (PDOException $e) {
            echo 'Ocorreu um erro ao listar clientes. Erro :' . $e->getMessage();
        }
    }

    public function getAll() {
        $pdo = connectdb();
        try {
            $stmt = $pdo->prepare("SELECT * FROM cliente ORDER BY nome ASC");
            $stmt->execute();
            if ($stmt->rowCount() >= 1) {
                $return = array();
                $obj = new Cliente();
                while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                    $obj->setId($rs->cod);
                    $obj->setNome($rs->nome);
                    $obj->setCelular($rs->celular);
                    $obj->setTelefone($rs->telefone);
                    $obj->setCnpj($rs->cnpj);
                    $obj->setCpf($rs->cpf);
                    $return[] = clone $obj;
                }
                return $return;
            }
        } catch (PDOException $e) {
            echo 'Ocorreu um erro ao listar clientes. Erro :' . $e->getMessage();
        }
    }

    public function getById($cod) {
        $pdo = connectdb();
        try {
            $stmt = $pdo->prepare("SELECT * FROM cliente WHERE cod = :cod");
            $stmt->bindValue(":cod", $cod);
            $stmt->execute();
            if ($stmt->rowCount() >= 1) {
                $obj = new Cliente();
                while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                    $obj->setId($rs->cod);
                    $obj->setNome($rs->nome);
                    $obj->setRazao($rs->razao);
                    $obj->setTipoCliente($rs->tipo_cliente);
                    $obj->setCelular($rs->celular);
                    $obj->setTelefone($rs->telefone);
                    $obj->setCnh($rs->cnh);
                    $obj->setSexo($rs->sexo);
                    $obj->setEstadoCivil($rs->estado_civil);
                    $obj->setDataNasc($rs->data_nasc);
                    $obj->setCnpj($rs->cnpj);
                    $obj->setCpf($rs->cpf);
                    $obj->setObs($rs->obs);
                    $obj->setFinalidadeEco($rs->finali_eco);
                    $return = clone $obj;
                }
                return $return;
            }
        } catch (PDOException $e) {
            echo 'Ocorreu um erro ao procurar cliente. Erro :' . $e->getMessage();
        }
    }

    /* Funções do autocomplete */

    public function getByName($param) {
        $pdo = connectdb();
        try {
            $stmt = $pdo->prepare("SELECT cliente.cod, cliente.nome, cliente.tipo_cliente FROM cliente WHERE cliente.nome = :nome");
            $stmt->bindValue(":nome", $param);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Ocorreu em erro ao pesquisar. Mensagem: ' . $e->getMessage();
        }
    }

    public function getByLike($busca) {
        $pdo = connectdb();
        try {
            $stmt = $pdo->prepare('SELECT cliente.cod, cliente.nome, cliente.tipo_cliente FROM cliente WHERE cliente.nome LIKE :nome');
            $stmt->bindValue(":nome", $busca);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo 'Erro ao pesquisar. Mensagem: ' . $e->getMessage();
        }
    }

    public function getByLikeLimit($busca) {
        $pdo = connectdb();
        try {
            $stmt = $pdo->prepare('SELECT cliente.cod, cliente.nome, cliente.tipo_cliente FROM cliente WHERE nome LIKE :nome LIMIT 1');
            $stmt->bindValue(":nome", $busca);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo 'Erro ao pesquisar. Mensagem: ' . $e->getMessage();
        }
    }

    /* FIM - Funções do autocomplete */

    public function getIdByParams($nome, $cpf, $cnpj, $celular, $telefone) {
        $pdo = connectdb();
        try {
            $stmt = $pdo->prepare("SELECT * FROM cliente WHERE nome = :nome OR cpf = :cpf AND cnpj = :cnpj AND celular = :cel AND telefone = :tel;");
            $stmt->bindValue(":nome", $nome);
            $stmt->bindValue(":cpf", $cpf);
            $stmt->bindValue(":cnpj", $cnpj);
            $stmt->bindValue(":cel", $celular);
            $stmt->bindValue(":tel", $telefone);
            $stmt->execute();
            if ($stmt->rowCount() == 1) {
                $obj = new Cliente();
                while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                    $id = $rs->cod;
                }
                return $id;
            }
        } catch (PDOException $e) {
            echo 'Ocorreu um erro ao pesquisar o código do cliente.<br />Mensagem: '.$e->getMessage();
        }
    }

    public function count() {
        $pdo = connectdb();
        try {
            $stmt = $pdo->prepare("SELECT * FROM cliente");
            $stmt->execute();
            return $stmt->rowCount();
        } catch (PDOException $e) {
            echo 'Erro ao contar os clientes. <br /><b>Mensagem:</b> '.$e->getMessage();
            die();
        }
    }
}
