<?php

require_once 'header.php';
require_once 'sidebar.php';
require_once 'navigation.php';
require_once '../class/Tipo_Bem.php';
require_once '../DAO/Tipo_BemDAO.php';



if (isset($_POST['adicionar'])) {
    $bem = new Tipo_Bem();
    $bemDAO = new Tipo_BemDAO();
    $bem->setTipo(addslashes(filter_input(INPUT_POST, 'tipo')));
    if ($bemDAO->insert($bem)) {
        $_SESSION['success'] = "Salvo com sucesso!";
    } else {
        $_SESSION['error'] = "Ocorreu um erro ao salvar.";
    }
    $tipo = new Tipo_Bem();
    $tipoDAO = new Tipo_BemDAO();
    $tipo = $tipoDAO->getAll();
} elseif (isset ($_POST['alteraTipo'])) {
    $idTipo = filter_input(INPUT_POST, 'idTipo');
    $novoTipo = addslashes(filter_input(INPUT_POST, 'tipo'));
    $tipo = new Tipo_Bem();
    $tipoDAO = new Tipo_BemDAO();
    $tipo = $tipoDAO->getById($idTipo);
    $tipo->setTipo($novoTipo);
    if($tipoDAO->update($tipo)){
        $_SESSION['success'] = "Atualizado com sucesso!";
    } else {
        $_SESSION['error'] = "Ocorreu um erro ao atualizar.";
    }
    $tipo = $tipoDAO->getAll();
}else {
    $tipo = new Tipo_Bem();
    $tipoDAO = new Tipo_BemDAO();
    $tipo = $tipoDAO->getAll();
}
?>

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Cadastro de Tipo de Bem</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Cadastre os tipos de bens <span class="text text-right" style="font-size: 12px;">(por ex.: automóvel, motoclicleta, entre outros)</span></h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <?php if (isset($_SESSION['success'])) { ?>
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
                        <form class="form-horizontal form-label-left" method="post" action="" >

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tipo">Tipo <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="tipo" class="form-control col-md-7 col-xs-12" name="tipo" required="required" type="text">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-3">
                                    <a href="javascript:history.back()" class="btn btn-danger">Voltar</a>
                                    <button id="adicionar" name="adicionar" type="submit" class="btn btn-primary">Adicionar</button>
                                </div>
                            </div>
                        </form> 
                    </div>
                </div>

            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Tipos Cadastrados no sistema</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table id="tb_tipo" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Descrição</th>
                                    <th>Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (($tipo == NULL || $tipo == "")) {
                                    echo '<tr><td colspan="3" class="text text-warning">Nenhum registro encontrado!</td></tr>';
                                } else {
                                    foreach ($tipo as $obj):
                                        ?>
                                        <tr>
                                            <td><?= $obj->getId() ?></td>
                                            <td><?= utf8_encode($obj->getTipo()) ?></td>
                                            <td><button class="btn btn-group-sm fa fa-edit" data-toggle="modal" data-target="#modalEdita<?= $obj->getId() ?>"></button></td>
                                            <!-- Modal -->
                                    <div class="modal fade" id="modalEdita<?= $obj->getId() ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Edita Tipo</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="tipoBem.php" method="post">
                                                <div class="modal-body">
                                                    <input type="hidden" name="idTipo" id="idTipo" value="<?=$obj->getId()?>" />
                                                    <label for="tipo">Tipo: </label><input id="tipo" name="tipo" type="text" value="<?= utf8_encode($obj->getTipo()) ?>" />

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                    <button type="submit" class="btn btn-primary" id="alteraTipo" name="alteraTipo">Salvar alteração</button>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    </tr>
                                    <?php
                                endforeach;
                            }
                            ?>
                            </tbody>
                        </table>
                        <script>
                            $(document).ready(function () {
                                $('#tb_tipo').DataTable({
                                    "language": {
                                        "lengthMenu": "Mostrando _MENU_ registros por página",
                                        "zeroRecords": "Nada encontrado.",
                                        "info": "Mostrando página _PAGE_ de _PAGES_",
                                        "infoEmpty": "Nenhum registro disponível",
                                        "infoFiltered": "(filtrado de  _MAX_ registros no total)",
                                        "search": "Pesquisar: ",
                                        "paginate": {
                                            "first": "Primeiro",
                                            "last": "Último",
                                            "next": "Próximo",
                                            "previous": "Anterior"
                                        },
                                    }
                                });
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
include 'footer.php';
