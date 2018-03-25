<?php
require_once 'header.php';
require_once 'sidebar.php';
require_once 'navigation.php';
require_once '../Config/functions.php';
require_once '../DAO/clienteDAO.php';
$cliDAO = new clienteDAO();
?>



<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="row top_tiles">
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                    <a href="listasClientes.php"><div class="icon"><i class="fa fa-users"></i></div>
                        <div class="count"><?=$cliDAO->count()?></div>
                        <h3>Clientes</h3>
                        <p>Total de clientes cadastrados.</p> </a>
                </div>
            </div>
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                    <a href="listaSeguros.php?m=<?= date("m") ?>&y=<?= date("Y") ?>"><div class="icon"><i class="fa fa-exclamation-circle"></i></div>
                        <div class="count"><?= pegaSegurosAVencerMesAno() ?></div>
                        <h3>Seguros</h3>
                        <p>vencendo em <?= date("m") ?> de <?= date("Y") ?>.</p> </a>
                </div>
            </div>
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                    <a href="listarAvisos.php?view=open"><div class="icon"><i class="fa fa-comments"></i></div>
                    <div class="count"><?= (countAvisos() == NULL) ? '0' : countAvisos() ?></div>
                    <h3>Avisos</h3>
                    <p>Em aberto.</p></a>
                </div>
            </div>
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                    <a href="listarOrcamentos.php?view=open"><div class="icon"><i class="fa fa-calendar-check-o"></i></div>
                    <div class="count"><?= (countOrcamentos() == NULL) ? '0' : countOrcamentos() ?></div>
                    <h3>Orçamentos</h3>
                    <p>Em aberto.</p> </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->

<?php
include 'footer.php';
