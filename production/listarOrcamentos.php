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
            <a href="listasClientes.php?view=orc" class="btn btn-primary">Novo Orçamento</a>
        </div>
        <div class="page-title">
            <div class="title_left">
                <h3>Orçamentos</h3>
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
                            require_once '../DAO/OrcamentoDAO.php';
                            require_once '../class/Orcamento.php';
                            $orcam = new Orcamento();
                            $orcamDAO = new OrcamentoDAO();
                            $orcam = $orcamDAO->getAll();
                            ?>
                            <table id="orcamentos" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Cliente</th>
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
                                    if ($orcam != NULL):
                                        require_once '../DAO/clienteDAO.php';
                                        require_once '../class/Cliente.php';
                                        $cli = new Cliente();
                                        $cliDAO = new clienteDAO();
                                        foreach ($orcam as $o):
                                            $cli = $cliDAO->getById($o->getCliente());
                                            ?>
                                            <tr>
                                                <td><?= $cont++ ?></td>
                                                <td><?= $cli->getNome() ?></td>
                                                <td><?= substr(stripslashes($o->getDescricao()), 0, 40) . ' <i>(leia mais...)</i>' ?></td>
                                                <td><?= dateForForm($o->getData_abertura()) ?></td>
                                                <td><?= ($o->getData_fechmto() != NULL) ? dateForForm($o->getData_fechmto()) : '' ?></td>
                                                <td><?= ($o->getStatus() == 1) ? 'Aberto' : 'Fechado' ?></td>
                                                <td>
                                                    <a href="verOrcamento.php?or=<?=$o->getId() ?>"><i class="fa fa-eye"></i></a> - 
                                                    <a href="cadOrcamento.php?action=update&or=<?=$o->getId() ?>"><i class="fa fa-edit"></i></a>
                                                </td>
                                            </tr>
                                            <?php
                                            unset($cli);
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
                            require_once '../DAO/OrcamentoDAO.php';
                            require_once '../class/Orcamento.php';
                            $orcam = new Orcamento();
                            $orcamDAO = new OrcamentoDAO();
                            $orcam = $orcamDAO->getAllAtivo();
                            ?>
                            <table id="orcamentos" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Cliente</th>
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
                                    if ($orcam != NULL):
                                        require_once '../DAO/clienteDAO.php';
                                        require_once '../class/Cliente.php';
                                        $cli = new Cliente();
                                        $cliDAO = new clienteDAO();
                                        foreach ($orcam as $o):
                                            $cli = $cliDAO->getById($o->getCliente());
                                            ?>
                                            <tr>
                                                <td><?= $cont++ ?></td>
                                                <td><?= $cli->getNome() ?></td>
                                                <td><?= substr(stripslashes($o->getDescricao()), 0, 40) . ' <i>(leia mais...)</i>' ?></td>
                                                <td><?= dateForForm($o->getData_abertura()) ?></td>
                                                <td><?= ($o->getData_fechmto() != NULL) ? dateForForm($o->getData_fechmto()) : '' ?></td>
                                                <td><?= ($o->getStatus() == 1) ? 'Aberto' : 'Fechado' ?></td>
                                                <td>
                                                    <a href="verOrcamento.php?or=<?=$o->getId() ?>"><i class="fa fa-eye"></i></a> - 
                                                    <a href="cadOrcamento.php?action=update&or=<?=$o->getId() ?>"><i class="fa fa-edit"></i></a>
                                                </td>
                                            </tr>
                                            <?php
                                            unset($cli);
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
                        <?php } else {
                            ?>
                            <script type="text/javascript">
                                alert("Erro de parâmetro, tente novamente!");
                                location.href = history.back();
                            </script>
                        <?php }
                        ?>
                        <script>
                            $(document).ready(function () {
                                $('#orcamentos').DataTable({
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
