<?php
require_once 'header.php';
require_once 'sidebar.php';
require_once 'navigation.php';
require_once '../DAO/clienteDAO.php';
require_once '../class/Cliente.php';
require_once '../Config/functions.php';

if ((isset($_GET['action']) && $_GET['action'] == 'update') && (isset($_GET['or']) && $_GET['or'] != '')) {
    require_once '../DAO/OrcamentoDAO.php';
    require_once '../class/Orcamento.php';

    $id = addslashes(filter_input(INPUT_GET, 'or'));

    $orcamento = new Orcamento;
    $orcamentoDAO = new OrcamentoDAO();
    $orcamento = $orcamentoDAO->getById($id);

    if ($orcamento == NULL) {
        echo '<script type="text/javascript">
                alert("Erro de parâmetro, tente novamente!");
                location.href=history.back();
              </script>';
    } else {
        $cli = new Cliente();
        $clienteDAO = new clienteDAO();
        $cli = $clienteDAO->getById($orcamento->getCliente());
        if ($cli == NULL || $cli == '') {
        echo '<SCRIPT Language="javascript">
                alert(\'Ops! Ocorreu um erro grave. Tente novamente!\');
                location.href=\'listasClientes.php?view=orc\';
             </SCRIPT>';
    } else {
        $_SESSION['id_cliente'] = $cli->getId();
    }
    }
} elseif (isset($_GET['c'])) {
    $id_cliente = filter_input(INPUT_GET, 'c');
    $cli = new Cliente();
    $cliDAO = new clienteDAO();
    $cli = $cliDAO->getById($id_cliente);
    if ($cli == NULL || $cli == '') {
        echo '<SCRIPT Language="javascript">
                alert(\'Possível erro de parâmetro. Tente novamente!\');
                location.href=\'listasClientes.php?view=orc\';
             </SCRIPT>';
    } else {
        $_SESSION['id_cliente'] = $cli->getId();
    }
} else {
    echo '<SCRIPT Language="javascript">
            alert(\'Cliente não selecionado. Tente novamente!\');
            location.href=\'listasClientes.php?view=orc\';
          </SCRIPT>';
}
?>
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3><?= (isset($_GET['action']) && $_GET['action'] == 'update') ? 'Atualizar' : 'Cadastro' ?></h3>
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
                        <h2>Orçamento</h2>
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
                        <?php if ((isset($_GET['action']) && $_GET['action'] == 'update') && (isset($orcamento) && $orcamento != NULL)) { ?>
                            <form class="form-horizontal form-label-left"  action="../sources/salvaOrcamento.php?action=update" method="post" id="formOrcamento">
                                <input type="hidden" name="id_orcamento" id="id_orcamento" value="<?= $orcamento->getId() ?>" >
                            <?php } else { ?>
                                <form class="form-horizontal form-label-left"  action="../sources/salvaOrcamento.php?action=insert" method="post" id="formOrcamento">
                                <?php }
                                ?>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cliente">Cliente <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="cliente" name="cliente" class="form-control col-md-7 col-xs-12" value="<?= $cli->getNome() ?>" disabled="">
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="data_abertura">Data Abertura <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="data_abertura" name="data_abertura" class="form-control col-md-7 col-xs-12" 
                                               value="<?= (isset($_GET['action']) && $_GET['action'] == 'update' && isset($orcamento) && $orcamento != NULL) ? dateForForm($orcamento->getData_abertura()) : dateForForm(date("Y-m-d")) ?>" >
                                    </div>
                                </div>
                                <?php if (isset($_GET['action']) && $_GET['action'] == 'update' && isset($orcamento) && $orcamento != NULL) { ?>
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="data_fechamento">Data Fechamento <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" id="data_fechamento" name="data_fechamento" class="form-control col-md-7 col-xs-12" 
                                                   value="<?= (isset($_GET['action']) && $_GET['action'] == 'update' && isset($orcamento) && $orcamento != NULL && $orcamento->getData_fechmto() != NULL) ? dateForForm($orcamento->getData_fechmto()) : '' ?>" 
                                                   data-inputmask="'mask': '99/99/9999'" >
                                        </div>
                                    </div>
                                <?php }
                                ?>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="descricao">Descrição <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea id="descricao" name="descricao" class="form-control col-md-7 col-xs-12" 
                                                  style="height:300px;width:520px;">
                                                      <?= (isset($_GET['action']) && $_GET['action'] == 'update' && isset($orcamento) && $orcamento != NULL && $orcamento->getDescricao() != NULL) ? stripslashes($orcamento->getDescricao()) : '' ?>
                                        </textarea>
                                    </div>
                                </div>
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
                                                <?= (isset($_GET['action']) && $_GET['action'] == 'update' && isset($orcamento) && $orcamento != NULL && $orcamento->getStatus() == $s->getId()) ? 'selected' : ''?> >
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
                                        <button id="salvar_orcamento" name="salvar_orcamento" type="submit" class="btn btn-primary">Salvar</button>
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
