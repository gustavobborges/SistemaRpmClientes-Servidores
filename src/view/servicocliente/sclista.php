<?php
//Conexão
include_once '../../model/db_connect.php';
//Header
include_once '../../view/includes/header.php';
//Toastr
include_once '../includes/toastr.php';

if(isset($_GET['user'])) {
    $idusuario = $_GET['user'];
}
if(isset($_GET['id'])) {
	$id = mysqli_escape_string($connect, $_GET['id']);  
    $sql = "SELECT * FROM CLIENTE WHERE IDCLIENTE = '$id'";
    $resultado = mysqli_query($connect, $sql);
    $dados = mysqli_fetch_array($resultado);
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

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-gray">
                    <div class="card-header">
                        <div class="card-title" style="font-size: 1.5rem;">Serviços do Cliente</div>
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
                            <th scope="col" data-field="sistema" data-sortable="true">Sistema</th>
                            <th scope="col" data-field="estado" data-sortable="true">Estado</th>
                            <th>-</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $sql = "SELECT * FROM SERVICOCLIENTE INNER JOIN SERVICO ON SERVICO.IDSERVICO =  SERVICOCLIENTE.IDSERVICO WHERE SERVICOCLIENTE.IDCLIENTE = '$id'";
                        $resultado = mysqli_query($connect, $sql);
                    
                        if(mysqli_num_rows($resultado) > 0):

                        while($dados = mysqli_fetch_array($resultado)):
                        ?>
                        <tr>
                            <td><?php echo $dados['NOME']; ?></td>
                            <td><?php echo $dados['ESTADO']; ?></td>
                            <td><a href="../servicoclienteview/view.php?user=<?php echo $idusuario?>&id=<?php echo $dados['IDSERVICOCLIENTE']; ?>"
                                    class="btn btn-primary"><img src="/../assets/ver.svg"></a>

                                <a href="../servicocliente/edit.php?user=<?php echo $idusuario?>&id=<?php echo $dados['IDSERVICOCLIENTE']; ?>"
                                    class="btn btn-warning"><img src="/../assets/edit.svg"></a>

                                <button type="button" class="btn btn-primary btn btn-danger" data-toggle="modal"
                                    data-target="#modal<?php echo $dados['IDSERVICOCLIENTE'] ?>"><img
                                        src="/../assets/delete.svg"></button></td>

                            <!-- Botão para acionar modal -->
                            <!-- Modal BOOTSTRAP-->
                            <!-- Criação do modal -->
                            <div class="modal fade" id="modal<?php echo $dados['IDSERVICOCLIENTE'] ?>" tabindex="-1"
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
                                            Tem certeza que deseja excluir este Serviço?
                                        </div>
                                        <div class="modal-footer">
                                            <form action="../../model/dao/servicocliente/delete.php" method="POST">
                                                <input type="hidden" name="id"
                                                    value="<?php echo $dados['IDSERVICOCLIENTE']; ?>">
                                                <input type="hidden" name="idusuario" value="<?php echo $idusuario; ?>">
                                                <input type="hidden" name="idcliente" value="<?php echo $id; ?>">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Fechar</button>

                                                <button type="submit" class="btn btn-primary"
                                                    name="btn-deletar-servicocliente">Excluir</button>
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
            <!-- /.box-body -->
            
        </div>
        <!-- /.box -->
        <a href="../servicocliente/new.php?user=<?php echo $idusuario; ?>&id=<?php echo $id; ?>"
                    class="btn btn-success botaop" style="margin-top: 15px; margin-bottom: 40px">Novo Serviço &nbsp;<img
                        src="/../assets/add.svg"></a>
    </div>
    <!-- /.col -->


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