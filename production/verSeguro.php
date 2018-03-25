<?php

require_once '../Config/functions.php';
require_once 'header.php';
require_once 'sidebar.php';
require_once 'navigation.php';
require_once '../DAO/clienteDAO.php';
require_once '../DAO/BemDAO.php';
require_once '../class/Cliente.php';
require_once '../class/Bem.php';
require_once '../DAO/SeguroDAO.php';
require_once '../class/Seguro.php';
require_once '../DAO/EnderecoDAO.php';
require_once '../class/Endereco.php';
require_once '../DAO/EmpresaDAO.php';
require_once '../class/Empresa.php';


if (isset($_GET['s'])) {
    $idSeguro = filter_input(INPUT_GET, 's');

    $seg = new Seguro();
    $segDAO = new SeguroDAO();
    $seg = $segDAO->getById($idSeguro);

    $cli = new Cliente();
    $cliDAO = new clienteDAO();
    $cli = $cliDAO->getById($seg->getCliente());

    $end = new Endereco();
    $endDAO = new EnderecoDAO();
    $end = $endDAO->getByCliente($cli->getId());

    $bem = new Bem();
    $bemDAO = new BemDAO();
    $bem = $bemDAO->getById($seg->getBem());
}

$empr = new Empresa();
$emprDAO = new EmpresaDAO();
$empr = $emprDAO->getEmpresa();
?>
<div class="right_col" role="main">
    <div class="">

        <div class="page-title">
            <div class="title_left">
                <h3>Visualizar Seguro</h3>
            </div>
        </div>
        <div id="noprint">
            <div class="x_content">
                
                <a href="index.php" class="btn btn-primary">Tela Inicial</a>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2></h2>

                        <div class="clearfix"></div>
                    </div>
                    <div id="noprint">
                        <!-- this row will not appear when printing -->
                        <div class="row no-print">
                            <div class="col-xs-12">
                                <button class="btn btn-default" onclick="window.print();"><i class="fa fa-print"></i> Print</button>

                            </div>
                        </div>
                    </div>
                    <div class="x_content">
                        <div id="print">
                            <!-- ************************************-->
                            <section class="content invoice">
                                <h1 class="text-center">Guerini Seguros</h1>
                                
                                <!-- title row -->
                                <div class="row">
                                    <div class="col-xs-12 invoice-header">
                                        <h3>
                                            <i class="fa fa-user"></i> Segurado
                                            <small class="pull-right">Período: <?= $seg->getDataInicio() ?> a <?= $seg->getDataFinal() ?></small>
                                        </h3>
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- info row -->
                                <div class="row invoice-info">
                                    <div class="col-sm-4 invoice-col">

                                        <address>
                                            <strong>Segurado</strong>
                                            <br><?= $cli->getNome() ?> <br />
                                            <strong>CPF/CNPJ</strong>
                                            <br><?php
                                            if ($cli->getCpf() == "")
                                                echo $cli->getCnpj();
                                            else
                                                echo $cli->getCpf();
                                            ?> <br />
                                            <strong>Celular/Telefone</strong>
                                            <br><?php
                                            if ($cli->getCelular() == "")
                                                echo $cli->getTelefone();
                                            else
                                                echo $cli->getCelular();
                                            ?> <br />
                                            <strong>CEP Residência</strong>
                                            <br><?php
                                            if ($end->getCep() == NULL)
                                                echo '';
                                            else
                                                echo $end->getCep();
                                            ?> <br />
                                            <strong>Município Residência</strong>
                                            <br><?php
                                            if ($end->getCidade() == NULL)
                                                echo '';
                                            else
                                                echo $end->getCidade();
                                            ?> <br />
                                            <strong>Bônus</strong>
                                            <br><?= $seg->getClasse() ?> <br />
                                        </address>
                                    </div>

                                </div>
                                <?php
                                require_once '../DAO/Tipo_BemDAO.php';
                                require_once '../class/Tipo_Bem.php';
                                $tipo = new Tipo_Bem();
                                $tipoDAO = new Tipo_BemDAO();
                                $tipo = $tipoDAO->getById($bem->getTipoBem());
                                if ($tipo->getTipo() == "Automóvel" || $tipo->getTipo() == "Motocicleta") {
                                    ?>
                                    <div class="col-xs-12 invoice-header">
                                        <h3>
                                            <i class="fa fa-car"></i> <?= $tipo->getTipo() ?>
                                        </h3>
                                    </div>
                                    <div class="row invoice-info">
                                        <div class="col-sm-4 invoice-col">

                                            <address>
                                                <strong>Veículo(Marca e Modelo)</strong>
                                                <br><?php
                                                if ($bem->getMarca() != NULL && $bem->getModelo() !== NULL) {
                                                    echo $bem->getMarca() . ' ' . $bem->getModelo();
                                                } else {
                                                    echo '';
                                                }
                                                ?> <br />
                                                <strong>Ano/Modelo</strong>
                                                <br><?php
                                                if ($bem->getAnoModelo() != NULL) {
                                                    echo $bem->getAnoModelo();
                                                } else {
                                                    echo '';
                                                }
                                                ?><br />
                                                <strong>Zero KM</strong>
                                                <br><?php
                                                if ($bem->getZeroKm() != NULL) {
                                                    echo 'sim';
                                                } else {
                                                    echo 'não';
                                                }
                                                ?><br />
                                                <strong>Combustível</strong>
                                                <br><?php
                                                if ($bem->getCombustivel() != NULL) {
                                                    echo $bem->getCombustivel();
                                                } else {
                                                    echo '';
                                                }
                                                ?> <br />
                                                <strong>Cód FIPE</strong>
                                                <br><?php
                                                if ($bem->getCodFipe() != NULL) {
                                                    echo $bem->getCodFipe();
                                                } else {
                                                    echo '';
                                                }
                                                ?> <br />
                                                <strong>Placa</strong>
                                                <br><?php
                                                if ($bem->getPlaca() != NULL) {
                                                    echo $bem->getPlaca();
                                                } else {
                                                    echo '';
                                                }
                                                ?> <br />
                                                <strong>Chassi</strong>
                                                <br><?php
                                                if ($bem->getChassi() != NULL) {
                                                    echo $bem->getChassi();
                                                } else {
                                                    echo '';
                                                }
                                                ?> <br />
                                            </address>
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-sm-4 invoice-col">

                                            <address>
                                                <strong>Categoria</strong>
                                                <br><?php
                                                if ($bem->getCategoria() != NULL) {
                                                    echo $bem->getCategoria();
                                                } else {
                                                    echo '';
                                                }
                                                ?> <br />
                                                <strong>Uso</strong>
                                                <br><?php
                                                if ($bem->getUso() != NULL) {
                                                    echo $bem->getUso();
                                                } else {
                                                    echo '';
                                                }
                                                ?> <br />
                                                <strong>Transporte</strong>
                                                <br><?php
                                                if ($bem->getTransportes() != NULL) {
                                                    echo $bem->getTransportes();
                                                } else {
                                                    echo '';
                                                }
                                                ?> <br />
                                                <strong>Blindado</strong>
                                                <br><?php
                                                if ($bem->getBlindado() != NULL) {
                                                    echo 'sim';
                                                } else {
                                                    echo 'não';
                                                }
                                                ?> <br />
                                            </address>
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-sm-4 invoice-col">
                                            <strong>CEP Pernoite</strong>
                                            <br><?php
                                            if ($bem->getCepPernoite() != NULL) {
                                                echo $bem->getCepPernoite();
                                            } else {
                                                echo '';
                                            }
                                            ?> <br />
                                            <strong>Município Pernoite</strong>
                                            <br><?php
                                            if ($bem->getCidadePernoite() != NULL) {
                                                echo $bem->getCidadePernoite();
                                            } else {
                                                echo '';
                                            }
                                            ?> <br />
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    <!-- /.row -->
                                    <?php } else {
                                    ?>
                                    <div class="col-xs-12 invoice-header">
                                        <h3>
                                            <i class="fa fa-institution"></i> Local de Risco
                                        </h3>
                                    </div>
                                    <div class="row invoice-info">
                                        <div class="col-sm-4 invoice-col">

                                            <address>
                                                <strong>CEP</strong>
                                                <br><?php
                                                if ($end->getCep() != NULL) {
                                                    echo $bem->getCepPernoite();
                                                } else {
                                                    echo '';
                                                }
                                                ?> <br />
                                                <strong>Endereço</strong>
                                                <br><?php
                                                if ($end->getRua() != NULL) {
                                                    echo $end->getRua() . ', nº ' . $end->getNumero();
                                                } else {
                                                    echo '';
                                                }
                                                ?> <br />
                                                <strong>Complemento</strong>
                                                <br><?php
                                                if ($end->getComplemento() != NULL) {
                                                    echo $end->getComplemento();
                                                } else {
                                                    echo '';
                                                }
                                                ?> <br />
                                                <strong>Bairro</strong>
                                                <br><?php
                                                if ($end->getBairro() != NULL) {
                                                    echo $end->getBairro();
                                                } else {
                                                    echo '';
                                                }
                                                ?> <br />
                                                <strong>Cidade</strong>
                                                <br><?php
                                                if ($end->getCidade() != NULL) {
                                                    echo $end->getCidade();
                                                } else {
                                                    echo '';
                                                }
                                                ?><br />
                                                <strong>Estado</strong>
                                                <br><?php
                                                if ($end->getEstado() != NULL) {
                                                    echo $end->getEstado();
                                                } else {
                                                    echo '';
                                                }
                                                ?><br />
                                                <strong>Atividade Econômica</strong>
                                                <br><?php
                                                if ($bem->getAtividadeEco() != NULL) {
                                                    echo $bem->getAtividadeEco();
                                                } else {
                                                    echo '';
                                                }
                                                ?> <br />
                                            </address>
                                        </div> 
                                    <?php }
                                    ?>
                                    <div class="row">
                                        <div class="col-xs-12 invoice-header">
                                            <h3>
                                                <i class="fa fa-users"></i> Corretor / Seguradora
                                            </h3>
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    <!-- info row -->
                                    <div class="row invoice-info">
                                        <div class="col-sm-4 invoice-col">

                                            <address>
                                                <strong>Nome</strong>
                                                <br><?=$empr->getNome()?> <br />
                                                <strong>Endereço</strong>
                                                <br><?=$empr->getRua() ?> <br />
                                                <strong>Cidade</strong>
                                                <br><?=$empr->getCidade() ?> <br />
                                                <strong>Telefone</strong>
                                                <br><?=$empr->getTelefone() ?> <br />

                                            </address>
                                        </div>

                                    </div>

                                </div>
                                <!-- /.row -->


                            </section>


                            <!-- ************************************-->
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
<!-- /page content -->
<?php
require_once './footer.php';
