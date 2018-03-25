<?php
require_once './header.php';
require_once './sidebar.php';
require_once './navigation.php';
require_once '../DAO/EmpresaDAO.php';
require_once '../class/Empresa.php';
$path_parts = pathinfo(__FILE__);
$paginaAtual = $path_parts['basename'];

$empresa = new Empresa();
$empresaDAO = new EmpresaDAO();
$empresa = $empresaDAO->getEmpresa();
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
                        <h2>Empresa</h2>
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
                        if ($empresa == NULL || $empresa == '') {
                            ?>
                            <form class="form-horizontal form-label-left" enctype="multipart/form-data" action="../sources/salvarEmpresa.php" method="post">

                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nome Fantasia <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="name" required="required" type="text">
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cpf">Razão Social <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="razao" name="razao" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cnh">CNPJ <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="cnpj" name="cnpj" class="form-control col-md-7 col-xs-12" 
                                               data-inputmask="'mask': '99.999.999/9999-99'">
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tel">Telefone <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="tel" name="tel" class="form-control col-md-7 col-xs-12"
                                               data-inputmask="'mask': '(99) 9999-9999'" >
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cep">CEP <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="cep" name="cep" class="form-control col-md-7 col-xs-12"
                                               data-inputmask="'mask': '99999-999'">
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="rua">Endereço <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="rua" name="rua" class="form-control col-md-7 col-xs-12" placeholder="ex.: rua A">
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="num">Nº <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="num" name="num" placeholder="número do imóvel" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label for="password" class="control-label col-md-3">Cidade <span class="required">*</span> 
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="cidade" type="text" name="cidade" class="form-control col-md-7 col-xs-12" >
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label for="password" class="control-label col-md-3">Estado <span class="required">*</span> 
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="estado" type="text" name="estado" class="form-control col-md-7 col-xs-12" >
                                    </div>
                                </div>

                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <button type="reset" class="btn btn-danger">Limpar</button>
                                        <button id="salvar_empresa" name="salvar_empresa" type="submit" class="btn btn-primary">Salvar</button>
                                    </div>
                                </div>
                            </form>
                        <?php } else {
                            ?>
                            <div class="">
                                <button class="btn btn-warning" data-toggle="modal" data-target="#modal1">Alterar</button>
                            </div>
                            <div class="panel panel-default">
                                <!-- Default panel contents -->
                                <div class="panel-heading"><strong>Dados da Empresa</strong></div>
                                <!-- List group -->
                                <ul class="list-group">
                                    <li class="list-group-item"><strong>Nome:</strong> <?= stripcslashes($empresa->getNome()) ?></li>
                                    <li class="list-group-item"><strong>Razão:</strong> <?= stripcslashes($empresa->getRazao()) ?></li>
                                    <li class="list-group-item"><strong>CNPJ:</strong> <?= stripcslashes($empresa->getCnpj()) ?></li>
                                    <li class="list-group-item"><strong>Telefone:</strong> <?= stripcslashes($empresa->getTelefone()) ?></li>
                                    <li class="list-group-item"><strong>Rua:</strong> <?= stripcslashes($empresa->getRua()) ?></li>
                                    <li class="list-group-item"><strong>Número:</strong> <?= $empresa->getNumero() ?></li>
                                    <li class="list-group-item"><strong>CEP:</strong> <?= $empresa->getCep() ?></li>
                                    <li class="list-group-item"><strong>Cidade:</strong> <?= ($empresa->getCidade()) ?></li>
                                    <li class="list-group-item"><strong>Estado:</strong> <?= ($empresa->getEstado()) ?></li>
                                </ul>
                            </div>

                            <!--

                            -->
                            <!-- MODAL EDIÇAO -->
                            <div  class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
                                                            $empEdit  = new Empresa();
                                                            $empEditDAO = new EmpresaDAO();
                                                            $empEdit = $empEditDAO->getEmpresa();
                                                            ?>
                                                            <form class="form-horizontal form-label-left" action="../sources/salvarEmpresa.php" method="post">

                                                                <div class="item form-group">
                                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nome Fantasia <span class="required">*</span>
                                                                    </label>
                                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                                        <input id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" 
                                                                               name="name" required="required" type="text" value="<?= $empEdit->getNome()?>">
                                                                        <input type="hidden" name="id_emp" value="<?=$empEdit->getId() ?>" >
                                                                    </div>
                                                                </div>
                                                                <div class="item form-group">
                                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cpf">Razão Social <span class="required">*</span>
                                                                    </label>
                                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                                        <input type="text" id="razao" name="razao" class="form-control col-md-7 col-xs-12" value="<?=$empEdit->getRazao() ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="item form-group">
                                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cnh">CNPJ <span class="required">*</span>
                                                                    </label>
                                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                                        <input type="text" id="cnpj" name="cnpj" class="form-control col-md-7 col-xs-12" 
                                                                               data-inputmask="'mask': '99.999.999/9999-99'" value="<?=$empEdit->getCnpj() ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="item form-group">
                                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tel">Telefone <span class="required">*</span>
                                                                    </label>
                                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                                        <input type="text" id="tel" name="tel" class="form-control col-md-7 col-xs-12"
                                                                               data-inputmask="'mask': '(99) 9999-9999'" value="<?=$empEdit->getTelefone() ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="item form-group">
                                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cep">CEP <span class="required">*</span>
                                                                    </label>
                                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                                        <input type="text" id="cep" name="cep" class="form-control col-md-7 col-xs-12"
                                                                               data-inputmask="'mask': '99999-999'" value="<?=$empEdit->getCep() ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="item form-group">
                                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="rua">Endereço <span class="required">*</span>
                                                                    </label>
                                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                                        <input type="text" id="rua" name="rua" class="form-control col-md-7 col-xs-12" placeholder="ex.: rua A" value="<?=$empEdit->getRua() ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="item form-group">
                                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="num">Nº <span class="required">*</span>
                                                                    </label>
                                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                                        <input type="text" id="num" name="num" placeholder="número do imóvel" class="form-control col-md-7 col-xs-12"
                                                                               value="<?=$empEdit->getNumero() ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="item form-group">
                                                                    <label for="password" class="control-label col-md-3">Cidade <span class="required">*</span> 
                                                                    </label>
                                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                                        <input id="cidade" type="text" name="cidade" class="form-control col-md-7 col-xs-12" value="<?=$empEdit->getCidade() ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="item form-group">
                                                                    <label for="password" class="control-label col-md-3">Estado <span class="required">*</span> 
                                                                    </label>
                                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                                        <input id="estado" type="text" name="estado" class="form-control col-md-7 col-xs-12" value="<?=$empEdit->getEstado() ?>">
                                                                    </div>
                                                                </div>

                                                                <div class="ln_solid"></div>
                                                                <div class="form-group">
                                                                    <div class="col-md-6 col-md-offset-3">
                                                                        <button id="up_empresa" name="up_empresa" type="submit" class="btn btn-primary">Atualizar</button>
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
                        <?php }
                        ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- /page content -->

<?php
include './footer.php';
