<?php

session_start();

require_once '../DAO/clienteDAO.php';
require_once '../class/Cliente.php';
require_once '../class/Endereco.php';
require_once '../DAO/EnderecoDAO.php';

/**
 * Verifica se foi informado o nome, caso contrário retorna um erro informando
 * da obrigatoriedade do campo.
 */
if ($_POST['name'] == NULL || $_POST['name'] == "") {
    $_SESSION['error'] = "Os campos marcados com (*) são obrigatórios.";
    header("Location: ../production/cadCliente.php");
    die();
}

if (!isset($_POST['id_cliente'])) { //verifica se não existe o campo id, sendo nesse caso um novo cadastro
    if ($_POST['tipo_cliente'] == 1) {

        $cli = new Cliente();
        $cliDAO = new clienteDAO();

        if (filter_input(INPUT_POST, 'dtNasc') != "" || filter_input(INPUT_POST, 'dtNasc') != NULL) {
            $dataMani = (filter_input(INPUT_POST, 'dtNasc'));
            $data = explode('/', $dataMani);
            $dataNova = $data[1] . '/' . $data[0] . '/' . $data[2];
            $cli->setDataNasc(date('Y-m-d', strtotime($dataNova)));
        } else {
            $cli->setDataNasc(NULL);
        }

        $cli->setNome(utf8_decode(addslashes(filter_input(INPUT_POST, 'name'))));
        $cli->setCpf(addslashes(filter_input(INPUT_POST, 'cpf')));
        $cli->setCnh(addslashes(filter_input(INPUT_POST, 'cnh')));
        $cli->setCelular(filter_input(INPUT_POST, 'cel'));
        $cli->setEstadoCivil(addslashes(filter_input(INPUT_POST, 'estCivil')));
        $cli->setSexo(addslashes(filter_input(INPUT_POST, 'sexo')));
        $cli->setObs(addslashes(filter_input(INPUT_POST, 'obs')));
        $cli->setTipoCliente(filter_input(INPUT_POST, 'tipo_cliente'));
        $cliDAO->insert($cli);
        $cliId = $cliDAO->getIdByParams((addslashes(filter_input(INPUT_POST, 'name'))), (addslashes(filter_input(INPUT_POST, 'cpf'))), '', (filter_input(INPUT_POST, 'cel')), '');
        

        $end = new Endereco();
        $endDAO = new EnderecoDAO();
        $end->setRua(utf8_decode(addslashes(filter_input(INPUT_POST, 'rua'))));
        $end->setNumero(addslashes(filter_input(INPUT_POST, 'num')));
        $end->setCep(addslashes(filter_input(INPUT_POST, 'cep')));
        $end->setBairro(utf8_decode(addslashes(filter_input(INPUT_POST, 'bairro'))));
        $end->setCidade(utf8_decode(addslashes(filter_input(INPUT_POST, 'cidade'))));
        $end->setComplemento(utf8_decode(addslashes(filter_input(INPUT_POST, 'complemento'))));
        $end->setEstado(utf8_decode(addslashes(filter_input(INPUT_POST, 'estado'))));

        if ($endDAO->insert($end, $cliId)) {
            $_SESSION['sucess'] = "Cliente salvo com sucesso.";
            header("Location: ../production/listasClientes.php");
            die();
        } else {
            $_SESSION['error'] = "Ocorreu um erro ao salvar o cliente.";
            header("Location: ../production/cadCliente.php");
            die();
        }
    }

    if ($_POST['tipo_cliente'] == 2) {
        $cli = new Cliente();
        $cliDAO = new clienteDAO();

        $cli->setNome((addslashes(filter_input(INPUT_POST, 'name'))));
        $cli->setRazao((addslashes(filter_input(INPUT_POST, 'razao'))));
        $cli->setCnpj(addslashes(filter_input(INPUT_POST, 'cnpj')));
        $cli->setTelefone(addslashes(filter_input(INPUT_POST, 'tel')));
        $cli->setFinalidadeEco((addslashes(filter_input(INPUT_POST, 'final'))));
        $cli->setTipoCliente(filter_input(INPUT_POST, 'tipo_cliente'));
        $cliDAO->insert($cli);
        $cliId = $cliDAO->getIdByParams((addslashes(filter_input(INPUT_POST, 'name'))), '', (addslashes(filter_input(INPUT_POST, 'cnpj'))), '', (addslashes(filter_input(INPUT_POST, 'tel'))));

        $end = new Endereco();

        $end->setRua(addslashes(filter_input(INPUT_POST, 'rua')));
        $end->setNumero(addslashes(filter_input(INPUT_POST, 'num')));
        $end->setCep(addslashes(filter_input(INPUT_POST, 'cep')));
        $end->setBairro(addslashes(filter_input(INPUT_POST, 'bairro')));
        $end->setCidade(addslashes(filter_input(INPUT_POST, 'cidade')));
        $end->setComplemento(addslashes(filter_input(INPUT_POST, 'compl')));
        $end->setEstado(addslashes(filter_input(INPUT_POST, 'estado')));

        $endDAO = new EnderecoDAO();

        if ($endDAO->insert($end, $cliId)) {
            $_SESSION['sucess'] = "Cliente salvo com sucesso.";
            header("Location: ../production/listasClientes.php");
            die();
        } else {
            $_SESSION['error'] = "Ocorreu um erro ao salvar o cliente.";
            header("Location: ../production/cadCliente.php");
            die();
        }
    }
} elseif (isset($_POST['id_cliente']) && ($_POST['id_cliente'] != "" || $_POST['id_cliente'] != NULL)) {
    $cli = new Cliente();
    $cliDAO = new clienteDAO();

    $cli->setId(addslashes(filter_input(INPUT_POST, 'id_cliente')));

    if (filter_input(INPUT_POST, 'dtNasc') != "" || filter_input(INPUT_POST, 'dtNasc') != NULL) {
        $dataMani = (filter_input(INPUT_POST, 'dtNasc'));
        $data = explode('/', $dataMani);
        $dataNova = $data[1] . '/' . $data[0] . '/' . $data[2];
        $cli->setDataNasc(date('Y-m-d', strtotime($dataNova)));
    } else {
        $cli->setDataNasc(NULL);
    }

    $cli->setNome(utf8_decode(addslashes(filter_input(INPUT_POST, 'name'))));
    if (isset($_POST['cnpj'])) {
        $cli->setCnpj(addslashes(filter_input(INPUT_POST, 'cnpj')));
    }
    if (isset($_POST['final'])) {
        $cli->setFinalidadeEco(addslashes(filter_input(INPUT_POST, 'final')));
    }
    if (isset($_POST['razao'])) {
        $cli->setRazao(addslashes(filter_input(INPUT_POST, 'razao')));
    }
    if (isset($_POST['tel'])) {
        $cli->setTelefone(addslashes(filter_input(INPUT_POST, 'tel')));
    }
    if (isset($_POST['cpf'])) {
        $cli->setCpf(addslashes(filter_input(INPUT_POST, 'cpf')));
    }
    if (isset($_POST['cnh'])) {
        $cli->setCnh(addslashes(filter_input(INPUT_POST, 'cnh')));
    }
    if (isset($_POST['cel'])) {
        $cli->setCelular(filter_input(INPUT_POST, 'cel'));
    }
    if (isset($_POST['estCivil'])) {
        $cli->setEstadoCivil(addslashes(filter_input(INPUT_POST, 'estCivil')));
    }
    if (isset($_POST['sexo'])) {
        $cli->setSexo(addslashes(filter_input(INPUT_POST, 'sexo')));
    }
    if (isset($_POST['obs'])) {
        $cli->setObs(addslashes(filter_input(INPUT_POST, 'obs')));
    }
    $cli->setTipoCliente(addslashes(filter_input(INPUT_POST, 'tipo_cliente')));
    $last = date("Y-m-d H:i");
    $cli->setLastModified($last);

    if ($cliDAO->update($cli) > 0) {

        if (isset($_POST['id_endereco'])) {


            $end = new Endereco();
            $end->setId(addslashes(filter_input(INPUT_POST, 'id_endereco')));
            $end->setRua(addslashes(filter_input(INPUT_POST, 'rua')));
            $end->setNumero(addslashes(filter_input(INPUT_POST, 'num')));
            $end->setCep(addslashes(filter_input(INPUT_POST, 'cep')));
            $end->setBairro(addslashes(filter_input(INPUT_POST, 'bairro')));
            $end->setCidade(addslashes(filter_input(INPUT_POST, 'cidade')));
            $end->setComplemento(addslashes(filter_input(INPUT_POST, 'complemento')));
            $end->setEstado(addslashes(filter_input(INPUT_POST, 'estado')));
            $end->setCliente($cli->getId());

            $endDAO = new EnderecoDAO();
            if ($endDAO->update($end)) {
                $_SESSION['sucess'] = "Dados atualizados com sucesso.";
                header("Location: ../production/listasClientes.php");
                die();
            } else {
                $_SESSION['error'] = "Ocorreu um erro ao atualizar o endereço!";
                header("Location: ../production/listasClientes.php");
                die();
            }
        }
    } else {
        $_SESSION['error'] = "Ocorreu um erro ao salvar o cliente!";
        header("Location: ../production/listasClientes.php");
        die();
    }
} else {
    $_SESSION['error'] = "Ocorreu um erro de parâmetro. Não foi possível salvar o cliente!";
    header("Location: ../production/cadCliente.php");
    die();
}