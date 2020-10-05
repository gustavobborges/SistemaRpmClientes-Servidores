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
        CONTATO.IDCONTATO,
        CONTATO.NOME AS CONTATONOME,
        CONTATO.CARGO,
        CONTATO.EMAIL,
        TELEFONE.IDTELEFONE,
        TELEFONE.NUMERO,
        TELEFONE.DDD

        FROM CLIENTE
        LEFT JOIN CONTATO
            ON CLIENTE.IDCLIENTE = CONTATO.IDCLIENTE
        LEFT JOIN TELEFONE
            ON CONTATO.IDCONTATO = TELEFONE.IDCONTATO
        
        WHERE CONTATO.IDCONTATO = '$id'";

        $resultado = mysqli_query($connect, $sql);
        $dados = mysqli_fetch_array($resultado);
        $idcliente = $dados['IDCLIENTE'];
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
                    <h1 class="m-0 text-dark">Cliente: <b><?php echo $dados['CLIENTENOME']?></b> | Contato:
                        <b><?php echo $dados['CONTATONOME']?></b></b></h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-4">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Contato</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form">
                            <div class="card-body">
                                <form action="../../model/dao/servicocliente/update.php" method="POST">
                                    <input type="hidden" name="idusuario" value="<?php echo $idusuario; ?>">
                                    <input type="hidden" name="idcliente" value="<?php echo $dados['IDCLIENTE']; ?>">
                                    <input type="hidden" name="id" value="<?php echo $id; ?>">

                                    <div class="form-group">
                                        <label for="sistema">Nome</label>
                                        <div class="form-control">
                                            <?php echo $dados['CONTATONOME'];?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="sistema">Cargo</label>
                                        <div class="form-control">
                                            <?php echo $dados['CARGO'];?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="sistema">Email</label>
                                        <div class="form-control">
                                            <?php echo $dados['EMAIL'];?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="nome">Cliente</label>
                                        <div class="form-control">
                                            <?php echo $dados['CLIENTENOME'];?>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <a href="../clienteview/clienteview.php?user=<?php echo $idusuario; ?>&id=<?php echo $dados['IDCLIENTE']; ?>"
                                    class="btn btn-secondary">Voltar</a>
                                <a href="edit.php?user=<?php echo $idusuario; ?>&idcliente=<?php echo $dados['IDCLIENTE']; ?>&id=<?php echo $dados['IDCONTATO'] ?>"
                                    class="btn btn-warning float-right">Editar</a>
                            </div>
                    </div>
                    <!-- /.card -->
                </div>

                <div class="col-md-8">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Telefones</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-condensed table-hover table-striped " id="table"
                                data-toggle="table" data-sort-name="name" data-sort-order-desc="desc">
                                <thead>
                                    <tr>
                                        <th scope="col" data-field="sistema" data-sortable="true">DDD</th>
                                        <th scope="col" data-field="estado" data-sortable="true">Número</th>
                                        <th>-</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                        $sql = "SELECT * FROM TELEFONE WHERE IDCONTATO = '$id'";
                        $resultado = mysqli_query($connect, $sql);

                        if(mysqli_num_rows($resultado) > 0):

                            while($dados = mysqli_fetch_array($resultado)):            
                            ?>
                                    <tr>
                                        <td><?php echo $dados['DDD']; ?></td>
                                        <td><?php echo $dados['NUMERO']; ?></td>
                                        <td>
                                            <a href="../telefone/edit.php?user=<?php echo $idusuario?>&idcliente=<?php echo $dados['IDCLIENTE'] ?>&idcontato=<?php echo $id; ?>&id=<?php echo $dados['IDTELEFONE']; ?>"
                                                class="btn btn-warning"><img src="/../assets/edit.svg"></a>

                                            <button type="button" class="btn btn-primary btn btn-danger"
                                                data-toggle="modal"
                                                data-target="#modal<?php echo $dados['IDTELEFONE'] ?>"><img
                                                    src="/../assets/delete.svg"></button></td>

                                        <!-- Botão para acionar modal -->
                                        <!-- Modal BOOTSTRAP-->
                                        <!-- Criação do modal -->
                                        <div class="modal fade" id="modal<?php echo $dados['IDTELEFONE'] ?>"
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
                                                        Tem certeza que deseja excluir este Telefone?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form action="../../model/dao/telefone/delete.php"
                                                            method="POST">
                                                            <input type="hidden" name="id"
                                                                value="<?php echo $dados['IDTELEFONE']; ?>">
                                                            <input type="hidden" name="idusuario"
                                                                value="<?php echo $idusuario; ?>">
                                                            <input type="hidden" name="idcontato"
                                                                value="<?php echo $id; ?>">
                                                            <input type="hidden" name="idcliente"
                                                                value="<?php echo $dados['IDCLIENTE']; ?>">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Fechar</button>

                                                            <button type="submit" class="btn btn-primary"
                                                                name="btn-deletar-telefone">Excluir</button>
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
                            <a href="../telefone/new.php?user=<?php echo $idusuario; ?>&idcliente=<?php echo $idcliente; ?>&id=<?php echo $id ?>"
                                class="btn btn-success botaop">Novo Telefone &nbsp; <img
                                    src="/../assets/add.svg"></a><br>
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

<?php
//Footer
include_once '../../view/includes/footer.php';
?>