<?php

require_once 'header.php';
require_once 'sidebar.php';
require_once 'navigation.php';
require_once '../class/Tipo_Bem.php';
require_once '../DAO/Tipo_BemDAO.php';


if (isset($_GET['c'])) {
    $id_cliente = filter_input(INPUT_GET, 'c');
} else {
    $_SESSION['error'] = "Você deve selecionar um cliente primeiro!";
}

$tipo = new Tipo_Bem();
$tipoDAO = new Tipo_BemDAO();
$tipo = $tipoDAO->getAll();
?>

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Selecione</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Escolha o tipo de bem a ser cadastrado</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">


                        <?php
                        if (isset($_SESSION['error'])){
                            ?>
                                <p class = "alert alert-error text text-center"><?= $_SESSION['error'] ?></p>
                                <?php
                                unset($_SESSION['error']);
                        } else {
                        foreach ($tipo as $t):
                            ?>
                                <a id="tipo_bem" name="tipo_bem" class="btn btn-primary btn-lg" href="cadBem.php?c=<?=$id_cliente?>&opc=<?= $t->getId() ?>"><?= utf8_encode($t->getTipo()) ?></a>
                            <?php
                        endforeach;
                        }
                        ?>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- /page content -->


<?php
include 'footer.php';
