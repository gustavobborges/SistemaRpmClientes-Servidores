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

if(isset($_GET['idservicocliente'])) {
    $idservicocliente = $_GET['idservicocliente'];
    $sql = "SELECT 
    SERVICOCLIENTE.IDSERVICOCLIENTE AS IDSERVICOCLIENTE,
    SERVICOCLIENTE.IDCLIENTE,
    CLIENTE.IDCLIENTE,
    CLIENTE.NOME AS CLIENTENOME
    FROM
    SERVICOCLIENTE INNER JOIN CLIENTE
    ON SERVICOCLIENTE.IDCLIENTE = CLIENTE.IDCLIENTE
    WHERE SERVICOCLIENTE.IDSERVICOCLIENTE = '$idservicocliente' ";

    $res = mysqli_query($connect, $sql);
    $dadoss = mysqli_fetch_array($res);
}
if(isset($_GET['id'])) {
	$id = mysqli_escape_string($connect, $_GET['id']);  
    $sql = "SELECT
    SERVIDOR.IDSERVIDOR AS IDSERVIDOR,
    SERVIDOR.NOME AS NOMESERVIDOR,
    ACESSO.ACESSO AS ACESSO,
    ACESSO.IDSERVIDOR AS IDSERVIDOR

    FROM SERVIDOR
    LEFT JOIN ACESSO
        ON SERVIDOR.IDSERVIDOR = ACESSO.IDSERVIDOR
    WHERE SERVIDOR.IDSERVIDOR = '$id'";

    $resultado = mysqli_query($connect, $sql);
    $dados = mysqli_fetch_array($resultado);
}
?>

<link type="text/css" rel="stylesheet" href="styleacesso.css">
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

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Cliente:
                            <b><?php echo $dadoss['CLIENTENOME'] ?></b> | ID Serviço:
                            <b><?php echo $dadoss['IDSERVICOCLIENTE'] ?></b> | Servidor:
                            <b><?php echo $dados['NOMESERVIDOR'] ?></b></h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="row">
        <div class="card-title" style="font-size: 1.5rem;"></div>
            <div class="col-12">
                <div class="card card-gray">
                    <div class="card-header">
                        <div class="card-title" style="font-size: 1.5rem;">Acessos</div>
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
                                    <th scope="col" data-field="acesso" data-sortable="true">Acesso</th>
                                    <th scope="col">-</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                        $sql = "SELECT * FROM ACESSO WHERE IDSERVIDOR = '$id'";
                        $resultado = mysqli_query($connect, $sql);
                    
                        if(mysqli_num_rows($resultado) > 0):

                        while($dados = mysqli_fetch_array($resultado)):
                        ?>
                                <tr>
                                    <td><?php echo $dados['ACESSO']; ?></td>
                                    <td>
                                        <a href="../acesso/edit.php?user=<?php echo $idusuario; ?>&idservicocliente=<?php echo $idservicocliente; ?>&idservidor=<?php echo $id; ?>&id=<?php echo $dados['IDACESSO']; ?>"
                                            class="btn btn-warning"><img src="/../assets/edit.svg"></a>

                                        <button type="button" class="btn btn-primary btn btn-danger" data-toggle="modal"
                                            data-target="#modal<?php echo $dados['IDACESSO'] ?>"><img
                                                src="/../assets/delete.svg"></button></td>

                                    <!-- Botão para acionar modal -->
                                    <!-- Modal BOOTSTRAP-->
                                    <!-- Criação do modal -->
                                    <div class="modal fade" id="modal<?php echo $dados['IDACESSO'] ?>" tabindex="-1"
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
                                                    <form action="../../model/dao/acesso/delete.php" method="POST">
                                                        <input type="hidden" name="id"
                                                            value="<?php echo $dados['IDACESSO']; ?>">
                                                        <input type="hidden" name="idusuario"
                                                            value="<?php echo $idusuario; ?>">
                                                        <input type="hidden" name="idservidor"
                                                            value="<?php echo $dados['IDSERVIDOR']; ?>">
                                                        <input type="hidden" name="idservicocliente"
                                                            value="<?php echo $idservicocliente; ?>">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Fechar</button>

                                                        <button type="submit" class="btn btn-primary"
                                                            name="btn-deletar-acesso">Excluir</button>
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
                </div>
            </div>
            <!-- /.box-body -->
        </div>
        <a href="../acesso/new.php?user=<?php echo $idusuario ?>&idservicocliente=<?php echo $idservicocliente ?>&id=<?php echo $id; ?>"
                        class="btn btn-success botaop" style="margin-top: 15px;">Novo Acesso &nbsp; <img
                            src="/../assets/add.svg"></a>
                    <a href="../servicoclienteview/view.php?user=<?php echo $idusuario ?>&id=<?php echo $idservicocliente ?>"
                        class="btn btn-secondary botaop2" style="margin-top: 15px;">Voltar</a>
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
    <script>
    $(function() {
        $('#example1').DataTable()
        $('#example2').DataTable({
            'paging': true,
            'lengthChange': false,
            'searching': false,
            'ordering': true,
            'info': true,
            'autoWidth': false
        })
    })
    </script>
</section>
<?php
//Footer
include_once '../../view/includes/footer.php';
?>