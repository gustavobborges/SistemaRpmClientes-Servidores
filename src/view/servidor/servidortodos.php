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
    $sql = "SELECT 
    SERVIDOR.NOME,
    SERVIDOR.ACESSO,
    SERVIDOR.IDSERVIDOR,
    SERVIDOR.IDCLIENTE,
    SERVIDOR.IDSERVICOCLIENTE,
    CLIENTE.NOME AS CLIENTENOME
    
    FROM SERVIDOR
    INNER JOIN CLIENTE
    ON SERVIDOR.IDCLIENTE = CLIENTE.IDCLIENTE; ";
    $resultado = mysqli_query($connect, $sql);
    $dados = mysqli_fetch_array($resultado);

?>


<link type="text/css" rel="stylesheet" href="styletodos.css">
<link href="https://unpkg.com/bootstrap-table@1.16.0/dist/bootstrap-table.min.css" rel="stylesheet">
<script src="https://unpkg.com/bootstrap-table@1.16.0/dist/bootstrap-table.min.js"></script>


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
                            <div class="card-title" style="font-size: 1.5rem;">Servidores</div>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                    data-toggle="tooltip" title="Collapse">
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
                                        <th scope="col" data-field="aecsso" data-sortable="true">Acesso</th>
                                        <th scope="col" data-field="cliente" data-sortable="true">Cliente</th>
                                        <th scope="col">-</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php 
                            if(mysqli_num_rows($resultado) > 0):
                            while($dados = mysqli_fetch_array($resultado)):
                        ?>
                                    <tr>
                                        <td><?php echo $dados['NOME']; ?></td>
                                        <td><?php echo $dados['ACESSO']; ?></td>
                                        <td><?php echo $dados['CLIENTENOME']; ?></td>
                                        <td>
                                            <a href="edittodos.php?user=<?php echo $idusuario?>&idservicocliente=<?php echo $dados['IDSERVICOCLIENTE']?>&id=<?php echo $dados['IDSERVIDOR'] ?>"
                                                class="btn btn-warning"><img src="/../assets/edit.svg"></a>


                                            <button type="button" class="btn btn-primary btn btn-danger"
                                                data-toggle="modal"
                                                data-target="#modal<?php echo $dados['IDSERVIDOR'] ?>"><img
                                                    src="/../assets/delete.svg">

                                            </button>
                                        </td>

                                        <!-- Botão para acionar modal -->
                                        <!-- Modal BOOTSTRAP-->
                                        <!-- Criação do modal -->
                                        <div class="modal fade" id="modal<?php echo $dados['IDSERVIDOR'] ?>"
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
                                                        <form action="../../model/dao/servidor/todos/delete.php"
                                                            method="POST">
                                                            <input type="hidden" name="id"
                                                                value="<?php echo $dados['IDSERVIDOR']; ?>">
                                                            <input type="hidden" name="idusuario"
                                                                value="<?php echo $idusuario; ?>">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Fechar</button>

                                                            <button type="submit" class="btn btn-primary"
                                                                name="btn-deletar-servidor-todos">Excluir</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </tr>
                                    <?php
                            endwhile;
                            endif; 
                        ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <a href="newtodos.php?user=<?php echo $idusuario; ?>" class="btn btn-success botaop"
                        style="margin-top: 15px; margin-bottom: 40px">Novo Servidor &nbsp;<img
                            src="/../assets/add.svg"></a>
                    <!-- /.box -->

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