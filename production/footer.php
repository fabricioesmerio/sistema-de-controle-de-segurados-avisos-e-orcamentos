<!-- Janela Modal de aviso necessidade cadastrar Empresa -->
<!-- Modal -->
<div class="modal fade" id="avisoEmpresa" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                
                <h4 class="modal-title" id="myModalLabel">Atenção</h4>
            </div>
            <div class="modal-body">
                <p>Antes de Prosseguir, você deve cadastrar a sua Empresa no sistema!</p> 
            </div>
            <div class="modal-footer">
                <a href="cadEmpresa.php"><button type="button" class="btn btn-primary">Ir -> Cadastro Empresa</button></a>
            </div>
        </div>
    </div>
</div>
<!-- FIM Janela Modal de aviso necessidade cadastrar Empresa -->
<?php
require_once '../DAO/EmpresaDAO.php';
require_once '../class/Empresa.php';
$empre = new Empresa();
$empreDAO = new EmpresaDAO();
$empre = $empreDAO->getEmpresa();
if (($empre == NULL || $empre == '') && ($paginaAtual != 'cadEmpresa.php')) {
    ?>
    <script>
        $(document).ready(function () {
            $('#avisoEmpresa').modal('show');
        });
    </script>
<?php }
?>
<!-- footer content -->
<footer>
    <div class="pull-right">
        Sistema de Controle de Segurados &copy <?= date("Y"); ?> - Desenvolvido por <a href="#">Fabrício Esmério</a>
    </div>
    <div class="clearfix"></div>
</footer>
<!-- /footer content -->
</div>
</div>

<!-- jQuery -->
<!-- Meu JavaScript-->
<script src="../build/js/js.js" type="text/javascript"></script>
<script src="../vendors/jquery/dist/jquery.min.js"></script>
<script src="../build/js/jquery-ui.min.js" type="text/javascript"></script>
<!-- JS DO DATATABLE-->
<script src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<!-- Bootstrap -->
<script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- jquery.inputmask -->
<script src="../vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>

<!-- jQuery custom content scroller -->
<script src="../vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>

<!-- Custom Theme Scripts -->
<script src="../build/js/custom.min.js"></script>

</body>
</html>