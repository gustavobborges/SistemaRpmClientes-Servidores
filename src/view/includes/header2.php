<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Sistema iBridge</title>

    <link type="text/css" rel="stylesheet" href="../../../global.css">

    <link rel="stylesheet" href="../../../plugins/fontawesome-free/css/all.min.css">

    <link rel="stylesheet" href="../../../bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="../../../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="../../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="../../../plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../../dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="../../../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="../../../plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="../../../plugins/summernote/summernote-bs4.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

</head>

<?php
            if(isset($_GET['user'])) {
            $idusuario = $_GET['user'];
        }
            $sql = "SELECT * FROM USUARIO WHERE IDUSUARIO = '$idusuario'";
            $resultado = mysqli_query($connect, $sql);
            $dados = mysqli_fetch_array($resultado);
        ?>

<body class="hold-transition sidebar-mini layout-fixed">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars">
                    </i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="../home/home.php?user=<?php echo $dados['IDUSUARIO']; ?>" class="nav-link">Home</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="../home2/home.php?user=<?php echo $dados['IDUSUARIO']; ?>" class="nav-link">Home2</a>
            </li>
        </ul>

        <!-- Right navbar links -->

        <ul class="navbar-nav ml-auto">
            <script type="text/javascript" rel="stylesheet" src="../../../js/jquery.js"></script>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="" data-toggle="dropdown"
                    id="navDrop"><?php echo $dados ['NOME']?></a>
                <div class="dropdown-menu">
                    <a href="../../../logout.php" class="dropdown-item">Sair</a>
                </div>
            </li>
        </ul>

    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="../home/home.php?user=<?php echo $dados['IDUSUARIO']; ?>" class="brand-link logo-switch logoa">
            <img class="logo" src="../../../img/logo" alt="logo_ibridge">
        </a>


        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->

            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="info">
                    <a href="#" class="d-block">Bem Vindo(a), &nbsp <?php echo $dados['NOME'] ?>!</a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                    <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->


                    <li class="nav-item">
                        <a href="../home/home.php?user=<?php echo $dados['IDUSUARIO']; ?>" class="nav-link">
                            <i class="nav-icon fa fa-fw fa-users" aria-hidden="true"></i>
                            <p>
                                Clientes
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="../contato/clistatodos.php?user=<?php echo $dados['IDUSUARIO']; ?>" class="nav-link">
                            <i class="nav-icon far fa-smile-o"></i>
                            <p>
                                Contatos
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="../servico/sistemalista.php?user=<?php echo $dados['IDUSUARIO']; ?>" class="nav-link">
                            <i class="nav-icon fa fa-fw fa-gears"></i>
                            <p>
                                Sistemas
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="../servidor/servidortodos.php?user=<?php echo $dados['IDUSUARIO']; ?>"
                            class="nav-link">
                            <i class="nav-icon fa fa-fw fa-cloud"></i>
                            <p>
                                Servidores
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon far fa-user"></i>
                            <p>
                                Gerenciar Usuários
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="../tipousuario/tipousuariolista.php?user=<?php echo $dados ['IDUSUARIO'] ?>"
                                    class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Tipos de Usuários</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="../usuario/usuariolista.php?user=<?php echo $dados ['IDUSUARIO'] ?>"
                                    class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Usuários</p>
                                </a>
                            </li>
                        </ul>
                    </li>

            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>