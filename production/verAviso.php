<?php
require_once 'header.php';
require_once 'sidebar.php';
require_once 'navigation.php';
require_once '../DAO/AvisoDAO.php';
require_once '../class/Aviso.php';


if (isset($_GET['av'])) {
    if ($_GET['av'] != NULL || $_GET['av'] != '') {
        $aviso = new Aviso();
        $avisoDAO = new AvisoDAO();
        $aviso = $avisoDAO->getById(addslashes(filter_input(INPUT_GET, 'av')));
        if ($aviso == NULL) {
            echo '<SCRIPT Language="javascript">
            alert(\'Erro de parâmetro. Tente novamente!\');
            location.href="javascript:history.back()";
          </SCRIPT>';
        }
    } else {
        echo '<SCRIPT Language="javascript">
            alert(\'Você deve selecionar um aviso para prosseguir. Tente novamente!\');
            location.href="javascript:history.back()";
          </SCRIPT>';
    }
} else {
    echo '<SCRIPT Language="javascript">
            alert(\'Não foi possível acessar ao parâmetro do aviso. Tente novamente!\');
            location.href="javascript:history.back()";
          </SCRIPT>';
}
?>
<div class="right_col" role="main">
    <div class="">

        <div class="page-title">
            <div class="title_left">
                <h3>Visualizar Aviso</h3>
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
                                        <strong>Descrição</strong>
                                        <br><?= stripslashes($aviso->getDescricao()) ?> <br /><br />
                                        <strong>Data de Abertura</strong>
                                        <br><?= dateForForm($aviso->getData_abertura()) ?> <br /><br />
                                        <strong>Data de Fechamento</strong>
                                        <br><?= ($aviso->getData_fechamnto() != NULL) ? dateForForm($aviso->getData_fechamnto()) : ' - - - -' ?> <br /><br />
                                        <strong>Status</strong>
                                        <br><?= ($aviso->getStatus() == 1) ? 'Aberto' : 'Fechado'?> <br /><br />
                                        <i>Última atualização feita por: <?php
                                            require_once '../DAO/UsuarioDAO.php';
                                            require_once '../class/Usuario.php';
                                            $user = new Usuario();
                                            $userDAO = new UsuarioDAO();
                                            $user = $userDAO->getByID($aviso->getUsuario_respons());
                                            echo $user->getNome();
                                            ?> </i><br /><br />

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
