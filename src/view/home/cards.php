<?php 
if(isset($_GET['user'])) {
    $idusuario = $_GET['user'];
}
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-12">

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?php 
                                $sql = "SELECT COUNT(IDSERVICO) AS TOTALSERVICOS FROM SERVICO ";
                                $resultado = mysqli_query($connect, $sql);
                                $dados = mysqli_fetch_array($resultado);
                                echo $dados['TOTALSERVICOS']; ?></h3>

                            <p>Serviços</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                        <h3><?php 
                                $sql = "SELECT COUNT(IDSERVIDOR) AS TOTALSERVIDORES FROM SERVIDOR ";
                                $resultado = mysqli_query($connect, $sql);
                                $dados = mysqli_fetch_array($resultado);
                                echo $dados['TOTALSERVIDORES']; ?></h3>

                            <p>Servidores</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                        <h3><?php 
                                $sql = "SELECT COUNT(IDACESSO) AS TOTALACESSOS FROM ACESSO ";
                                $resultado = mysqli_query($connect, $sql);
                                $dados = mysqli_fetch_array($resultado);
                                echo $dados['TOTALACESSOS']; ?></h3>

                            <p>Acessos</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                    </div>
                </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                            <h3><?php 
                                $sql = "SELECT COUNT(IDCONTATO) AS TOTALCONTATO FROM CONTATO ";
                                $resultado = mysqli_query($connect, $sql);
                                $dados = mysqli_fetch_array($resultado);
                                echo $dados['TOTALCONTATO']; ?></h3>

                                <p>Contatos</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                    </div>
                </div>
                </div>
                <!-- ./col -->
            </div>
        </div>
    
