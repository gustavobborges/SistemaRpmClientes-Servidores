<?php
//Conexão
include_once '../../model/db_connect.php';
//Header
include_once '../../view/includes/header.php';
// Message
include_once '../includes/message.php';
// Toastr
include_once '../includes/toastr.php';

if(isset($_GET['user'])) {
        $idusuario = $_GET['user'];
    }
include_once 'cards.php';
?>

<link type="text/css" rel="stylesheet" href="style.css">
<link href="https://unpkg.com/bootstrap-table@1.16.0/dist/bootstrap-table.min.css" rel="stylesheet">
<script src="https://unpkg.com/bootstrap-table@1.16.0/dist/bootstrap-table.min.js"></script>
<!-- Toastr -->
<link rel="stylesheet" href="../../../plugins/toastr/toastr.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="../../../dist/css/adminlte.min.css">

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-gray">
                    <div class="card-header">
                        <div class="card-title" style="font-size: 1.5rem;">Clientes</div>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                                title="Collapse">
                                <i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-bordered table-condensed table-hover table-striped " id="table"
                            data-toggle="table" data-sort-name="name" data-sort-order-desc="desc">
                            <thead>
                                <tr>
                                    <th scope="col" data-field="nome" data-sortable="true">Nome</th>
                                    <th scope="col" data-field="estado" data-sortable="true">Estado</th>
                                    <th>-</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $sql = "SELECT * FROM CLIENTE";
                                    $resultado = mysqli_query($connect, $sql);
                                    if(mysqli_num_rows($resultado) > 0):
                                    while($dados = mysqli_fetch_array($resultado)):                  
                                ?>
                                <tr>
                                    <td><?php echo $dados['NOME']; ?></td>
                                    <td><?php echo $dados['ESTADO']; ?></td>
                                    <td><a href="../clienteview/clienteview.php?user=<?php echo $idusuario; ?>&id=<?php echo $dados['IDCLIENTE']; ?>"
                                            class="btn btn-primary"><img src="/../assets/ver.svg"></a>

                                        <a href="../cliente/edit.php?user=<?php echo $idusuario?>&id=<?php echo $dados['IDCLIENTE']; ?>"
                                            class="btn btn-warning"><img src="/../assets/edit.svg"></a>

                                        <button type="button" class="btn btn-primary btn btn-danger" data-toggle="modal"
                                            data-target="#modal<?php echo $dados['IDCLIENTE'] ?>"><img
                                                src="/../assets/delete.svg"></button></td>

                                    <!-- Botão para acionar modal -->
                                    <!-- Modal BOOTSTRAP-->
                                    <!-- Criação do modal -->
                                    <div class="modal fade" id="modal<?php echo $dados['IDCLIENTE'] ?>" tabindex="-1"
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
                                                    Tem certeza que deseja excluir este Cliente?
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="../../model/dao/cliente/delete.php" method="POST">
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
                                    <?php
                endwhile;
                endif; ?>
                                </tr>
                            </tbody>

                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
                <div class="col-xs-12 botaoo">
                    <a href="../cliente/new.php?user=<?php echo $idusuario ?>" class="btn btn-success botaop">Novo
                        Cliente &nbsp; <img src="/../assets/add.svg"></a>
                </div>
            </div>
            <!-- /.col -->

        <!-- /.row -->
        <!-- /.content -->
    </div>
    </div>
    </div>
    <!-- /.tab-pane -->
    </div>
    </aside>
    <!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
    </div>
    <!-- ./wrapper -->



    <?php
//Footer
include_once '../../view/includes/footer.php';
?>