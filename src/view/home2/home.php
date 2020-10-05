<?php
//Conexão
include_once '../../model/db_connect.php';
//Header
include_once '../../view/includes/header.php';

if(isset($_GET['user'])) {
        $idusuario = $_GET['user'];
    }
include_once 'cards.php';
?>

<!-- Font Awesome -->
<link rel="stylesheet" href="../../../plugins/fontawesome-free/css/all.min.css">
<!-- Ionicons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<!-- DataTables -->
<link rel="stylesheet" href="../../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="../../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">


<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Content Wrapper. Contains page content -->
        <!-- Content Header (Page header) -->
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-gray">
                            <div class="card-header">
                                <div class="card-title" style="font-size: 2rem;">Clientes</div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Nome</th>
                                            <th>Estado</th>
                                            <th>-</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = "SELECT * FROM CLIENTE";
                                        $resultado = mysqli_query($connect, $sql);
                                        if(mysqli_num_rows($resultado) > 0):
                                        while($dados = mysqli_fetch_array($resultado)): 

                                        $nome = $dados['NOME'];
                                        $estado = $dados['ESTADO'];
                                        $vazio = "-";
                                        ?>
                                        <tr>
                                            <td>
                                                <?php echo $nome; ?>
                                            </td>
                                            <td>
                                                <?php echo $estado; ?>
                                            </td>
 
                                            <td><a href="../clienteview/clienteview.php?user=<?php echo $idusuario; ?>&id=<?php echo $dados['IDCLIENTE']; ?>"
                                                    class="btn btn-primary"><img src="/../assets/ver.svg"></a>

                                                <a href="../cliente/edit.php?user=<?php echo $idusuario?>&id=<?php echo $dados['IDCLIENTE']; ?>"
                                                    class="btn btn-warning"><img src="/../assets/edit.svg"></a>

                                                <button type="button" class="btn btn-primary btn btn-danger"
                                                    data-toggle="modal"
                                                    data-target="#modal<?php echo $dados['IDCLIENTE'] ?>"><img
                                                        src="/../assets/delete.svg"></button></td>

                                            <!-- Botão para acionar modal -->
                                            <!-- Modal BOOTSTRAP-->
                                            <!-- Criação do modal -->
                                            <div class="modal fade" id="modal<?php echo $dados['IDCLIENTE'] ?>"
                                                tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                aria-hidden="true">
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
                                                            Tem certeza que deseja excluir este Cliente?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <form action="../../model/dao/cliente/delete.php"
                                                                method="POST">
                                                                <input type="hidden" name="idusuario"
                                                                    value="<?php echo $idusuario ?>">
                                                                <input type="hidden" name="id"
                                                                    value="<?php echo $dados['IDCLIENTE']; ?>">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Fechar</button>

                                                                <button type="submit" class="btn btn-primary"
                                                                    name="btn-deletar-cliente">Excluir</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </tr>
                                    </tbody>
                                    <?php
                endwhile;
                endif; ?>
                                    <tfoot>
                                        <tr>
                                            <th>Nome</th>
                                            <th>Estado</th>
                                            <th>-</th>
                                        </tr>
                                    </tfoot>
                                </table>
                                <div class="col-xs-12">
                            <a href="../cliente/new.php?user=<?php echo $idusuario ?>" class="btn btn-success botaop"
                                style="margin-top: 15px;">Novo Cliente &nbsp; <img src="/../assets/add.svg"></a>
                        </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="../../../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables -->
    <script src="../../../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../../dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../../../dist/js/demo.js"></script>
    <!-- page script -->
    <script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "autoWidth": false,
            
        });
    });
    </script>

    <?php
