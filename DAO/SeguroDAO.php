<?php

require_once '../Config/functions.php';

class SeguroDAO {
    /*
     * BUSCAR POR MES E ANO ESPECÍFICO:
     * SELECT * FROM `seguro` WHERE MONTH(dataFinal) = 2 AND YEAR(dataFinal) = 2018
     */

    public function insert(Seguro $obj) {
        $pdo = connectdb();
        $pdo->beginTransaction();
        try {
            $stmt = $pdo->prepare("INSERT INTO seguro (dataInicio, dataFinal, classe, bem, cliente, sinistro, is_closed) VALUES (:dataIni, :dataFim, :classe, :bem, :cliente, :sin, :is_closed)");
            $stmt->bindValue(":dataIni", $obj->getDataInicio());
            $stmt->bindValue(":dataFim", $obj->getDataFinal());
            $stmt->bindValue(":classe", $obj->getClasse());
            $stmt->bindValue(":bem", $obj->getBem());
            $stmt->bindValue(":cliente", $obj->getCliente());
            $stmt->bindValue(":sin", $obj->getSinistro());
            $stmt->bindValue(":is_closed", $obj->getIs_closed());
            $stmt->execute();
            if ($stmt->rowCount() >= 1) {
                $pdo->commit();
                return TRUE;
            }
        } catch (PDOException $e) {
            echo 'Erro ao salvar o seguro!<br /><b>Mensagem:</b> ' . $e->getMessage();
            $pdo->rollBack();
            die();
        }
    }

    public function update(Seguro $obj) {
        $pdo = connectdb();
        $pdo->beginTransaction();
        try {
            $stmt = $pdo->prepare("UPDATE seguro SET dataInicio = :dataIni, dataFinal = :dataFim, classe = :classe, bem = :bem, "
                    . "cliente = :cliente, sinistro = :sin, is_closed = :is_closed WHERE cod = :id");
            $stmt->bindValue(":dataIni", $obj->getDataInicio());
            $stmt->bindValue(":dataFim", $obj->getDataFinal());
            $stmt->bindValue(":classe", $obj->getClasse());
            $stmt->bindValue(":sin", $obj->getSinistro());
            $stmt->bindValue(":id", $obj->getId());
            $stmt->bindValue(":bem", $obj->getBem());
            $stmt->bindValue(":cliente", $obj->getCliente());
            $stmt->bindValue(":is_closed", $obj->getIs_closed());
            $stmt->execute();
            if ($stmt->rowCount() >= 1) {
                $pdo->commit();
                return TRUE;
            } else {
                return FALSE;
            }
        } catch (PDOException $e) {
            echo 'Erro ao atualizar o seguro!<br /><b>Mensagem:</b> ' . $e->getMessage();
            $pdo->rollBack();
            die();
        }
    }

    public function getById($id) {
        $pdo = connectdb();
        try {
            $stmt = $pdo->prepare("SELECT * FROM seguro WHERE cod = :id");
            $stmt->bindValue(":id", $id);
            $stmt->execute();
            if ($stmt->rowCount() >= 1) {
                $obj = new Seguro();
                while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                    $obj->setBem($rs->bem);
                    $obj->setClasse($rs->classe);
                    $obj->setCliente($rs->cliente);
                    $obj->setDataFinal(dateForForm($rs->dataFinal));
                    $obj->setDataInicio(dateForForm($rs->dataInicio));
                    $obj->setId($rs->cod);
                    $obj->setSinistro($rs->sinistro);
                    $obj->setIs_closed($rs->is_closed);
                    $return = clone $obj;
                }
                return $return;
            }
        } catch (PDOException $e) {
            echo 'Erro ao selecionar o seguro. <br /><b>Mensagem:</b> ' . $e->getMessage();
            die();
        }
    }

    public function getAll() {
        $pdo = connectdb();
        try {
            $stmt = $pdo->prepare("SELECT * FROM seguro WHERE `is_closed` = '' ORDER BY cod DESC");
            $stmt->execute();
            if ($stmt->rowCount() >= 1) {
                $obj = new Seguro();
                $return = array();
                while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                    $obj->setBem($rs->bem);
                    $obj->setClasse($rs->classe);
                    $obj->setCliente($rs->cliente);
                    $obj->setDataFinal($rs->dataFinal);
                    $obj->setDataInicio($rs->dataInicio);
                    $obj->setId($rs->cod);
                    $obj->setSinistro($rs->sinistro);
                    $obj->setIs_closed($rs->is_closed);
                    $return[] = clone $obj;
                }
                return $return;
            } elseif ($stmt->rowCount() == 1) {
                $obj = new Seguro();
                while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                    $obj->setBem($rs->bem);
                    $obj->setClasse($rs->classe);
                    $obj->setCliente($rs->cliente);
                    $obj->setDataFinal($rs->dataFinal);
                    $obj->setDataInicio($rs->dataInicio);
                    $obj->setId($rs->cod);
                    $obj->setSinistro($rs->sinistro);
                    $obj->setIs_closed($rs->is_closed);
                    $return = clone $obj;
                }
                return $return;
            } else {
                return FALSE;
            }
        } catch (PDOException $e) {
            echo 'Erro ao listar os seguros. <br /><b>Mensagem:</b> ' . $e->getMessage();
            die();
        }
    }

    /**
     * Função Responsável por verificar os seguros que estão vencendo em 
     * determinado mês do ano.
     * Necessário passar como parâmetro o MÊS e o ANO.
     * 
     * A variável "modo" possui valores padronizados e se referem a forma
     * que será usado o método, podendo retornar somente a quantidade de registros
     * ou, ainda, todos os dados do(s) seguro(s) vencendo nesse período:
     * 
     * 1 - Retorna a quantidade
     * 2 - Retorna os objetos
     * 
     * Caso a contagem de linhas da consulta retornar 0, o método retorna o booleano
     * FALSE.
     * 
     * @param type $mes
     * @param type $ano
     * @param type $modo
     */
    public function verificaSegurosAVencer($mes, $ano, $modo) {
        $pdo = connectdb();
        try {
            $stmt = $pdo->prepare("SELECT * FROM seguro WHERE MONTH(dataFinal) = :mes AND YEAR(dataFinal) = :ano AND `is_closed` != 'sim' ORDER BY `dataFinal` DESC");
            $stmt->bindValue(":mes", $mes);
            $stmt->bindValue(":ano", $ano);
            $stmt->execute();
            if ($stmt->rowCount()) {
                if ($modo == 1) {
                    return $stmt->rowCount();
                } elseif ($modo == 2) {
                    if ($stmt->rowCount() > 1) {
                        $obj = new Seguro();
                        $return = array();
                        while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                            $obj->setBem($rs->bem);
                            $obj->setClasse($rs->classe);
                            $obj->setCliente($rs->cliente);
                            $obj->setDataFinal($rs->dataFinal);
                            $obj->setDataInicio($rs->dataInicio);
                            $obj->setId($rs->cod);
                            $obj->setSinistro($rs->sinistro);
                            $obj->setIs_closed($rs->is_closed);
                            $return[] = clone $obj;
                        }
                        return $return;
                    } else {
                        $obj = new Seguro();
                        while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                            $obj->setBem($rs->bem);
                            $obj->setClasse($rs->classe);
                            $obj->setCliente($rs->cliente);
                            $obj->setDataFinal($rs->dataFinal);
                            $obj->setDataInicio($rs->dataInicio);
                            $obj->setId($rs->cod);
                            $obj->setSinistro($rs->sinistro);
                            $obj->setIs_closed($rs->is_closed);
                            $return = clone $obj;
                        }
                        return $return;
                    }
                }
            } else {
                return FALSE;
            }
        } catch (PDOException $e) {
            echo 'Erro ao selecionar o seguro no período especificado.<br /><b>Mensagem: </b>' . $e->getMessage();
            die();
        }
    }

    public function buscaSeguroPorPeridio($dtIni, $dtFim) {
        if (($dtIni == "" || $dtIni == NULL) && ($dtFim != "" || $dtFim != NULL)) {
            $sql = "SELECT * FROM seguro WHERE `dataFinal` <= :dataFim";
        } elseif (($dtIni != "" || $dtIni != NULL) && ($dtFim == "" || $dtFim == NULL)) {
            $sql = "SELECT * FROM seguro WHERE `dataFinal` >= :dataIni";
        } else {
            $sql = "SELECT * FROM seguro WHERE `dataFinal` >= :dataIni AND `dataFinal` <= :dataFim";
        }
        $pdo = connectdb();
        try {
            $stmt = $pdo->prepare($sql);
            if ($dtFim != "")
                $stmt->bindValue(":dataFim", $dtFim);
            if ($dtIni != "")
                $stmt->bindValue(":dataIni", $dtIni);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                if ($stmt->rowCount() > 1) {
                    $obj = new Seguro();
                    $return = array();
                    while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                        $obj->setBem($rs->bem);
                        $obj->setClasse($rs->classe);
                        $obj->setCliente($rs->cliente);
                        $obj->setDataFinal($rs->dataFinal);
                        $obj->setDataInicio($rs->dataInicio);
                        $obj->setId($rs->cod);
                        $obj->setSinistro($rs->sinistro);
                        $obj->setIs_closed($rs->is_closed);
                        $return[] = clone $obj;
                    }
                    return $return;
                } else {
                    $obj = new Seguro();
                    while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                        $obj->setBem($rs->bem);
                        $obj->setClasse($rs->classe);
                        $obj->setCliente($rs->cliente);
                        $obj->setDataFinal($rs->dataFinal);
                        $obj->setDataInicio($rs->dataInicio);
                        $obj->setId($rs->cod);
                        $obj->setSinistro($rs->sinistro);
                        $obj->setIs_closed($rs->is_closed);
                        $return = clone $obj;
                    }
                    return $return;
                }
            } else {
                return FALSE;
            }
        } catch (PDOException $e) {
            echo 'Ocorreu um erro ao buscar os seguros no período especificado.<br><b>Mensagem: </b>' . $e->getMessage();
            die();
        }
    }

    public function renovaSeguro(Seguro $obj) {
        $pdo = connectdb();
        $pdo->beginTransaction();
        try {
            $stmt = $pdo->prepare("INSERT INTO seguro (dataInicio, dataFinal, classe, bem, cliente, sinistro, is_closed) VALUES (:dataIni, :dataFim, :classe, :bem, :cliente, :sin, :is_closed)");
            $stmt->bindValue(":dataIni", $obj->getDataInicio());
            $stmt->bindValue(":dataFim", $obj->getDataFinal());
            $stmt->bindValue(":classe", $obj->getClasse());
            $stmt->bindValue(":bem", $obj->getBem());
            $stmt->bindValue(":cliente", $obj->getCliente());
            $stmt->bindValue(":sin", $obj->getSinistro());
            $stmt->bindValue(":is_closed", $obj->getIs_closed());
            $stmt->execute();
            if ($stmt->rowCount() >= 1) {
                $pdo->commit();
                return TRUE;
            }
        } catch (PDOException $e) {
            echo 'Erro ao salvar o seguro!<br /><b>Mensagem:</b> ' . $e->getMessage();
            $pdo->rollBack();
            die();
        }
    }

    public function closedSeguro(Seguro $obj) {
        $pdo = connectdb();
        $pdo->beginTransaction();
        try {
            $stmt = $pdo->prepare("UPDATE seguro SET is_closed = :is_closed WHERE cod = :id");
            $stmt->bindValue(":id", $obj->getId());
            $stmt->bindValue(":is_closed", $obj->getIs_closed());
            $stmt->execute();
            if ($stmt->rowCount() >= 1) {
                $pdo->commit();
                return TRUE;
            } else {
                return FALSE;
            }
        } catch (PDOException $e) {
            echo 'Erro ao atualizar o seguro!<br /><b>Mensagem:</b> ' . $e->getMessage();
            $pdo->rollBack();
            die();
        }
    }
    
}
