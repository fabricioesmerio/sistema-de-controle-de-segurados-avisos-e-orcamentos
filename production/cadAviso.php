<?php
require_once 'header.php';
require_once 'sidebar.php';
require_once 'navigation.php';
require_once '../Config/functions.php';

if ((isset($_GET['action']) && $_GET['action'] == 'update') && (isset($_GET['av']) && $_GET['av'] != '')) {
    require_once '../DAO/AvisoDAO.php';
    require_once '../class/Aviso.php';

    $id = addslashes(filter_input(INPUT_GET, 'av'));

    $aviso = new Aviso();
    $avisoDAO = new AvisoDAO();
    $aviso = $avisoDAO->getById($id);

    if ($aviso == NULL) {
        echo '<script type="text/javascript">
                alert("Erro de parâmetro, tente novamente!");
                location.href=history.back();
              </script>';
    }
}
?>
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3><?= (isset($_GET['action']) && $_GET['action'] == 'update') ? 'Atualização' : 'Cadastro' ?></h3>
            </div>
        </div>
        <div class="x_content">
            <a href="javascript:history.back()" class="btn btn-default">Voltar</a>
            <a href="cadCliente.php" class="btn btn-primary">Cadastro Cliente</a>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Aviso</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <?php
                        if (isset($_SESSION['success'])) {
                            ?>
                            <p class = "alert alert-success text text-center"><?= $_SESSION['success'] ?></p>
                            <?php
                            unset($_SESSION['success']);
                        }
                        if (isset($_SESSION['error'])) {
                            ?>
                            <p class = "alert alert-error text text-center"><?= $_SESSION['error'] ?></p>
                            <?php
                            unset($_SESSION['error']);
                        }
                        ?>
                        <?php
                        if((isset($_GET['action']) && $_GET['action'] == 'update') && (isset($aviso) && $aviso != NULL)){ ?>
                            <form class="form-horizontal form-label-left"  action="../sources/salvaAviso.php?action=update" method="post" id="formAviso">
                                <input type="hidden" name="id_aviso" id="id_aviso" value="<?=$aviso->getId() ?>" >
                       <?php } else { ?>
                            <form class="form-horizontal form-label-left"  action="../sources/salvaAviso.php?action=insert" method="post" id="formAviso">
                      <?php  }
                        ?>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="descricao">Descrição <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <textarea id="descricao" class="form-control col-md-7 col-xs-12" name="descricao" 
                                              type="text" style="height:300px;width:600px;"><?= ((isset($_GET['action']) && $_GET['action'] == 'update') && (isset($aviso) && $aviso != NULL)) ? stripslashes($aviso->getDescricao()) : '' ?></textarea>
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="data_abertura">Data Abertura<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="data_abertura" name="data_abertura" class="form-control col-md-7 col-xs-12" 
                                           value="<?= ((isset($_GET['action']) && $_GET['action'] == 'update') && (isset($aviso) && $aviso != NULL)) ? dateForForm($aviso->getData_abertura()) : dateForForm(date("Y-m-d")) ?>">
                                </div>
                            </div>
                            <?php if (((isset($_GET['action']) && $_GET['action'] == 'update') && (isset($aviso) && $aviso != NULL))) { ?>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="data_fechamento">Data Fechamento
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="data_fechamento" name="data_fechamento" class="form-control col-md-7 col-xs-12" 
                                               value="<?= ((isset($_GET['action']) && $_GET['action'] == 'update') && (isset($aviso) && $aviso != NULL) && ($aviso->getData_fechamnto() != NULL)) ? dateForForm($aviso->getData_fechamnto()) : '' ?>" 
                                               data-inputmask="'mask': '99/99/9999'">
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="status">Status <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" tabindex="-1" name="status" id="status">
                                        <?php
                                        require_once '../class/Status.php';
                                        require_once '../DAO/StatusDAO.php';
                                        $status = new Status();
                                        $statusDAO = new StatusDAO();
                                        $status = $statusDAO->getAll();
                                        foreach ($status as $s):
                                            ?>
                                            <option value="<?= $s->getId() ?>"
                                                    <?= ((isset($_GET['action']) && $_GET['action'] == 'update') && (isset($aviso) && $aviso != NULL) && ($aviso->getStatus() == $s->getId())) ? 'selected' : ''?>> 
                                            <?= ($s->getId() == 1) ? "Aberto" : "Fechado" ?> 
                                            </option>
                                            <?php
                                        endforeach;
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-3">
                                    <button type="reset" class="btn btn-danger">Limpar</button>
                                    <button id="salvar_aviso" name="salvar_aviso" type="submit" class="btn btn-primary">Salvar</button>
                                </div>
                            </div>
                        </form>
                        <script>
                            var textarea = document.getElementById('descricao');
                            sceditor.create(textarea, {
                                format: 'bbcode',
                                icons: 'monocons',
                                style: '../build/css/default.min.css'
                            });

                        </script>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- /page content -->

<?php
include './footer.php';
