<!-- sidebar menu -->
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <h3 class="text-center">Menu</h3>
        <ul class="nav side-menu">
            <li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="index.php">Página Inicial</a></li>
                </ul>
            </li>
            <li><a><i class="fa fa-edit"></i> Cadastros <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="../production/cadCliente.php">Cadastrar Cliente</a></li>
                    <li><a href="listasClientes.php?param=b">Cadastrar Bem</a></li>
                    <li><a href="listasClientes.php?param=s">Cadastrar Seguro</a></li>
                    <li><a href="cadAviso.php">Cadastrar Aviso</a></li>
                    <li><a href="listasClientes.php?view=orc">Cadastrar Orçamento</a></li>
                </ul>
            </li>
            <li><a><i class="fa fa-search"></i> Pesquisar <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="../production/listaSeguros.php">Pesquisar Seguros</a></li>
                    <li><a href="listarAvisos.php?view=all">Todos Avisos</a></li>
                    <li><a href="listarOrcamentos.php?view=all">Todos Orçamentos</a></li>
                </ul>
            </li>
            <li><a><i class="fa fa-list"></i>Listas <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="../production/listasClientes.php">Listar Clientes</a></li>
                    <li><a href="listarAvisos.php?view=open">Avisos em Aberto</a></li>
                    <li><a href="listarOrcamentos.php?view=open">Orçamentos em Aberto</a></li>
                </ul>
            </li>
            <?php if ($_SESSION['nivel_acesso'] == 1) { ?>
                <li><a><i class="fa fa-cogs"></i>Configurações <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="cadEmpresa.php">Empresa</a></li>
                        <li><a href="cadUsuario.php">Usuários</a></li>
                    </ul>
                </li>
                <?php
            }
            ?>
        </ul>
    </div>
</div>
<!-- /sidebar menu -->


<!-- /menu footer buttons -->
</div>
</div>