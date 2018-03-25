<?php
require_once '../class/Cliente.php';

require_once 'header.php';
require_once 'sidebar.php';
require_once 'navigation.php';
require_once '../DAO/EnderecoDAO.php';
require_once '../class/Endereco.php';

$id = unserialize($_SESSION['cliente'])->getId();

$enderecoDAO = new EnderecoDAO();
$endereco = $enderecoDAO->getByCliente($id);
?>
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <a href="javascript:history.back()" class="btn btn-default" >Voltar</a>
        <div class="page-title">
            <div class="title_left">
                <h3>Detalhes do Cliente</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2><?= unserialize($_SESSION['cliente'])->getNome() ?></h2>

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                        <?php if (unserialize($_SESSION['cliente'])->getTipoCliente() == 1) { ?>
                            <ul>
                                <li><strong>CPF:</strong> <?= unserialize($_SESSION['cliente'])->getCpf() ?></li>
                                <li><strong>CNH:</strong> <?= unserialize($_SESSION['cliente'])->getCnh() ?></li>
                                <li><strong>Estado Civil:</strong> <?= unserialize($_SESSION['cliente'])->getEstadoCivil() ?></li>
                                <li><strong>Sexo:</strong> <?= unserialize($_SESSION['cliente'])->getSexo() ?></li>
                                <li><strong>Celular:</strong> <?= unserialize($_SESSION['cliente'])->getCelular() ?></li>
                                <li><strong>Data de Nascimento: </strong><?php
                                    $dataNasc = unserialize($_SESSION['cliente'])->getDataNasc();
                                    if (unserialize($_SESSION['cliente'])->getDataNasc() == null) {
                                        echo 'Data de Nascimento não informada.';
                                    } else {
                                        echo date('d/m/Y', strtotime(unserialize($_SESSION['cliente'])->getDataNasc()));
                                    }
                                    ?></li>
                                <li><strong>Observação:</strong> <?= unserialize($_SESSION['cliente'])->getObs() ?></li>
                            </ul>
                        <?php } elseif (unserialize($_SESSION['cliente'])->getTipoCliente() == 2) {
                            ?>
                            <ul>
                                <li><strong>Razão Social:</strong> <?= unserialize($_SESSION['cliente'])->getRazao() ?></li>
                                <li><strong>CNPJ:</strong> <?= unserialize($_SESSION['cliente'])->getCnpj() ?></li>
                                <li><strong>Telefone:</strong> <?= unserialize($_SESSION['cliente'])->getTelefone() ?></li>
                                <li><strong>Finalidade Econômica:</strong> <?= unserialize($_SESSION['cliente'])->getFinalidadeEco() ?></li>
                            </ul>
                            <?php
                        } else {
                            header("Location: ../production/index.php");
                            die();
                        }
                        ?>
                        <div class="panel panel-default">
                            <!-- Default panel contents -->
                            <div class="panel-heading"><strong>Endereço</strong></div>
                            <?php
                            if ($endereco == NULL) {
                                echo 'Nenhum endereço cadastrado!';
                            } else {
                                if (is_array($endereco)) {
                                    foreach ($endereco as $end):
                                        ?>
                                        <!-- List group -->
                                        <ul class="list-group">
                                            <li class="list-group-item"><strong>Endereço:</strong> <?= stripcslashes($end->getRua()) ?></li>
                                            <li class="list-group-item"><strong>Número:</strong> <?= $end->getNumero() ?></li>
                                            <li class="list-group-item"><strong>Complemento:</strong> <?= $end->getComplemento() ?></li>
                                            <li class="list-group-item"><strong>CEP:</strong> <?= $end->getCep() ?></li>
                                            <li class="list-group-item"><strong>Bairro:</strong> <?= $end->getBairro() ?></li>
                                            <li class="list-group-item"><strong>Cidade:</strong> <?= ($end->getCidade()) ?></li>
                                            <li class="list-group-item"><strong>Estado:</strong> <?= ($end->getEstado()) ?></li>
                                        </ul>
                                        <?php
                                    endforeach;
                                } else { ?>
                                    <ul class="list-group">
                                            <li class="list-group-item"><strong>Endereço:</strong> <?= stripcslashes($endereco->getRua()) ?></li>
                                            <li class="list-group-item"><strong>Número:</strong> <?= $endereco->getNumero() ?></li>
                                            <li class="list-group-item"><strong>Complemento:</strong> <?= $endereco->getComplemento() ?></li>
                                            <li class="list-group-item"><strong>CEP:</strong> <?= $endereco->getCep() ?></li>
                                            <li class="list-group-item"><strong>Bairro:</strong> <?= $endereco->getBairro() ?></li>
                                            <li class="list-group-item"><strong>Cidade:</strong> <?= ($endereco->getCidade()) ?></li>
                                            <li class="list-group-item"><strong>Estado:</strong> <?= ($endereco->getEstado()) ?></li>
                                        </ul>
                                <?php
                                
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
require_once '../production/footer.php';
