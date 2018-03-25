<?php
require_once '../Config/functions.php';
require_once 'header.php';
require_once 'sidebar.php';
require_once 'navigation.php';
require_once '../DAO/clienteDAO.php';
require_once '../DAO/BemDAO.php';
require_once '../class/Cliente.php';
require_once '../class/Bem.php';
require_once '../DAO/SeguroDAO.php';
require_once '../class/Seguro.php';
require_once '../class/Tipo_Bem.php';
require_once '../DAO/Tipo_BemDAO.php';
?>

<div class="right_col" role="main">
    <div class="">

        <div class="page-title">
            <div class="title_left">
                <h3>Listagem de Seguros</h3>
            </div>
        </div>
        <div class="x_content">
            <a href="javascript:history.back()" class="btn btn-dark">Voltar</a>
            <a href="index.php" class="btn btn-primary">Tela Inicial</a>
        </div>
        <div class="x_content">
            <div id="resposta">

            </div>
            <form method="POST" action="" class="form form-inline">
                <h4>Digite o perído que deseja pesquisar</h4>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12 text-center" for="dt_ini" > De </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="dt_ini" name="dt_ini" class="form-control col-md-12 col-xs-12" 
                               data-inputmask="'mask': '99/99/9999'">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12 text-center" for="dt_fim" > Até </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="dt_fim" name="dt_fim" class="form-control col-md-12 col-xs-12" 
                               data-inputmask="'mask': '99/99/9999'">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6 col-md-offset-3">
                        <button type="submit" class="" id="pesqSeguro" name="pesqSeguro" class="btn btn-primary" >
                            <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                        </button>
                    </div>
                </div>
            </form>
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
                        if (isset($_POST['dt_ini']) && isset($_POST['dt_fim'])) {
                            //vem do campo pesquisa (data inicio e data final)
                            if ($_POST['dt_ini'] != NULL) {
                                $dataIni = dateForDB(filter_input(INPUT_POST, "dt_ini"));
                            } else {
                                $dataIni = '';
                            }
                            if ($_POST['dt_fim'] != NULL) {
                                $dataFim = dateForDB(filter_input(INPUT_POST, "dt_fim"));
                            } else {
                                $dataFim = '';
                            }

                            $seg = new Seguro();
                            $segDAO = new SeguroDAO();
                            
                            if ($dataIni == '' && $dataFim == ''){
                                $seg = $segDAO->getAll();
                            } else {
                                $seg = $segDAO->buscaSeguroPorPeridio($dataIni, $dataFim);
                            }
                            
                            if (!$seg) {
                                ?>
                                <table id="seguros" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Cód.</th>
                                            <th>Cliente</th>
                                            <th>Tipo Seg</th>
                                            <th>Detalhes</th>
                                            <th>Início Contr.</th>
                                            <th>Fim Contr.</th>
                                            <th>Situação</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td colspan="8">Não há registros para o período escolhido!</td>
                                        </tr>
                                    </tbody>
                                </table>

                                <?php
                            } else {
                                if (is_array($seg)) {
                                    ?>
                                    <table id="seguros" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Cód.</th>
                                                <th>Cliente</th>
                                                <th>Tipo Seg</th>
                                                <th>Detalhes</th>
                                                <th>Início Contr.</th>
                                                <th>Fim Contr.</th>
                                                <th>Situação</th>
                                                <th>Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($seg as $s):
                                                $cli = new Cliente();
                                                $cliDAO = new clienteDAO();
                                                $cli = $cliDAO->getById($s->getCliente());
                                                $bem = new Bem();
                                                $bemDAO = new BemDAO();
                                                $bem = $bemDAO->getById($s->getBem());
                                                $tipo = new Tipo_Bem();
                                                $tipoDAO = new Tipo_BemDAO();
                                                $tipo = $tipoDAO->getById($bem->getTipoBem());
                                                ?>
                                                <tr>
                                                    <td><?= $s->getId() ?></td>
                                                    <td><?= $cli->getNome() ?></td>
                                                    <td><?= $tipo->getTipo() ?></td>
                                                    <td>
                                                        <?php
                                                        if ($tipo->getTipo() == "Automóvel" || $tipo->getTipo() == "Motocicleta") {
                                                            echo '<strong>Modelo:</strong> ' . $bem->getModelo() . ' - <strong>Placa:</strong> ' . $bem->getPlaca();
                                                        } else {
                                                            echo '<strong>CEP:</strong> ' . $bem->getCepPernoite() . ' - <strong>Cidade:</strong> ' . $bem->getCidadePernoite();
                                                        }
                                                        ?>
                                                    </td>
                                                    <td><?= dateForForm($s->getDataInicio()) ?></td>
                                                    <td><?= dateForForm($s->getDataFinal()) ?></td>
                                                    <td><?= ($s->getIs_closed() == "sim" ) ? 'fechado' : 'em aberto'?></td>
                                                    <td>
                                                        <?php
                                                        if ($s->getIs_closed() == 'sim'){ ?>
                                                            <a href="verSeguro.php?s=<?= $s->getId() ?>"><i class="fa fa-search"></i></a></td>
                                                        <?php
                                                        
                                                        } else { ?>
                                                            <a href="renova.php?s=<?= $s->getId() ?>"><i class="fa fa-refresh"></i></a> <a href="editaSeguro.php?s=<?= $s->getId() ?>"><i class="fa fa-edit"></i></a> <a href="verSeguro.php?s=<?= $s->getId() ?>"><i class="fa fa-search"></i></a></td>
                                                       <?php }
                                                        ?>                                                        
                                                </tr>
                                                <?php
                                                unset($cli);
                                                unset($cliDAO);
                                                unset($bem);
                                                unset($bemDAO);
                                                unset($tipoDAO);
                                                unset($tipo);
                                            endforeach;
                                            ?>
                                        </tbody>
                                    </table>     

                                    <?php
                                } else {
                                    ?>
                                    <table id="seguros" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Cód.</th>
                                                <th>Cliente</th>
                                                <th>Tipo Seg</th>
                                                <th>Detalhes</th>
                                                <th>Início Contr.</th>
                                                <th>Fim Contr.</th>
                                                <th>Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $cli = new Cliente();
                                            $cliDAO = new clienteDAO();
                                            $cli = $cliDAO->getById($seg->getCliente());
                                            $bem = new Bem();
                                            $bemDAO = new BemDAO();
                                            $bem = $bemDAO->getById($seg->getBem());
                                            $tipo = new Tipo_Bem();
                                            $tipoDAO = new Tipo_BemDAO();
                                            $tipo = $tipoDAO->getById($bem->getTipoBem());
                                            ?>
                                            <tr>
                                                <td><?= $seg->getId() ?></td>
                                                <td><?= $cli->getNome() ?></td>
                                                <td><?= $tipo->getTipo() ?></td>
                                                <td>
                                                    <?php
                                                    if ($tipo->getTipo() == "Automóvel" || $tipo->getTipo() == "Motocicleta") {
                                                        echo '<strong>Modelo:</strong> ' . $bem->getModelo() . ' - <strong>Placa:</strong> ' . $bem->getPlaca();
                                                    } else {
                                                        echo '<strong>CEP:</strong> ' . $bem->getCepPernoite() . ' - <strong>Cidade:</strong> ' . $bem->getCidadePernoite();
                                                    }
                                                    ?>
                                                </td>
                                                <td><?= dateForForm($seg->getDataInicio()) ?></td>
                                                <td><?= dateForForm($seg->getDataFinal()) ?></td>
                                                <td><a href="renova.php?s=<?= $seg->getId() ?>"><i class="fa fa-refresh"></i></a> <a href="editaSeguro.php?s=<?= $seg->getId() ?>"><i class="fa fa-edit"></i></a> <a href="verSeguro.php?s=<?= $seg->getId() ?>"><i class="fa fa-search"></i></a></td>
                                            </tr>
                                            <?php
                                            unset($cli);
                                            unset($cliDAO);
                                            unset($bem);
                                            unset($bemDAO);
                                            unset($tipoDAO);
                                            unset($tipo);
                                            ?>
                                        </tbody>
                                    </table>
                                    <?php
                                }
                            }
                        } elseif (isset($_GET['m']) && isset($_GET['y'])) {

                            $mes = filter_input(INPUT_GET, 'm');
                            $ano = filter_input(INPUT_GET, 'y');

                            $seg = new Seguro();
                            $segDAO = new SeguroDAO();
                            if (!($seg = $segDAO->verificaSegurosAVencer($mes, $ano, 2))) {
                                ?>
                                <table id="seguros" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Cód.</th>
                                            <th>Cliente</th>
                                            <th>Tipo Seg</th>
                                            <th>Detalhes</th>
                                            <th>Início Contr.</th>
                                            <th>Fim Contr.</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td colspan="7">Não há registros para o período escolhido!</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <?php
                            } else {
                                if (is_array($seg)) {
                                    ?>

                                    <table id="seguros" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Cód.</th>
                                                <th>Cliente</th>
                                                <th>Tipo Seg</th>
                                                <th>Detalhes</th>
                                                <th>Início Contr.</th>
                                                <th>Fim Contr.</th>
                                                <th>Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($seg as $s):
                                                $cli = new Cliente();
                                                $cliDAO = new clienteDAO();
                                                $cli = $cliDAO->getById($s->getCliente());
                                                $bem = new Bem();
                                                $bemDAO = new BemDAO();
                                                $bem = $bemDAO->getById($s->getBem());
                                                $tipo = new Tipo_Bem();
                                                $tipoDAO = new Tipo_BemDAO();
                                                $tipo = $tipoDAO->getById($bem->getTipoBem());
                                                ?>
                                                <tr>
                                                    <td><?= $s->getId() ?></td>
                                                    <td><?= $cli->getNome() ?></td>
                                                    <td><?= $tipo->getTipo() ?></td>
                                                    <td>
                                                        <?php
                                                        if ($tipo->getTipo() == "Automóvel" || $tipo->getTipo() == "Motocicleta") {
                                                            echo '<strong>Modelo:</strong> ' . $bem->getModelo() . ' - <strong>Placa:</strong> ' . $bem->getPlaca();
                                                        } else {
                                                            echo '<strong>CEP:</strong> ' . $bem->getCepPernoite() . ' - <strong>Cidade:</strong> ' . $bem->getCidadePernoite();
                                                        }
                                                        ?>
                                                    </td>
                                                    <td><?= dateForForm($s->getDataInicio()) ?></td>
                                                    <td><?= dateForForm($s->getDataFinal()) ?></td>
                                                    <td><a href="renova.php?s=<?= $s->getId() ?>"><i class="fa fa-refresh"></i></a></td>
                                                </tr>
                                                <?php
                                                unset($cli);
                                                unset($cliDAO);
                                                unset($bem);
                                                unset($bemDAO);
                                                unset($tipoDAO);
                                                unset($tipo);
                                            endforeach;
                                            ?>
                                        </tbody>
                                    </table>

                                <?php } else {
                                    ?>
                                    <table id="seguros" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Cód.</th>
                                                <th>Cliente</th>
                                                <th>Tipo Seg</th>
                                                <th>Detalhes</th>
                                                <th>Início Contr.</th>
                                                <th>Fim Contr.</th>
                                                <th>Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $cli = new Cliente();
                                            $cliDAO = new clienteDAO();
                                            $cli = $cliDAO->getById($seg->getCliente());
                                            $bem = new Bem();
                                            $bemDAO = new BemDAO();
                                            $bem = $bemDAO->getById($seg->getBem());
                                            $tipo = new Tipo_Bem();
                                            $tipoDAO = new Tipo_BemDAO();
                                            $tipo = $tipoDAO->getById($bem->getTipoBem());
                                            ?>
                                            <tr>
                                                <td><?= $seg->getId() ?></td>
                                                <td><?= $cli->getNome() ?></td>
                                                <td><?= $tipo->getTipo() ?></td>
                                                <td>
                                                    <?php
                                                    if ($tipo->getTipo() == "Automóvel" || $tipo->getTipo() == "Motocicleta") {
                                                        echo '<strong>Modelo:</strong> ' . $bem->getModelo() . ' - <strong>Placa:</strong> ' . $bem->getPlaca();
                                                    } else {
                                                        echo '<strong>CEP:</strong> ' . $bem->getCepPernoite() . ' - <strong>Cidade:</strong> ' . $bem->getCidadePernoite();
                                                    }
                                                    ?>
                                                </td>
                                                <td><?= dateForForm($seg->getDataInicio()) ?></td>
                                                <td><?= dateForForm($seg->getDataFinal()) ?></td>
                                                <td><a href="renova.php?s=<?= $seg->getId() ?>"><i class="fa fa-refresh"></i></a></td>
                                            </tr>
                                            <?php
                                            unset($cli);
                                            unset($cliDAO);
                                            unset($bem);
                                            unset($bemDAO);
                                            unset($tipoDAO);
                                            unset($tipo);
                                            ?>
                                        </tbody>
                                    </table>
                                    <?php
                                }
                            }
                        } else {

                            /**
                             * Entra aqui pelo menu pesquisar -> pesquisar Seguros
                             */
                            $seg = new Seguro();
                            $segDAO = new SeguroDAO();
                            if (!$seg = $segDAO->getAll()) {
                                ?>
                                <table id="seguros" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Cód.</th>
                                            <th>Cliente</th>
                                            <th>Tipo Seg</th>
                                            <th>Detalhes</th>
                                            <th>Início Contr.</th>
                                            <th>Fim Contr.</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td colspan="7">Não há registros para o período escolhido!</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <?php
                            } else {
                                if (is_array($seg)) {
                                    ?>
                                    <table id="seguros" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Cód.</th>
                                                <th>Cliente</th>
                                                <th>Tipo Seg</th>
                                                <th>Detalhes</th>
                                                <th>Início Contr.</th>
                                                <th>Fim Contr.</th>
                                                <th>Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($seg as $s):
                                                $cli = new Cliente();
                                                $cliDAO = new clienteDAO();
                                                $cli = $cliDAO->getById($s->getCliente());
                                                $bem = new Bem();
                                                $bemDAO = new BemDAO();
                                                $bem = $bemDAO->getById($s->getBem());
                                                $tipo = new Tipo_Bem();
                                                $tipoDAO = new Tipo_BemDAO();
                                                $tipo = $tipoDAO->getById($bem->getTipoBem());
                                                ?>
                                                <tr>
                                                    <td><?= $s->getId() ?></td>
                                                    <td><?= $cli->getNome() ?></td>
                                                    <td><?= $tipo->getTipo() ?></td>
                                                    <td>
                                                        <?php
                                                        if ($tipo->getTipo() == "Automóvel" || $tipo->getTipo() == "Motocicleta") {
                                                            echo '<strong>Modelo:</strong> ' . $bem->getModelo() . ' - <strong>Placa:</strong> ' . $bem->getPlaca();
                                                        } else {
                                                            echo '<strong>CEP:</strong> ' . $bem->getCepPernoite() . ' - <strong>Cidade:</strong> ' . $bem->getCidadePernoite();
                                                        }
                                                        ?>
                                                    </td>
                                                    <td><?= dateForForm($s->getDataInicio()) ?></td>
                                                    <td><?= dateForForm($s->getDataFinal()) ?></td>
                                                    <td><a href="editaSeguro.php?s=<?= $s->getId() ?>"><i class="fa fa-edit"></i></a> <a href="verSeguro.php?s=<?= $s->getId() ?>"><i class="fa fa-search"></i></a></td>
                                                </tr>
                                                <?php
                                                unset($cli);
                                                unset($cliDAO);
                                                unset($bem);
                                                unset($bemDAO);
                                                unset($tipoDAO);
                                                unset($tipo);
                                            endforeach;
                                            ?>
                                        </tbody>
                                    </table>
                                <?php } else {
                                    ?>
                                    <table id="seguros" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Cód.</th>
                                                <th>Cliente</th>
                                                <th>Tipo Seg</th>
                                                <th>Detalhes</th>
                                                <th>Início Contr.</th>
                                                <th>Fim Contr.</th>
                                                <th>Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $cli = new Cliente();
                                            $cliDAO = new clienteDAO();
                                            $cli = $cliDAO->getById($seg->getCliente());
                                            $bem = new Bem();
                                            $bemDAO = new BemDAO();
                                            $bem = $bemDAO->getById($seg->getBem());
                                            $tipo = new Tipo_Bem();
                                            $tipoDAO = new Tipo_BemDAO();
                                            $tipo = $tipoDAO->getById($bem->getTipoBem());
                                            ?>
                                            <tr>
                                                <td><?= $seg->getId() ?></td>
                                                <td><?= $cli->getNome() ?></td>
                                                <td><?= $tipo->getTipo() ?></td>
                                                <td>
                                                    <?php
                                                    if ($tipo->getTipo() == "Automóvel" || $tipo->getTipo() == "Motocicleta") {
                                                        echo '<strong>Modelo:</strong> ' . $bem->getModelo() . ' - <strong>Placa:</strong> ' . $bem->getPlaca();
                                                    } else {
                                                        echo '<strong>CEP:</strong> ' . $bem->getCepPernoite() . ' - <strong>Cidade:</strong> ' . $bem->getCidadePernoite();
                                                    }
                                                    ?>
                                                </td>
                                                <td><?= dateForForm($seg->getDataInicio()) ?></td>
                                                <td><?= dateForForm($seg->getDataFinal()) ?></td>
                                                <td><a href="editaSeguro.php?s=<?= $seg->getId() ?>"><i class="fa fa-edit"></i></a></td>
                                            </tr>
                                            <?php
                                            unset($cli);
                                            unset($cliDAO);
                                            unset($bem);
                                            unset($bemDAO);
                                            unset($tipoDAO);
                                            unset($tipo);
                                            ?>
                                        </tbody>
                                    </table>    
                                    <?php
                                }
                            }
                        }
                        ?>
                        <script>
                            $(document).ready(function () {
                                $('#seguros').DataTable({
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
