<?php
require_once '../DAO/BemDAO.php';
require_once '../class/Bem.php';
?>
<html lang="pt-br">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">

        <!-- Bootstrap -->
        <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <!-- NProgress -->
        <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
        <!-- jQuery custom content scroller -->
        <link href="../vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css" rel="stylesheet"/>

        <!-- Custom Theme Style -->
        <link href="../build/css/custom.min.css" rel="stylesheet">
        <link href="../build/css/bootstrap-datepicker.css" rel="stylesheet" type="text/css"/>
        <!-- DATATABLE CSS-->
        <link href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css"/>


        <!-- Adicionando JQuery -->

        <link href="../build/js/jquery-ui.min.css" rel="stylesheet" type="text/css"/>
        <!-- jQuery -->

        <!-- JS DO DATATABLE-->


    </head>
    <body style="background: #fff !important; padding: 15px;">
        <?php
        $idCliente = $_GET['cliente'];

        $bem = new Bem();
        $bemDAO = new BemDAO();
        if (!$bem = $bemDAO->getAll($idCliente)) {
            echo 'Nada registrado!';
        } else {
            if (is_array($bem)) {
                foreach ($bem as $b){
                    echo $b->getMarca().'<br />';
                    echo $b->getModelo().'<br />';
                    echo $b->getChassi().'<br />';
                    echo $b->getCepPernoite().'<br />';
                }
            } else {
                echo $bem->getMarca().'<br />';
                echo $bem->getModelo().'<br />';
                echo $bem->getChassi().'<br />';
                echo $bem->getCidadePernoite().'<br />';
            }
        }

        // echo '<pre>';
        // print_r($bem);
        //echo '</pre>';
        ?>

        <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
        <script src="../vendors/jquery/dist/jquery.min.js"></script>
        <script src="../build/js/jquery-ui.min.js" type="text/javascript"></script>
        <script src="../build/js/js.js" type="text/javascript"></script>
    </body>
</html>