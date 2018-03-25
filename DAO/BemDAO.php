<?php

require_once '../Config/functions.php';

/**
 * Description of BemDAO
 *
 * @author Fabrício Esmério
 */
class BemDAO {

    public function insert(Bem $bem) {
        $pdo = connectdb();
        $pdo->beginTransaction();
        try {
            $stmt = $pdo->prepare('INSERT INTO bem (marca, modelo, anoModelo, zeroKm, combustivel, codFipe, placa, '
                    . 'chassi, categoria, uso, transportes, blindado, cepPernoite, cidadePernoite, estadoPernoite, '
                    . 'atividadeEco, tipoBem, cliente) VALUES (:marca, :modelo, :ano, :zero, :comb, :cod, :placa,'
                    . ':chassi, :cat, :uso, :trans, :blin, :cep, :cid, :est, :ati, :tipo, :cli)');
            $stmt->bindValue(":marca", $bem->getMarca());
            $stmt->bindValue(":modelo", $bem->getModelo());
            $stmt->bindValue(":ano", $bem->getAnoModelo());
            $stmt->bindValue(":zero", $bem->getZeroKm());
            $stmt->bindValue(":comb", $bem->getCombustivel());
            $stmt->bindValue(":cod", $bem->getCodFipe());
            $stmt->bindValue(":placa", $bem->getPlaca());
            $stmt->bindValue(":chassi", $bem->getChassi());
            $stmt->bindValue(":cat", $bem->getCategoria());
            $stmt->bindValue(":uso", $bem->getUso());
            $stmt->bindValue(":trans", $bem->getTransportes());
            $stmt->bindValue(":blin", $bem->getBlindado());
            $stmt->bindValue(":cep", $bem->getCepPernoite());
            $stmt->bindValue(":cid", $bem->getCidadePernoite());
            $stmt->bindValue(":est", $bem->getEstadoPernoite());
            $stmt->bindValue(":ati", $bem->getAtividadeEco());
            $stmt->bindValue(":tipo", $bem->getTipoBem());
            $stmt->bindValue(":cli", $bem->getCliente());
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $pdo->commit();
                return TRUE;
            } else {
                throw new Exception("Não foi possível salvar o BEM informado.");
            }
        } catch (PDOException $e) {
            echo 'Erro ao salvar o bem. Mensagem: ' . $e->getMessage();
            $pdo->rollBack();
        }
    }

    public function returnID($marca, $modelo, $placa, $codFipe, $chassi, $cep, $codVerificacao) {
        $pdo = connectdb();
        try {
            $stmt = $pdo->prepare("SELECT id FROM bem WHERE marca = :marca AND modelo = :modelo "
                    . "AND placa = :placa AND codFipe = :cod AND chassi = :chassi AND cep = :cep AND "
                    . "cod_verificacao = :codVer");
            $stmt->bindValue(':marca', $marca);
            $stmt->bindValue(':modelo', $modelo);
            $stmt->bindValue(':placa', $placa);
            $stmt->bindValue(':cod', $codFipe);
            $stmt->bindValue(':chassi', $chassi);
            $stmt->bindValue(':cep', $cep);
            $stmt->bindValue(':codVer', $codVerificacao);
            $stmt->execute();
            if ($stmt->rowCount() == 1) {
                while ($rs = $stmt->fetchAll(PDO::FETCH_OBJ)) {
                    $id = $rs->id;
                }
                return $id;
            } else {
                throw new Exception("Ocorreu um erro ao selecionar o identificador.");
            }
        } catch (PDOException $e) {
            echo 'Erro: ' . $e->getMessage();
        }
    }

    public function getAll($cliente) {
        if ($cliente != NULL || !(empty($cliente))) {
            $pdo = connectdb();
            try {
                $stmt = $pdo->prepare('SELECT * FROM bem WHERE cliente = :cliente');
                $stmt->bindValue(":cliente", $cliente);
                $stmt->execute();
                if ($stmt->rowCount() > 0) {
                    if ($stmt->rowCount() > 1) {
                        $obj = new Bem();
                        $return = array();
                        while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                            $obj->setAnoModelo($rs->anoModelo);
                            $obj->setAtividadeEco($rs->atividadeEco);
                            $obj->setBlindado($rs->blindado);
                            $obj->setCategoria($rs->categoria);
                            $obj->setCepPernoite($rs->cepPernoite);
                            $obj->setChassi($rs->chassi);
                            $obj->setCidadePernoite($rs->cidadePernoite);
                            $obj->setCliente($rs->cliente);
                            $obj->setCodFipe($rs->codFipe);
                            $obj->setCombustivel($rs->combustivel);
                            $obj->setEstadoPernoite($rs->estadoPernoite);
                            $obj->setId($rs->id);
                            $obj->setMarca($rs->marca);
                            $obj->setModelo($rs->modelo);
                            $obj->setPlaca($rs->placa);
                            $obj->setTipoBem($rs->tipoBem);
                            $obj->setTransportes($rs->transportes);
                            $obj->setUso($rs->uso);
                            $obj->setZeroKm($rs->zeroKm);
                            $return[] = clone $obj;
                        }
                        return $return;
                    } elseif ($stmt->rowCount() == 1) {
                        $obj = new Bem();
                        while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                            $obj->setAnoModelo($rs->anoModelo);
                            $obj->setAtividadeEco($rs->atividadeEco);
                            $obj->setBlindado($rs->blindado);
                            $obj->setCategoria($rs->categoria);
                            $obj->setCepPernoite($rs->cepPernoite);
                            $obj->setChassi($rs->chassi);
                            $obj->setCidadePernoite($rs->cidadePernoite);
                            $obj->setCliente($rs->cliente);
                            $obj->setCodFipe($rs->codFipe);
                            $obj->setCombustivel($rs->combustivel);
                            $obj->setEstadoPernoite($rs->estadoPernoite);
                            $obj->setId($rs->id);
                            $obj->setMarca($rs->marca);
                            $obj->setModelo($rs->modelo);
                            $obj->setPlaca($rs->placa);
                            $obj->setTipoBem($rs->tipoBem);
                            $obj->setTransportes($rs->transportes);
                            $obj->setUso($rs->uso);
                            $obj->setZeroKm($rs->zeroKm);
                            $return = clone $obj;
                        }
                        return $return;
                    }
                } else {
                    return FALSE;
                }
            } catch (PDOException $e) {
                echo 'Erro ao selecionar os bens.<br />Mensagem: ' . $e->getMessage();
            }
        } else {
            return false;
        }
    }

    public function getById($id) {
        $pdo = connectdb();
        try {
            $stmt = $pdo->prepare("SELECT * FROM bem WHERE id = :id ");
            $stmt->bindValue(":id", $id);
            $stmt->execute();
            if ($stmt->rowCount() >= 1) {
                $obj = new Bem();
                while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                    $obj->setAnoModelo($rs->anoModelo);
                    $obj->setAtividadeEco($rs->atividadeEco);
                    $obj->setBlindado($rs->blindado);
                    $obj->setCategoria($rs->categoria);
                    $obj->setCepPernoite($rs->cepPernoite);
                    $obj->setChassi($rs->chassi);
                    $obj->setCidadePernoite($rs->cidadePernoite);
                    $obj->setCliente($rs->cliente);
                    $obj->setCodFipe($rs->codFipe);
                    $obj->setCombustivel($rs->combustivel);
                    $obj->setEstadoPernoite($rs->estadoPernoite);
                    $obj->setId($rs->id);
                    $obj->setMarca($rs->marca);
                    $obj->setModelo($rs->modelo);
                    $obj->setPlaca($rs->placa);
                    $obj->setTipoBem($rs->tipoBem);
                    $obj->setTransportes($rs->transportes);
                    $obj->setUso($rs->uso);
                    $obj->setZeroKm($rs->zeroKm);
                    $return = clone $obj;
                }
                return $return;
            }
        } catch (PDOException $e) {
            echo 'Erro ao buscar o bem. <br /><b>Mensagem: </b>'.$e->getMessage();
            die();
        }
    }

}
