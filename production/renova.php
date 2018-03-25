<?php
require_once 'header.php';
require_once 'sidebar.php';
require_once 'navigation.php';
require_once '../DAO/clienteDAO.php';
require_once '../DAO/BemDAO.php';
require_once '../class/Cliente.php';
require_once '../class/Bem.php';
require_once '../DAO/SeguroDAO.php';
require_once '../class/Seguro.php';
require_once '../DAO/Tipo_BemDAO.php';
require_once '../class/Tipo_Bem.php';

$idSeguro = isset($_GET['s']) ? filter_input(INPUT_GET, 's') : '';

if ($idSeguro != '') {
    $seg = new Seguro();
    $segDAO = new SeguroDAO();
    $seg = $segDAO->getById($idSeguro);

    $cli = new Cliente();
    $cliDAO = new clienteDAO();
    $cli = $cliDAO->getById($seg->getCliente());

    $bem = new Bem();
    $bemDAO = new BemDAO();
    $bem = $bemDAO->getById($seg->getBem());

    $tipo = new Tipo_Bem();
    $tipoDAO = new Tipo_BemDAO();
    $tipo = $tipoDAO->getById($bem->getTipoBem());
} else {
    $_SESSION['error'] = 'Erro de parâmetro. Referencie o seguro que deseja renovar!';
}
?>
<div class="right_col" role="main">
    <div class="">

        <div class="page-title">
            <div class="title_left">
                <h3>Renovar Seguro</h3>
            </div>
        </div>
        <div class="x_content">
            <a href="javascript:history.back()" class="btn btn-dark">Voltar</a>
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
                        
                        if (isset($_SESSION['error'])) {
                            ?>
                            <p class = "alert alert-error text text-center"><?= $_SESSION['error'] ?></p>
                            <?php
                            unset($_SESSION['error']);
                        }
                        ?>
                        
                        <div id="resposta">

                        </div>

                        <?php
                        if (isset($seg)) {
                            ?>
                            <form id="FormRenovaSeguro" class="form-horizontal form-label-left" method="POST" action="">
                                <div class="form-group">
                                    <input type="hidden" id="id_antigo" name="id_antigo" value="<?=$idSeguro?>" >
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name" >Cliente</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="name" name="name" disabled="disabled" class="form-control col-md-12 col-xs-12" value="<?= $cli->getNome() ?>">
                                        <input type="hidden" id="cod" name="cod" value="<?= $cli->getId() ?>">
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
                                               data-inputmask="'mask': '99/99/9999'" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="data_fim" >Data Final</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="data_fim" name="data_fim" class="form-control col-md-12 col-xs-12"
                                               data-inputmask="'mask': '99/99/9999'" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="classe" >Bônus</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="number" id="classe" name="classe" class="form-control col-md-12 col-xs-12" min="0" >
                                    </div>
                                </div>

                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <input id="cadSeguro" name="cadSeguro" type="submit" class="btn btn-primary" value="Renovar"/>
                                    </div>
                                </div>
                            </form>
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

