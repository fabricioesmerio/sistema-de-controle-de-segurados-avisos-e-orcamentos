<?php

require_once 'header.php';
require_once 'sidebar.php';
require_once 'navigation.php';
require_once '../DAO/clienteDAO.php';
require_once '../DAO/BemDAO.php';
require_once '../class/Cliente.php';
require_once '../class/Bem.php';
?>
<div class="right_col" role="main">
    <div class="">

        <div class="page-title">
            <div class="title_left">
                <h3>Cadastrar Seguro</h3>
            </div>
        </div>
        <div class="x_content">
            <a href="javascript:history.back()" class="btn btn-default">Voltar</a>
            <a href="index.php" class="btn btn-primary">Tela Inicial</a>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2></h2>

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <?php
                        if (isset($_GET['c']) && (isset($_GET['b']))) {
                            $idCliente = filter_input(INPUT_GET, 'c');
                            $idBem = filter_input(INPUT_GET, 'b');

                            $client = new Cliente();
                            $clientDAO = new clienteDAO();
                            $client = $clientDAO->getById($idCliente);
                            if ($client != NULL) {
                                $bem = new Bem();
                                $bemDAO = new BemDAO();
                                $bem = $bemDAO->getById($idBem);
                                if ($bem != NULL) {
                                    ?>
                                    <div id="resposta">

                                    </div>
                        <form id="formCadSeguro" class="form-horizontal form-label-left" method="POST" action="">
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name" >Cliente</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" id="name" name="name" disabled="disabled" class="form-control col-md-12 col-xs-12" value="<?= $client->getNome() ?>">
                                                <input type="hidden" id="cod" name="cod" value="<?= $client->getId() ?>">
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="bem">Objeto do Seguro</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" class="form-control col-md-12 col-xs-12" disabled="disabled" name="bem" id="bem" value="<?php
                                                if ($bem->getModelo() != NULL):
                                                    echo 'Modelo: ' . $bem->getModelo() . ' - ';
                                                else:
                                                    echo 'CEP: ' . $bem->getCepPernoite() . ' - ';
                                                endif;
                                                if ($bem->getPlaca() != NULL):
                                                    echo 'Placa: ' . $bem->getPlaca();
                                                else:
                                                    echo 'Cidade: ' . $bem->getCidadePernoite();
                                                endif;
                                                ?>">
                                                <input type="hidden" name="id_bem" id="id_bem" value="<?= $bem->getId() ?>" >
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="data_inicio" >Data de Início</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" id="data_inicio" name="data_inicio" class="form-control col-md-12 col-xs-12"
                                                       data-inputmask="'mask': '99/99/9999'">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="data_fim" >Data Final</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" id="data_fim" name="data_fim" class="form-control col-md-12 col-xs-12"
                                                       data-inputmask="'mask': '99/99/9999'">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="classe" >Bônus</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="number" id="classe" name="classe" class="form-control col-md-12 col-xs-12" min="0"  
                                                       placeholder="ex.: 5">
                                            </div>
                                        </div>
                                        <div class="ln_solid"></div>
                                        <div class="form-group">
                                            <div class="col-md-6 col-md-offset-3">
                                                <input id="cadSeguro" name="cadSeguro" type="submit" class="btn btn-primary" value="Salvar"/>
                                            </div>
                                        </div>
                                    </form>
                                    <?php
                                } else {
                                    ?>
                                    <div class="alert alert-danger" role="alert">
                                        Possível erro de parâmetro, tente novamente! Código: 002
                                    </div>
                                    <?php
                                    die();
                                }
                            } else {
                                ?>
                                <div class="alert alert-danger" role="alert">
                                    Possível erro de parâmetro, tente novamente! Código: 001
                                </div>
                                <?php
                                die();
                            }
                        } else {
                            ?>
                            <div class="alert alert-danger" role="alert">
                                Você deve selecionar um cliente e um bem antes de cadastrar um seguro!
                            </div>
                        <?php }
                        ?>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
<!-- /page content -->
<?php
require_once './footer.php';
