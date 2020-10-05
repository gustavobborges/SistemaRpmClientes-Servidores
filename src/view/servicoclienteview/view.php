<?php
//Conexão
include_once '../../model/db_connect.php';
//Header
include_once '../../view/includes/header.php';
// Toastr
include_once '../includes/toastr.php';

    if(isset($_GET['user'])) {
        $idusuario = $_GET['user'];
    }

    if(isset($_GET['id'])) {
        $id = mysqli_escape_string($connect, $_GET['id']);
        $sql = "SELECT  
        CLIENTE.IDCLIENTE AS IDCLIENTE,
        CLIENTE.NOME AS CLIENTENOME,
        SERVICO.NOME AS SERVICONOME,
        SERVICO.IDSERVICO AS IDSERVICO,
        SERVICOCLIENTE.IDSERVICOCLIENTE AS IDSERVICOCLIENTE,
        SERVICOCLIENTE.ESTADO AS ESTADO
        FROM  
    
        SERVICO LEFT JOIN SERVICOCLIENTE ON SERVICOCLIENTE.IDSERVICO = SERVICO.IDSERVICO
        LEFT JOIN CLIENTE ON SERVICOCLIENTE.IDCLIENTE = CLIENTE.IDCLIENTE
        
        WHERE SERVICOCLIENTE.IDSERVICOCLIENTE = '$id'";
        
        $resultado = mysqli_query($connect, $sql);
        $dados = mysqli_fetch_array($resultado);
    }

?>
<link type="text/css" rel="stylesheet" href="style.css">
<link href="https://unpkg.com/bootstrap-table@1.16.0/dist/bootstrap-table.min.css" rel="stylesheet">
<script src="https://unpkg.com/bootstrap-table@1.16.0/dist/bootstrap-table.min.js"></script>
<!-- Font Awesome -->
<link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
<!-- Ionicons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<!-- overlayScrollbars -->
<link rel="stylesheet" href="../../dist/css/adminlte.min.css">


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Serviço do Cliente:
                        <b><?php echo $dados['CLIENTENOME']?></b> | ID:
                        <b><?php echo $dados['IDSERVICOCLIENTE']?></b></h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-4">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Serviço Cliente</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form">
                            <div class="card-body">
                                <form action="../../model/dao/servicocliente/update.php" method="POST">
                                    <input type="hidden" name="idusuario" value="<?php echo $idusuario; ?>">
                                    <input type="hidden" name="idcliente" value="<?php echo $dados['IDCLIENTE']; ?>">
                                    <input type="hidden" name="id" value="<?php echo $dados['IDSERVICOCLIENTE']; ?>">

                                    <div class="form-group">
                                        <label for="nome">Cliente</label>
                                        <div class="form-control">
                                            <?php echo $dados['CLIENTENOME'];?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="sistema">Sistema</label>
                                        <div class="form-control">
                                            <?php echo $dados['SERVICONOME'];?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="sistema">Estado</label>
                                        <div class="form-control">
                                            <?php echo $dados['ESTADO'];?>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <a href="../clienteview/clienteview.php?user=<?php echo $idusuario; ?>&id=<?php echo $dados['IDCLIENTE']; ?>"
                                    class="btn btn-secondary">Voltar</a>
                                <a href="../servicocliente/edit.php?user=<?php echo $idusuario?>&id=<?php echo $dados['IDSERVICOCLIENTE']; ?>"
                                    class="btn btn-warning float-right">Editar</a>
                            </div>
                    </div>
                    <!-- /.card -->
                </div>

                <div class="col-md-8">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Servidores</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-condensed table-hover table-striped " id="table"
                                data-toggle="table" data-sort-name="name" data-sort-order-desc="desc">
                                <thead>
                                    <tr>
                                        <th scope="col" data-field="sistema" data-sortable="true">Nome</th>
                                        <th scope="col" data-field="estado" data-sortable="true">Acesso</th>
                                        <th>-</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                        $sql = "SELECT * FROM SERVIDOR 
                        WHERE IDSERVICOCLIENTE = '$id'";
                        $res = mysqli_query($connect, $sql);
                        if(mysqli_num_rows($res) > 0):       
                        while($dadoss = mysqli_fetch_array($res)):       
                        ?>
                                    <td><?php echo $dadoss['NOME']; ?></td>
                                    <td><?php echo $dadoss['ACESSO']; ?></td>
                                    <td><a href="../servidor/view.php?user=<?php echo $idusuario?>&idservicocliente=<?php echo $dadoss['IDCLIENTE'] ?>&id=<?php echo $dadoss['IDSERVIDOR']; ?>"
                                            class="btn btn-primary"><img src="/../assets/ver.svg"></a>

                                        <a href="../servidor/edit.php?user=<?php echo $idusuario?>&idservicocliente=<?php echo $dadoss['IDCLIENTE'] ?>&id=<?php echo $dadoss['IDSERVIDOR']; ?>"
                                            class="btn btn-warning"><img src="/../assets/edit.svg"></a>

                                        <button type="button" class="btn btn-primary btn btn-danger" data-toggle="modal"
                                            data-target="#modal<?php echo $dadoss['IDSERVIDOR'] ?>"><img
                                                src="/../assets/delete.svg"></button></td>

                                    <!-- Botão para acionar modal -->
                                    <!-- Modal BOOTSTRAP-->
                                    <!-- Criação do modal -->
                                    <div class="modal fade" id="modal<?php echo $dadoss['IDSERVIDOR'] ?>" tabindex="-1"
                                        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalDelete">Excluir</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Fechar">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Tem certeza que deseja excluir este Servidor?
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="../../model/dao/servidor/delete.php" method="POST">
                                                        <input type="hidden" name="id"
                                                            value="<?php echo $dadoss['IDSERVIDOR']; ?>">
                                                        <input type="hidden" name="idusuario"
                                                            value="<?php echo $idusuario; ?>">
                                                        <input type="hidden" name="idservicocliente"
                                                            value="<?php echo $id; ?>">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Fechar</button>

                                                        <button type="submit" class="btn btn-primary"
                                                            name="btn-deletar-servidor">Excluir</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </tr>
                                    </tfoot>
                                    <?php
                endwhile;
                endif; ?>
                            </table>
                        </div>
                        <div class="card-footer">

                        <a href="../servidor/new.php?user=<?php echo $idusuario; ?>&id=<?php echo $dados['IDSERVICOCLIENTE'] ?>"
                            class="btn btn-success botaop" max-width: 200px;>Novo
                            Servidor &nbsp; <img src="/../assets/add.svg"></a><br>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
    </section>
    <!-- /.content -->
</div>

</div>
</div>

<!-- /.tab-pane -->
</div>
</aside>


</div>



<!-- jQuery 3 -->
<script src="../../bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="../../bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../../bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="../../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../../bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<!-- page script -->

<?php
//Footer
include_once '../../view/includes/footer.php';
?>