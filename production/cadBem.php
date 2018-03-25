<?php

require_once 'header.php';
require_once 'sidebar.php';
require_once 'navigation.php';
require_once '../class/Cliente.php';
require_once '../class/Tipo_Bem.php';
require_once '../DAO/Tipo_BemDAO.php';
require_once '../DAO/clienteDAO.php';

//$codVerificador = geraCodVerificador();
?>
<div class="right_col" role="main">
    <div class="">

        <div class="page-title">
            <div class="title_left">
                <h3>Cadastrar Bem</h3>
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
                        if (isset($_GET['cod'])) {
                            require_once '../DAO/EnderecoDAO.php';
                            require_once '../class/Endereco.php';

                            $idCliente = filter_input(INPUT_GET, 'cod');
                            $cli = new Cliente();
                            $cliDAO = new clienteDAO();
                            $cli = $cliDAO->getById($idCliente);

                            $end = new Endereco();
                            $endDAO = new EnderecoDAO();
                            $end = $endDAO->getByCliente($cli->getId());

                            if ($end == NULL) {
                                $cep = "";
                                $cidade = "";
                                $estado = "";
                            } else {
                                $cep = $end->getCep();
                                $cidade = $end->getCidade();
                                $estado = $end->getEstado();
                            }

                            $tipoBem = new Tipo_Bem;
                            $tipoBemDAO = new Tipo_BemDAO;
                            $tipoBem = $tipoBemDAO->getAll();
                            ?>
                            <div id="status" style="display: none;"></div>
                            <div id="resposta">

                            </div>
                            <form id="formCadBem" class="form-horizontal form-label-left" method="POST" action="">
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name" >Cliente</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="name" name="name" disabled="disabled" class="form-control col-md-12 col-xs-12" value="<?= $cli->getNome() ?>">
                                        <input type="hidden" id="cod" name="cod" value="<?= $cli->getId() ?>">
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Tipo Bem</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select class="form-control" tabindex="-1" name="tipo_bem" id="tipo_bem">
                                            <option value=""> --- Selecione ---</option>
                                            <?php
                                            foreach ($tipoBem as $tipo):
                                                ?>
                                                <option data-section="<?= (utf8_encode($tipo->getTipo()) == 'Automóvel' || $tipo->getTipo() == 'Motocicleta') ? 'automotor' : 'predial' ?>" value="<?= $tipo->getId() ?>"><?= utf8_encode($tipo->getTipo()) ?></option>
                                                <?php
                                            endforeach;
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div data-name="automotor" class="hide form-group">
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="hidden" id="codverif" name="codverif" class="form-control col-md-12 col-xs-12" value="<?= $codVerificador ?>">
                                    </div>
                                </div>
                                <div data-name="automotor" class="hide form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="marca" >Marca</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="marca" name="marca" class="form-control col-md-12 col-xs-12">
                                    </div>
                                </div>
                                <div data-name="automotor" class="hide form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="modelo" >Modelo</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="modelo" name="modelo" class="form-control col-md-12 col-xs-12">
                                    </div>
                                </div>
                                <div data-name="automotor" class="hide form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ano_modelo" >Ano/Modelo</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="ano_modelo" name="ano_modelo" class="form-control col-md-12 col-xs-12"
                                               placeholder="ex. 04/05">
                                    </div>
                                </div>
                                <div data-name="automotor" class="hide form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ano_modelo" >Código FIPE</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="fipe" name="fipe" class="form-control col-md-12 col-xs-12" >
                                    </div>
                                </div>
                                <div data-name="automotor" class="hide form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="combustivel" >Combustível</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="combustivel" name="combustivel" class="form-control col-md-12 col-xs-12">
                                    </div>
                                </div>
                                <div data-name="automotor" class="hide form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="placa" >Placa</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="placa" name="placa" class="form-control col-md-12 col-xs-12">
                                    </div>
                                </div>
                                <div data-name="predial" class="hide form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="atividade" >Atividade Econômica</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="atividade" name="atividade" class="form-control col-md-12 col-xs-12">
                                    </div>
                                </div>
                                <div data-name="automotor" class="hide form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="chassi" >Chassi</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="chassi" name="chassi" class="form-control col-md-12 col-xs-12">
                                    </div>
                                </div>
                                <div data-name="automotor" class="hide form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="categoria" >Categoria</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="categoria" name="categoria" class="form-control col-md-12 col-xs-12">
                                    </div>
                                </div>
                                <div data-name="automotor" class="hide form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="uso" >Uso</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="uso" name="uso" class="form-control col-md-12 col-xs-12">
                                    </div>
                                </div>
                                <div data-name="automotor" class="hide form-group">
                                    <label class="checkbox control-label col-md-3 col-sm-3 col-xs-12" for="zero" >
                                        <input type="checkbox" id="zero" name="zero" class="js-switch"> Zero KM
                                    </label>
                                    <label class="checkbox control-label col-md-3 col-sm-3 col-xs-12" for="blindado" >                                    
                                        <input type="checkbox" id="blindado" name="blindado" class="js-switch">Blindado
                                    </label>
                                </div>

                                <div data-name="automotor" class="hide form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="transporte" >Transporte</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="transporte" name="transporte" class="form-control col-md-12 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cep" >CEP (Pernoite)</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="cep" name="cep" class="form-control col-md-7 col-xs-12"
                                               data-inputmask="'mask': '99.999-999'" value="<?= $cep ?>">
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cidade" >Cidade</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="cidade" name="cidade" class="form-control col-md-12 col-xs-12"
                                               value="<?= $cidade ?>">
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="estado" >Estado</label>
                                    <div class="col-md-6 col-sm-3 col-xs-12">
                                        <input type="text" id="estado" name="estado" class="form-control col-md-12 col-xs-12"
                                               value="<?= $estado ?>">
                                    </div>
                                </div>
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <input id="cadSeguro" name="cadSeguro" type="submit" class="btn btn-primary" value="Salvar"/>
                                    </div>
                                </div>
                            </form>
                        <?php } else {
                            ?>
                            <div class="alert alert-danger" role="alert">
                                Você deve selecionar um cliente antes de cadastrar!
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
