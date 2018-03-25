<?php
require_once './header.php';
require_once './sidebar.php';
require_once './navigation.php';
require_once '../DAO/clienteDAO.php';
require_once '../class/Cliente.php';

$cli = new Cliente();
$cliDAO = new clienteDAO();
$cli = $cliDAO->getAll();
?>

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>
                    <?php
                    if (isset($_GET['param'])) {
                        echo 'Escolha o Cliente';
                    } else {
                        echo 'Lista de Clientes';
                    }
                    ?>
                </h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2> </h2>

                        <div class="left">
                            <a href="cadCliente.php" class="btn btn-primary">Novo Cliente</a>
                        </div>
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

                        <table id="clientes" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>CPF/CNPJ</th>
                                    <th>Cel/Tel</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($cli == NULL) {
                                    echo '<tr><td colspan=4>Nenhum usuário cadastrado até o momento.</td></tr>';
                                } else {

                                    foreach ($cli as $obj):
                                        ?>
                                        <tr>
                                            <td><?= $obj->getNome() ?></td>
                                            <td><?php
                                if ($obj->getCpf() != NULL) {
                                    echo $obj->getCpf();
                                } elseif ($obj->getCnpj() != NULL) {
                                    echo $obj->getCnpj();
                                } else {
                                    echo '';
                                }
                                        ?></td>
                                            <td><?php
                                        if ($obj->getCelular() != NULL) {
                                            echo $obj->getCelular();
                                        } elseif ($obj->getTelefone() != NULL) {
                                            echo $obj->getTelefone();
                                        } else {
                                            echo '';
                                        }
                                        ?></td>
                                            <td>
                                                <?php
                                                if (isset($_GET['param']) && ($_GET['param'] == 'b' || $_GET['param'] == 's')) {
                                                    if ($_GET['param'] == 'b') {
                                                        ?>
                                                        <a href="cadBem.php?cod=<?= $obj->getId() ?>"><i class="fa fa-plus-circle"> Bem </i></a>
                                                        <?php
                                                    }
                                                    if ($_GET['param'] == 's') {
                                                        ?>
                                                        <!--<a href="cadSeguro.php?cod=<? //$obj->getId() ?>"><i class="fa fa-plus-circle"> Seguro </i></a> -->
                                                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal<?= $obj->getId() ?>">
                                                            <i class="fa fa-plus-circle"> Seguro</i>
                                                        </button>
                                                        <?php
                                                    }
                                                } elseif (isset($_GET['view']) && ($_GET['view']) == 'orc') {
                                                    ?>
                                                        <a href="cadOrcamento.php?c=<?=$obj->getId()?>"><i class="fa fa-calendar-check-o"> Orçamento </i></a>
                                                <?php } else {
                                                    ?>
                                                    <a href="../sources/preparaCliente.php?cod=<?= $obj->getId() ?>"><i class="fa fa-eye"> Ver mais </i></a>
                                                    <a href="../sources/preparaCliente.php?edit=<?= $obj->getId() ?>"><i class="fa fa-edit"> Editar </i></a>
                                                <?php }
                                                ?>
                                            </td>
                                        </tr>
                                        <!-- MODAL -->
                                    <div  class="modal fade" id="modal<?= $obj->getId() ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title" id="gridSystemModalLabel">Selecione </h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="list-group">
                                                            <?php
                                                            require_once '../DAO/BemDAO.php';
                                                            require_once '../DAO/Tipo_BemDAO.php';
                                                            require_once '../class/Bem.php';
                                                            require_once '../class/Tipo_Bem.php';

                                                            $bem = new Bem();
                                                            $bemDAO = new BemDAO();
                                                            if (!$bem = $bemDAO->getAll($obj->getId())) {
                                                                echo '<p class="text text-center">Não foi encontrado nenhum bem para o cliente selecionado!</p>';
                                                            } else {
                                                                $tipoB = new Tipo_Bem();
                                                                $tipoBDAO = new Tipo_BemDAO();
                                                                if (is_array($bem)) {
                                                                    foreach ($bem as $b):
                                                                        $tipoB = $tipoBDAO->getById($b->getTipoBem());
                                                                        ?>
                                                                        <a href="cadSeguro.php?c=<?= $obj->getId() ?>&b=<?= $b->getId() ?>" class="list-group-item"><b>Tipo:</b> <?= $tipoB->getTipo() ?> - 
                                                                            <?php
                                                                            if ($b->getModelo() != NULL)
                                                                                echo ' <b>Modelo:</b> ' . $b->getModelo() . ' - ';
                                                                            if ($b->getPlaca() != NULL)
                                                                                echo ' <b>Placa:</b> ' . $b->getCodFipe() . ' - ';
                                                                            if ($b->getCepPernoite() != NULL)
                                                                                echo ' <b>CEP: </b>' . $b->getCepPernoite() . ' - ';
                                                                            if ($b->getCidadePernoite() != NULL)
                                                                                echo ' <b>Cidade: </b>' . $b->getCidadePernoite();
                                                                            ?>
                                                                        </a>
                                                                        <?php
                                                                    endforeach;
                                                                } elseif (!is_array($bem)) {
                                                                    $tipoB = $tipoBDAO->getById($bem->getTipoBem());
                                                                    ?>
                                                                    <a href="cadSeguro.php?c=<?= $obj->getId() ?>&b=<?= $bem->getId() ?>" class="list-group-item">Tipo: <?= $tipoB->getTipo() ?> - 
                                                                        <?php
                                                                        if ($bem->getModelo() != NULL)
                                                                            echo ' <b>Modelo:</b> ' . $bem->getModelo() . ' - ';
                                                                        if ($bem->getPlaca() != NULL)
                                                                            echo ' <b>Placa:</b> ' . $bem->getCodFipe() . ' - ';
                                                                        if ($bem->getCepPernoite() != NULL)
                                                                            echo ' <b>CEP: </b>' . $bem->getCepPernoite() . ' - ';
                                                                        if ($bem->getCidadePernoite() != NULL)
                                                                            echo ' <b>Cidade: </b>' . $bem->getCidadePernoite();
                                                                        ?>
                                                                    </a>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                </div>
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->
                                    <?php
                                endforeach;
                            }
                            ?>
                            </tbody>
                        </table>
                        <script>
                            $(document).ready(function () {
                                $('#clientes').DataTable({
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
<?php
require_once './footer.php';
