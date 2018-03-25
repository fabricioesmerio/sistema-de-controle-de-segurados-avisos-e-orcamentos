<?php
require_once './header.php';
require_once './sidebar.php';
require_once './navigation.php';
require_once '../DAO/NivelAcessoDAO.php';
require_once '../class/NivelAcesso.php';
require_once '../DAO/Status_UsuarioDAO.php';
require_once '../class/Status_Usuario.php';
require_once '../DAO/UsuarioDAO.php';
require_once '../class/Usuario.php';

$nivel = new NivelAcesso();
$nivelDAO = new NivelAcessoDAO();
$nivel = $nivelDAO->getAll();

$status = new Status_Usuario();
$statusDAO = new Status_UsuarioDAO();
$status = $statusDAO->getAll();

$user = new Usuario();
$userDAO = new UsuarioDAO();
$user = $userDAO->getAll();
?>
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Cadastro</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Novo Usuário</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <?php
                        if (isset($_SESSION['success'])) {
                            ?>
                            <p class="alert alert-success text text-center"><?= $_SESSION['success'] ?></p>
                            <?php
                            unset($_SESSION['success']);
                        }
                        if (isset($_SESSION['error'])) {
                            ?>
                            <p class="alert alert-error text text-center"><?= $_SESSION['error'] ?></p>
                            <?php
                            unset($_SESSION['error']);
                        }
                        ?>
                        <form class="form-horizontal form-label-left" action="../sources/salvarUser.php" method="post">

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nome<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="name" required="required" type="text">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cpf">Login <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="login" name="login" class="form-control col-md-7 col-xs-12" required="required">
                                </div>
                                <p class="text text-danger" id="response"></p>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cnh">Senha <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="password" id="senha" name="senha" class="form-control col-md-7 col-xs-12" 
                                           required="required">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tel">Tipo de Usuário <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="nivelAcesso" id="nivelAcesso">
                                        <?php
                                        foreach ($nivel as $obj) {
                                            ?>
                                            <option value="<?= $obj->getId() ?>"> <?= $obj->getNivel() ?> </option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tel">Status <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="status" id="status">
                                        <?php
                                        foreach ($status as $sta) {
                                            ?>
                                            <option value="<?= $sta->getId() ?>"> <?= $sta->getStatus() ?> </option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div

                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <button type="reset" class="btn btn-danger">Limpar</button>
                                        <button id="novo_user" name="novo_user" type="submit" class="btn btn-primary">Cadastrar</button>
                                    </div>
                                </div>
                        </form>
                    </div>

                    <div class="x_content">
                        <div class="page-title">
                            <div class="title_left">
                                <h3>Usuários Cadastrados</h3>
                            </div>
                        </div>
                        <table id="usuarios" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Login</th>
                                    <th>Status</th>
                                    <th>Nível de Acesso</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($user as $u):
                                    $nivelForm = new NivelAcesso();
                                    $nivelFormDAO = new NivelAcessoDAO();
                                    $nivelForm = $nivelFormDAO->getById($u->getNivelAcesso());
                                    $status = $statusDAO->getById($u->getStatus());
                                    ?>
                                    <tr>
                                        <td><?= $u->getNome() ?></td>
                                        <td><?= $u->getLogin() ?></td>
                                        <td><?= $status->getStatus() ?></td>
                                        <td><?= $nivelForm->getNivel() ?></td>
                                        <td>
                                            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modalEdc<?= $u->getId() ?>">
                                                <i class="fa fa-pencil"></i>
                                            </button>
                                            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modalPass<?= $u->getId() ?>">
                                                <i class="fa fa fa-key"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <!-- MODAL EDIÇAO -->
                                <div  class="modal fade" id="modalEdc<?= $u->getId() ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="gridSystemModalLabel">Edição </h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                                        <div class="x_panel">
                                                            <div class="x_content">
                                                                <?php
                                                                $userEdita = new Usuario();
                                                                $userEditaDAO = new UsuarioDAO();
                                                                $userEdita = $userEditaDAO->getByID($u->getId());

                                                                $nivelEdita = new NivelAcesso();
                                                                $nivelEditaDAO = new NivelAcessoDAO();
                                                                $nivelEdita = $nivelEditaDAO->getAll();

                                                                $statusEdt = new Status_Usuario();
                                                                $statusEdtDAO = new Status_UsuarioDAO();
                                                                $statusEdt = $statusEdtDAO->getAll();
                                                                ?>
                                                                <form method="post" action="../sources/salvarUser.php" >
                                                                    <div class="form-group">
                                                                        <label class="control-label" for="name">Nome<span class="required">*</span>
                                                                        </label>
                                                                        <input type="hidden" name="id_usuario" value="<?= $userEdita->getId() ?>" >
                                                                        <input id="name" class="form-control" data-validate-length-range="6" data-validate-words="2" name="name" 
                                                                               required="required" type="text" value="<?= stripslashes($userEdita->getNome()) ?>">

                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="control-label" for="cpf">Login <span class="required">*</span>
                                                                        </label>

                                                                        <input type="text" id="login" name="login" class="form-control" 
                                                                               required="required" value="<?= stripslashes($userEdita->getLogin()) ?>">

                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="control-label" for="tel">Tipo de Usuário <span class="required">*</span>
                                                                        </label>

                                                                        <select class="form-control" name="nivelAcesso" id="nivelAcesso">
                                                                            <?php
                                                                            foreach ($nivelEdita as $obj) {
                                                                                ?>
                                                                                <option value="<?= $obj->getId() ?>" <?= ($userEdita->getNivelAcesso() == $obj->getId()) ? 'selected' : '' ?>> <?= $obj->getNivel() ?> </option>
                                                                                <?php
                                                                            }
                                                                            ?>
                                                                        </select>

                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="control-label" for="tel">Status <span class="required">*</span>
                                                                        </label>

                                                                        <select class="form-control" name="status" id="status">
                                                                            <?php
                                                                            foreach ($statusEdt as $sta) {
                                                                                ?>
                                                                                <option value="<?= $sta->getId() ?>" <?= ($userEdita->getStatus() == $sta->getId()) ? 'selected' : '' ?>> <?= $sta->getStatus() ?> </option>
                                                                                <?php
                                                                            }
                                                                            ?>
                                                                        </select>


                                                                        <div class="ln_solid"></div>
                                                                        <div class="form-group">
                                                                            <div class="col-md-6 col-md-offset-3">
                                                                                <button id="altera_user" name="altera_user" type="submit" class="btn btn-primary">Atualizar</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal ediçao -->
                                <!-- ************************************************************************************************** -->
                                <!-- MODAL ALTERA SENHA -->
                                <div  class="modal fade" id="modalPass<?= $u->getId() ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="gridSystemModalLabel">Altera Senha </h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                                        <div class="x_panel">
                                                            <div class="x_content">
                                                                <?php
                                                                $userPass = new Usuario();
                                                                $userPassDAO = new UsuarioDAO();
                                                                $userPass = $userPassDAO->getByID($u->getId());
                                                                ?>
                                                                <form method="post" action="../sources/salvarUser.php?action=new_pass" >
                                                                    <div class="form-group">
                                                                        <label class="control-label" for="new_pass">Nova Senha<span class="required">*</span>
                                                                        </label>
                                                                        <input type="hidden" name="id_usuario" value="<?= $userPass->getId() ?>" >
                                                                        <input id="new_pass" class="form-control" data-validate-length-range="6" data-validate-words="2" name="new_pass" 
                                                                               required="required" type="password" >
                                                                    </div>
                                                                    <div class="ln_solid"></div>
                                                                    <div class="form-group">
                                                                        <div class="col-md-6 col-md-offset-3">
                                                                            <button id="altera_pass" name="altera_pass" type="submit" class="btn btn-primary">Atualizar</button>
                                                                        </div>
                                                                    </div>
                                                            </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                        </div><!-- /.modal altera senha -->
    <?php
    unset($nivelForm);
    unset($nivelFormDAO);
endforeach;
?>
                    </tbody>
                    </table>
                    <script>
                        $(document).ready(function () {
                            $('#usuarios').DataTable({
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
include './footer.php';
