<?php
//Conexão
include_once '../../model/db_connect.php';
//Header
include_once '../../view/includes/header.php';
// Toastr
include_once '../includes/toastr.php';


if(isset($_GET['user'])) {
        $idusuario = $_GET['user'];
        $sql = "SELECT * FROM TIPOUSUARIO";
        $resultado = mysqli_query($connect, $sql);
    }
?>

<link type="text/css" rel="stylesheet" href="style.css">
<link href="https://unpkg.com/bootstrap-table@1.16.0/dist/bootstrap-table.min.css" rel="stylesheet">
<script src="https://unpkg.com/bootstrap-table@1.16.0/dist/bootstrap-table.min.js"></script>

<!-- Bootstrap 3.3.7 -->
<link rel="stylesheet" href="../../bower_components/bootstrap/dist/css/bootstrap.min.css">
<!-- Font Awesome -->
<link rel="stylesheet" href="../../bower_components/font-awesome/css/font-awesome.min.css">
<!-- Ionicons -->
<link rel="stylesheet" href="../../bower_components/Ionicons/css/ionicons.min.css">
<!-- DataTables -->
<link rel="stylesheet" href="../../bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">
<!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
<link rel="stylesheet" href="../../dist/css/skins/_all-skins.min.css">


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
        <div class="row">
            <div class="col-12">
                <div class="card card-gray">
                    <div class="card-header">
                        <div class="card-title" style="font-size: 1.5rem;">Tipos de Usuários</div>
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
                                <th>-</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                        
                        if(mysqli_num_rows($resultado) > 0):
                        while($dados = mysqli_fetch_array($resultado)):                  
                        ?>
                            <tr>
                                <td><?php echo $dados['NOME']; ?></td>
                                <td>
                                    <a href="edit.php?user=<?php echo $idusuario?>&id=<?php echo $dados['IDTIPOUSUARIO']; ?>"
                                        class="btn btn-warning"><img src="/../assets/edit.svg"></a>

                                    <button type="button" class="btn btn-primary btn btn-danger" data-toggle="modal"
                                        data-target="#modal<?php echo $dados['IDTIPOUSUARIO'] ?>"><img
                                            src="/../assets/delete.svg"></button></td>

                                <!-- Botão para acionar modal -->
                                <!-- Modal BOOTSTRAP-->
                                <!-- Criação do modal -->
                                <div class="modal fade" id="modal<?php echo $dados['IDTIPOUSUARIO'] ?>" tabindex="-1"
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
                                                <form action="../../model/dao/tipousuario/delete.php" method="POST">
                                                    <input type="hidden" name="id"
                                                        value="<?php echo $dados['IDTIPOUSUARIO']; ?>">
                                                    <input type="hidden" name="idusuario"
                                                        value="<?php echo $idusuario; ?>">

                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Fechar</button>

                                                    <button type="submit" class="btn btn-primary"
                                                        name="btn-deletar-tipousuario">Excluir</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </tr>
                            <?php
                endwhile;
            endif; ?>
                        </tbody>
                    </table>

                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
            <a href="new.php?user=<?php echo $idusuario ?>" class="btn btn-success botaop"
                        style="margin-top: 15px;">Novo tipo de Usuário &nbsp;<img src="/../assets/add.svg"></a>
        </div>
        <!-- /.col -->
    </div>
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

</section>
    <?php
//Footer
include_once '../../view/includes/footer.php';
?>