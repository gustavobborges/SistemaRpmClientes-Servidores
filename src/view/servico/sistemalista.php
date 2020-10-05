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
?>

<link type="text/css" rel="stylesheet" href="style.css">
<link href="https://unpkg.com/bootstrap-table@1.16.0/dist/bootstrap-table.min.css" rel="stylesheet">
<script src="https://unpkg.com/bootstrap-table@1.16.0/dist/bootstrap-table.min.js"></script>

<script type="text/javascript" src="../../../js/jquery.js"></script>

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
                            <div class="card-title" style="font-size: 1.5rem;">Sistemas</div>
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
                                        <th>-</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $sql = "SELECT * FROM SERVICO";
                                        $resultado = mysqli_query($connect, $sql);
                                        if(mysqli_num_rows($resultado) > 0):
                                        while($dados = mysqli_fetch_array($resultado)):   
                                        $servico = $dados['IDSERVICO'];                  
                                    ?>
                                    <tr>
                                        <td><?php echo $dados['NOME']; ?></td>
                                        <td>
                                            <a href="edit.php?user=<?php echo $idusuario?>&id=<?php echo $dados['IDSERVICO']; ?>"
                                                class="btn btn-warning"><img src="/../assets/edit.svg"></a>

                                            <?php
                                            $sqls= "SELECT * FROM SERVICOCLIENTE WHERE IDSERVICO = '$servico' "; 
                                            $res = mysqli_query($connect, $sqls);

                                            if(mysqli_num_rows($res) > 0) {   
                                            ?>

                                            <button type="button" class="btn btn-primary btn btn-danger toastrDefaultErrorEx"
                                                id="botaoexcluir"
                                                data-target="<?php echo $dados['IDSERVICO'] ?>"><img
                                                    src="/../assets/delete.svg"></button>


                                            <?php 
                                            } else {
                                            ?>
                                            <button type="button" class="btn btn-primary btn btn-danger"
                                                data-toggle="modal"
                                                data-target="#modal<?php echo $dados['IDSERVICO'] ?>"><img
                                                    src="/../assets/delete.svg"></button>
                                        </td>

                                        <!-- MODAL -->
                                        <div class="modal fade" id="modal<?php echo $dados['IDSERVICO'] ?>"
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
                                                        <form action="../../model/dao/servico/delete.php" method="POST">
                                                            <input type="hidden" name="id"
                                                                value="<?php echo $dados['IDSERVICO']; ?>">
                                                            <input type="hidden" name="idusuario"
                                                                value="<?php echo $idusuario; ?>">

                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Fechar</button>

                                                            <button type="submit" class="btn btn-primary"
                                                                name="btn-deletar-servico">Excluir</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                    </body>
                                    <?php
                                    endwhile;
                                    else: ?>
                                    <tr>
                                        <td>-</td>
                                        <td>-</td>
                                    </tr>
                                    <?php
                endif;
                ?>
                            </table>

                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- /.content -->
        </div>

        <a href="new.php?user=<?php echo $idusuario ?>" class="btn btn-success botaop">Novo
            Sistema &nbsp;<img src="/../assets/add.svg"></a>
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

<script type="text/javascript">
  $(function() {

    $('.toastrDefaultErrorEx').click(function() {
      toastr.error('Este Sistema não pode ser excluído pois está sendo utilizado.')
    });
  });

</script>

<script type="text/javascript" src="../../../js/jquery.js"></script>

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

</section>
<?php
//Footer
include_once '../../view/includes/footer.php';
?>