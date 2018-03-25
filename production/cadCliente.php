<?php

require_once 'header.php';
require_once 'sidebar.php';
require_once 'navigation.php';
require_once '../class/Cliente.php';
require_once '../class/Tipo_Cliente.php';
require_once '../class/Endereco.php';
require_once '../DAO/Tipo_ClienteDAO.php';

$cliente = new Cliente();
$endereco = new Endereco();
?>

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Cadastro de Clientes</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2></h2>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <form id="select">
                                <label><input id="formPF" value="PF" name="opcao" type="radio">Pessoa Física</label>
                                <label><input id="formPJ" value="PJ" name="opcao" type="radio">Pessoa Jurídica</label>
                            </form>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <?php
                        if (isset($_SESSION['sucess'])) {
                            ?>
                            <p class = "alert alert-success text text-center"><?= $_SESSION['sucess'] ?></p>
                            <?php
                            unset($_SESSION['sucess']);
                        }
                        if (isset($_SESSION['error'])) {
                            ?>
                            <p class = "alert alert-error text text-center"><?= $_SESSION['error'] ?></p>
                            <?php
                            unset($_SESSION['error']);
                        }
                        ?>

                        <form id="PF" style="display: none;" class="form-horizontal form-label-left" method="post" action="../sources/salvaCliente.php" >
                            <?php
                            $tipo = new Tipo_Cliente();
                            $tipoDAO = new Tipo_ClienteDAO();
                            $tipo = $tipoDAO->getByDescri("Pessoa Física");
                            ?>
                            <input type="hidden" id="tipo_cliente" name="tipo_cliente" value="<?= $tipo->getId() ?>" >
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nome <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="name" required="required" type="text">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cpf">CPF 
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="cpf" name="cpf" class="form-control col-md-7 col-xs-12"
                                           data-inputmask="'mask': '999.999.999-99'">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cnh">CNH 
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="cnh" name="cnh" class="form-control col-md-7 col-xs-12" >
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cel">Celular 
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="cel" name="cel" class="form-control col-md-7 col-xs-12"
                                           data-inputmask="'mask': '(99) 99999-9999'" >
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="dtNasc">Data Nascimento </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="dtNasc" name="dtNasc" class="form-control col-md-7 col-xs-12"
                                           data-inputmask="'mask': '99/99/9999'" >
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="sexo">Sexo 
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div id="sexo" class="btn-group" data-toggle="buttons">
                                        <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-primary">
                                            <input type="radio" name="sexo" value="M"> &nbsp; Masculino &nbsp;
                                        </label>
                                        <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-primary">
                                            <input type="radio" name="sexo" value="F"> &nbsp; Feminino &nbsp;
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Estado Civil</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" tabindex="-1" name="estCivil" id="estCivil">
                                        <option value=""> ----  Selecione um opção ----</option>
                                        <option value="Solteiro(a)">Solteiro(a)</option>
                                        <option value="União Estável">União Estável</option>
                                        <option value="Casado(a)">Casado(a)</option>
                                        <option value="Divorciado(a)">Divorciado(a)</option>
                                        <option value="Separado(a)">Separado(a)</option>
                                        <option value="Viúvo(a)">Viúvo(a)</option>
                                    </select>
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cep">CEP Residência 
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="cep" name="cep" class="form-control col-md-7 col-xs-12"
                                           data-inputmask="'mask': '99.999-999'">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="rua">Endereço Residência 
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="rua" name="rua" class="form-control col-md-7 col-xs-12" placeholder="ex.: rua A">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="num">Nº
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="num" name="num" placeholder="número do imóvel" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="complemento">Complemento
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="complemento" name="complemento" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="bairro">Bairro 
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="bairro" type="text" name="bairro" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label for="cidade" class="control-label col-md-3">Cidade Residência 
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="cidade" type="text" name="cidade" class="form-control col-md-7 col-xs-12" >
                                </div>
                            </div>
                            <div class="item form-group">
                                <label for="estado" class="control-label col-md-3">Estado 
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="estado" type="text" name="estado" class="form-control col-md-7 col-xs-12" >
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="obs">Observações </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <textarea id="obs" name="obs" class="form-control col-md-7 col-xs-12"></textarea>
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-3">
                                    <button type="reset" class="btn btn-danger">Limpar</button>
                                    <button id="cadPF" name="cadPF" type="submit" class="btn btn-primary">Salvar</button>
                                </div>
                            </div>
                        </form> 

                        <br />

                        <form id="PJ" style="display: none;" class="form-horizontal form-label-left" method="post" action="../sources/salvaCliente.php">
                            <?php
                            $tipoPJ = new Tipo_Cliente();
                            $tipoPJDAO = new Tipo_ClienteDAO();
                            $tipoPJ = $tipoPJDAO->getByDescri("Pessoa Jurídica");
                            ?>
                            <input type="hidden" id="tipo_cliente" name="tipo_cliente" value="<?= $tipoPJ->getId() ?>" >
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cnpj">CNPJ 
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="cnpj" class="form-control col-md-7 col-xs-12" name="cnpj" type="text"  data-inputmask="'mask': '99.999.999/9999-99'">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nome">Nome Fantasia <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="3" data-validate-words="2" name="name" required="required" type="text">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="razao">Razão Social 
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="razao" class="form-control col-md-7 col-xs-12" data-validate-length-range="3" data-validate-words="2" name="razao" type="text">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tel">Telefone 
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="tel" class="form-control col-md-7 col-xs-12" data-inputmask="'mask': '(99) 9999-9999'" 
                                           name="tel" type="text">
                                </div>
                            </div>
                            <h4 class="text text-center text-success x_content">Local de Risco</h4>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cep">CEP 
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="cepPJ" name="cep" class="form-control col-md-7 col-xs-12"
                                           data-inputmask="'mask': '99.999-999'">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="rua">Endereço 
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="ruaPJ" name="rua" class="form-control col-md-7 col-xs-12" placeholder="ex.: rua A">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="num">Nº
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="num" name="num" placeholder="número do imóvel" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="complemento">Complemento
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="complemento" name="complemento" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="bairro">Bairro 
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="bairroPJ" type="text" name="bairro" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label for="cidade" class="control-label col-md-3">Cidade 
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="cidadePJ" type="text" name="cidade" class="form-control col-md-7 col-xs-12" >
                                </div>
                            </div>
                            <div class="item form-group">
                                <label for="estado" class="control-label col-md-3">Estado 
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="estadoPJ" type="text" name="estado" class="form-control col-md-7 col-xs-12" >
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="final">Finalidade Econômica 
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="final" class="form-control col-md-7 col-xs-12" name="final" type="text">
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-3">
                                    <button type="reset" class="btn btn-danger">Limpar</button>
                                    <button id="cadPJ" name="cadPJ" type="submit" class="btn btn-primary">Salvar</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- /page content -->


<?php
include 'footer.php';
