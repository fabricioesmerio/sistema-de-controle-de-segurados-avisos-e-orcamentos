<?php
require_once '../class/Cliente.php';

require_once 'header.php';
require_once 'sidebar.php';
require_once 'navigation.php';
require_once '../DAO/EnderecoDAO.php';
require_once '../class/Endereco.php';

if (isset($_SESSION['cliente'])) {
    $id = unserialize($_SESSION['cliente'])->getId();
}
$enderecoDAO = new EnderecoDAO();
$endereco = $enderecoDAO->getByCliente($id);
?>
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Cadastro de Edição de Clientes</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">

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
                        <?php
                        if (unserialize($_SESSION['cliente'])->getTipoCliente() == 1) {
                            ?>
                            <form class="form-horizontal form-label-left" method="post" action="../sources/salvaCliente.php" >

                                <div class="item form-group">
                                    <input type="hidden" value="<?= unserialize($_SESSION['cliente'])->getId(); ?>" name="id_cliente" id="id_cliente">
                                    <input type="hidden" value="<?= unserialize($_SESSION['cliente'])->getTipoCliente(); ?>" name="tipo_cliente" id="tipo_cliente">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nome <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" 
                                               data-validate-words="2" name="name" required="required" type="text"
                                               value="<?= utf8_encode(unserialize($_SESSION['cliente'])->getNome()); ?>">
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cpf">CPF 
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="cpf" name="cpf" class="form-control col-md-7 col-xs-12"
                                               data-inputmask="'mask': '999.999.999-99' 
                                               "value="<?= unserialize($_SESSION['cliente'])->getCpf(); ?>">
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cnh">CNH 
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="cnh" name="cnh" class="form-control col-md-7 col-xs-12" 
                                               value="<?= unserialize($_SESSION['cliente'])->getCnh(); ?>">
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cel">Celular 
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="cel" name="cel" class="form-control col-md-7 col-xs-12"
                                               data-inputmask="'mask': '(99) 99999-9999'" 
                                               value="<?= unserialize($_SESSION['cliente'])->getCelular(); ?>">
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="dtNasc">Data Nascimento </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="dtNasc" name="dtNasc" class="form-control col-md-7 col-xs-12"
                                               data-inputmask="'mask': '99/99/9999'" 
                                               value="<?= (unserialize($_SESSION['cliente'])->getDataNasc() != NULL) ? date("d/m/Y", strtotime(unserialize($_SESSION['cliente'])->getDataNasc())) : "" ?>">
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="sexo">Sexo 
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div id="sexo" class="btn-group" data-toggle="buttons">
                                            <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-primary">
                                                <input type="radio" name="sexo" value="M" 
                                                <?php
                                                if (unserialize($_SESSION['cliente'])->getSexo() == "M"):
                                                    echo 'checked';
                                                endif;
                                                ?> > &nbsp; Masculino &nbsp;
                                            </label>
                                            <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-primary">
                                                <input type="radio" name="sexo" value="F" 
                                                <?php
                                                if (unserialize($_SESSION['cliente'])->getSexo() == "F"):
                                                    echo 'checked';
                                                endif;
                                                ?>> &nbsp; Feminino &nbsp;
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Estado Civil</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select class="form-control" tabindex="-1" name="estCivil" id="estCivil">
                                            <option value=""> ----  Selecione um opção ----</option>
                                            <option value="Solteiro(a)" <?= (unserialize($_SESSION['cliente'])->getEstadoCivil() == "Solteiro(a)") ? "selected" : "" ?> >Solteiro(a)</option>
                                            <option value="União Estável" <?= (unserialize($_SESSION['cliente'])->getEstadoCivil()) == "União Estável" ? "selected" : "" ?> >União Estável</option>
                                            <option value="Casado(a)" <?= (unserialize($_SESSION['cliente'])->getEstadoCivil()) == "Casado(a)" ? "selected" : "" ?> >Casado(a)</option>
                                            <option value="Divorciado(a)" <?= (unserialize($_SESSION['cliente'])->getEstadoCivil() == "Divorciado(a)") ? "selected" : "" ?> >Divorciado(a)</option>
                                            <option value="Separado(a)" <?= (unserialize($_SESSION['cliente'])->getEstadoCivil()) == "Separado(a)" ? "selected" : "" ?> >Separado(a)</option>
                                            <option value="Viúvo(a)" <?= (unserialize($_SESSION['cliente'])->getEstadoCivil()) == "Viúvo(a)" ? "selected" : "" ?> >Viúvo(a)</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="obs">Observações </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea id="obs" name="obs" class="form-control col-md-7 col-xs-12"><?= unserialize($_SESSION['cliente'])->getObs() ?></textarea>
                                    </div>
                                </div>
                                <?php
                                if ($endereco == NULL) {
                                    $endereco = new Endereco();
                                }
                                ?>
                                <div class="title">
                                    <h2 class="text text-center">Endereço</h2>
                                </div>
                                <div class="item form-group">
                                    <input type="hidden" value="<?= $endereco->getId() ?>" name="id_endereco">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cep">CEP Residência 
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="cep" name="cep" class="form-control col-md-7 col-xs-12"
                                               data-inputmask="'mask': '99.999-999'"
                                               value="<?= $endereco->getCep() ?>">
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="rua">Endereço Residência 
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="rua" name="rua" class="form-control col-md-7 col-xs-12" 
                                               placeholder="ex.: rua A" value="<?= $endereco->getRua() ?>">
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="num">Nº
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="num" name="num" placeholder="número do imóvel" 
                                               class="form-control col-md-7 col-xs-12" value="<?= $endereco->getNumero() ?>">
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="complemento">Complemento
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="complemento" name="complemento" 
                                               class="form-control col-md-7 col-xs-12" value="<?= $endereco->getComplemento() ?>">
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="bairro">Bairro 
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="bairro" type="text" name="bairro" 
                                               class="form-control col-md-7 col-xs-12" value="<?= $endereco->getBairro() ?>">
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label for="cidade" class="control-label col-md-3">Cidade Residência 
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="cidade" type="text" name="cidade" class="form-control col-md-7 col-xs-12" 
                                               value="<?= $endereco->getCidade() ?>">
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label for="estado" class="control-label col-md-3">Estado 
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="estado" type="text" name="estado" class="form-control col-md-7 col-xs-12" 
                                               value="<?= $endereco->getEstado() ?>">
                                    </div>
                                </div>

                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <a href="javascript:history.back()" class="btn btn-dark">Voltar à Lista</a>
                                        <button id="cadPF" name="cadPF" type="submit" class="btn btn-primary">Salvar</button>
                                    </div>
                                </div>
                            </form> 

                            <?php
                        } elseif (unserialize($_SESSION['cliente'])->getTipoCliente() == 2) {
                            ?>
                            <form class="form-horizontal form-label-left" method="post" action="../sources/salvaCliente.php">
                                <div class="item form-group">
                                    <input type="hidden" name="id_cliente" value="<?= unserialize($_SESSION['cliente'])->getId(); ?>" >
                                    <input type="hidden" value="<?= unserialize($_SESSION['cliente'])->getTipoCliente(); ?>" name="tipo_cliente" id="tipo_cliente">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nome">Nome Fantasia <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="3" 
                                               data-validate-words="2" name="name" required="required" type="text"
                                               value="<?= (unserialize($_SESSION['cliente'])->getNome()); ?>">
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="razao">Razão Social 
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="razao" class="form-control col-md-7 col-xs-12" data-validate-length-range="3" 
                                               data-validate-words="2" name="razao" type="text"
                                               value="<?= (unserialize($_SESSION['cliente'])->getRazao()); ?>">
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cnpj">CNPJ 
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="cnpj" class="form-control col-md-7 col-xs-12" name="cnpj" type="text" 
                                               data-inputmask="'mask': '99.999.999/9999-99'" value="<?= unserialize($_SESSION['cliente'])->getCnpj(); ?>">
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tel">Telefone 
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="tel" class="form-control col-md-7 col-xs-12" 
                                               data-inputmask="'mask': '(99) 9999-9999'" name="tel" type="text"
                                               value="<?= unserialize($_SESSION['cliente'])->getTelefone(); ?>">
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="final">Finalidade Econômica 
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="final" class="form-control col-md-7 col-xs-12" name="final" type="text" 
                                               value="<?= (unserialize($_SESSION['cliente'])->getFinalidadeEco()); ?>">
                                    </div>
                                </div>
                                <?php
                                if ($endereco == NULL) {
                                    $endereco = new Endereco();
                                }
                                ?>
                                <h4 class="text text-center text-success x_content">Local de Risco</h4>
                                <div class="item form-group">

                                    <input type="hidden" name="id_endereco" value="<?= $endereco->getId() ?>" >
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cep">CEP 
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="cep" class="form-control col-md-7 col-xs-12" data-validate-words="2" 
                                               name="cep" type="text" data-inputmask="'mask': '99999-999'"
                                               value="<?= $endereco->getCep(); ?>">
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="endereco">Endereço 
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="rua" class="form-control col-md-7 col-xs-12" name="rua" type="text"
                                               value="<?= ($endereco->getRua()); ?>">
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="num">Nº 
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="num" class="form-control col-md-7 col-xs-12" name="num" type="text"
                                               value="<?= $endereco->getNumero(); ?>">
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="compl">Complemento 
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="complemento" class="form-control col-md-7 col-xs-12" name="complemento" 
                                               type="text" value="<?= ($endereco->getComplemento()); ?>">
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="bairro">Bairro 
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="bairro" class="form-control col-md-7 col-xs-12" name="bairro" 
                                               type="text" value="<?= ($endereco->getBairro()); ?>">
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cidade">Cidade 
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="cidade" class="form-control col-md-7 col-xs-12" 
                                               data-validate-length-range="4" data-validate-words="2" 
                                               name="cidade" type="text" value="<?= ($endereco->getCidade()); ?>">
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="estado">Estado 
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="estado" class="form-control col-md-7 col-xs-12" name="estado" 
                                               type="text" value="<?= ($endereco->getEstado()); ?>">
                                    </div>
                                </div>


                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <a href="javascript:history.back()" class="btn btn-dark">Voltar à Lista</a>
                                        <button id="cadPJ" name="cadPJ" type="submit" class="btn btn-primary">Salvar</button>
                                    </div>
                                </div>
                            </form>
    <?php
} else {
    header("Location: listasClientes.php");
    die();
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
require_once '../production/footer.php';
