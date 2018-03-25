<?php
require_once '../Config/functions.php';
require_once 'header.php';
require_once 'sidebar.php';
require_once 'navigation.php';
?>
<div class="right_col" role="main">
    <div class="">

        <div class="x_content">
            <a href="javascript:history.back()" class="btn btn-dark">Voltar</a>
            <a href="index.php" class="btn btn-primary">Tela Inicial</a>
            <a href="cadAviso.php" class="btn btn-primary">Novo Aviso</a>
        </div>
        <div class="page-title">
            <div class="title_left">
                <h3>Avisos</h3>
            </div>
        </div>
        <div class="x_content">
            <div id="resposta">

            </div>

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
                        if (isset($_GET['view']) && $_GET['view'] == 'all') {
                            require_once '../DAO/AvisoDAO.php';
                            require_once '../class/Aviso.php';
                            $aviso = new Aviso();
                            $avisoDAO = new AvisoDAO();
                            $aviso = $avisoDAO->getAll();
                            ?>
                            <table id="avisos" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Descrição</th>
                                        <th>Data Cadastramento</th>
                                        <th>Data Baixa</th>
                                        <th>Status</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $cont = 1;
                                    if ($aviso != NULL):
                                        foreach ($aviso as $a):
                                            ?>
                                            <tr>
                                                <td><?= $cont++ ?></td>
                                                <td><?= substr(stripslashes($a->getDescricao()), 0, 40) . ' <i>(leia mais...)</i>' ?></td>
                                                <td><?= dateForForm($a->getData_abertura()) ?></td>
                                                <td><?= ($a->getData_fechamnto() != NULL) ? dateForForm($a->getData_fechamnto()) : '' ?></td>
                                                <td><?= ($a->getStatus() == 1) ? 'Aberto' : 'Fechado' ?></td>
                                                <td>
                                                    <a href="verAviso.php?av=<?=$a->getId()?>"><i class="fa fa-eye"></i></a> -
                                                    <a href="cadAviso.php?action=update&av=<?=$a->getId() ?>"><i class="fa fa-edit"></i></a>
                                                </td>
                                            </tr>
                                            <?php
                                        endforeach;
                                    else:
                                        ?>
                                        <tr>
                                            <td colspan="6">Nenhum dado para exibir no momento!</td>
                                        </tr>
                                    <?php
                                    endif;
                                    ?>
                                </tbody>
                            </table>
                            <?php
                        } elseif (isset($_GET['view']) && $_GET['view'] == 'open') {
                            require_once '../DAO/AvisoDAO.php';
                            require_once '../class/Aviso.php';
                            $aviso = new Aviso();
                            $avisoDAO = new AvisoDAO();
                            $aviso = $avisoDAO->getAllAtivos();
                            ?>
                            <table id="avisos" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Descrição</th>
                                        <th>Data Cadastramento</th>
                                        <th>Data Baixa</th>
                                        <th>Status</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($aviso != NULL):
                                        $cont = 1;
                                        foreach ($aviso as $a):
                                            ?>
                                            <tr>
                                                <td><?= $cont++ ?></td>
                                                <td><?= substr(stripslashes($a->getDescricao()), 0, 40) . ' <i>(leia mais...)</i>' ?></td>
                                                <td><?= dateForForm($a->getData_abertura()) ?></td>
                                                <td><?= ($a->getData_fechamnto() != NULL) ? dateForForm($a->getData_fechamnto()) : '' ?></td>
                                                <td><?= ($a->getStatus() == 1) ? 'Aberto' : 'Fechado' ?></td>
                                                <td>
                                                    <a href="verAviso.php?av=<?=$a->getId()?>"><i class="fa fa-eye"></i></a> - 
                                                    <a href="cadAviso.php?action=update&av=<?=$a->getId() ?>"><i class="fa fa-edit"></i></a>
                                                </td>
                                            </tr>
                                            <?php
                                        endforeach;
                                    else:
                                        ?>
                                        <tr>
                                            <td colspan="6">Nenhum dado para exibir no momento!</td>
                                        </tr>
                                    <?php endif;
                                    ?>
                                </tbody>
                            </table>
                            <?php
                        } else { ?>
                            <script type="text/javascript">
                                alert("Erro de parâmetro, tente novamente!");
                                location.href=history.back();
                            </script>
                       <?php }
                        ?>
                        <script>
                            $(document).ready(function () {
                                $('#avisos').DataTable({
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
require_once './footer.php';
