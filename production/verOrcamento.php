<?php
require_once 'header.php';
require_once 'sidebar.php';
require_once 'navigation.php';
require_once '../DAO/OrcamentoDAO.php';
require_once '../class/Orcamento.php';


if (isset($_GET['or'])) {
    if ($_GET['or'] != NULL || $_GET['or'] != '') {
        $orc = new Orcamento();
        $orcDAO = new OrcamentoDAO();
        $orc = $orcDAO->getById(addslashes(filter_input(INPUT_GET, 'or')));
        if ($orc == NULL) {
            echo '<SCRIPT Language="javascript">
            alert(\'Erro de parâmetro. Tente novamente!\');
            location.href="javascript:history.back()";
          </SCRIPT>';
        } else {
            require_once '../DAO/clienteDAO.php';
            require_once '../class/Cliente.php';
            $cli = new Cliente();
            $cliDAO = new clienteDAO();
            $cli = $cliDAO->getById($orc->getCliente());
        }
    } else {
        echo '<SCRIPT Language="javascript">
            alert(\'Você deve selecionar um orçamento para prosseguir. Tente novamente!\');
            location.href="javascript:history.back()";
          </SCRIPT>';
    }
} else {
    echo '<SCRIPT Language="javascript">
            alert(\'Não foi possível acessar ao parâmetro do orçamento. Tente novamente!\');
            location.href="javascript:history.back()";
          </SCRIPT>';
}
?>
<div class="right_col" role="main">
    <div class="">

        <div class="page-title">
            <div class="title_left">
                <h3>Visualizar Orçamento</h3>
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

                        <section class="content invoice">

                            <br />
                            <!-- title row -->
                            <div class="row">

                            </div>
                            <!-- info row -->
                            <div class="row invoice-info">
                                <div class="col-sm-4 invoice-col">

                                    <address>
                                        <strong>Cliente</strong>
                                        <br><?= stripslashes($cli->getNome()) ?> <br /><br />
                                        <strong>Descrição</strong>
                                        <br><?= stripslashes($orc->getDescricao()) ?> <br /><br />
                                        <strong>Data de Abertura</strong>
                                        <br><?= dateForForm($orc->getData_abertura()) ?> <br /><br />
                                        <strong>Data de Fechamento</strong>
                                        <br><?= ($orc->getData_fechmto() != NULL) ? dateForForm($orc->getData_fechmto()) : ' - - - -' ?> <br /><br />
                                        <strong>Status</strong>
                                        <br><?= ($orc->getStatus() == 1) ? 'Aberto' : 'Fechado'?> <br /><br />
                                        
                                    </address>
                                </div>

                            </div>

                        </section>
                    </div>
                    <!-- /.row -->

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
