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
        $sql = "SELECT * FROM SERVIDOR WHERE IDSERVIDOR = '$id'";
        $resultado = mysqli_query($connect, $sql);
        $dados = mysqli_fetch_array($resultado);
    
    }

?>
<link type="text/css" rel="stylesheet" href="stylecard.css">
<!-- Font Awesome -->
<link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
<!-- Ionicons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<!-- overlayScrollbars -->
<link rel="stylesheet" href="../../dist/css/adminlte.min.css">

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="display: flex; justify-content: center; width: auto;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Editar Servidor</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                                title="Collapse">
                                <i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="../../model/dao/servidor/todos/update.php" method="POST" id="quickForm">
                            <input type="hidden" name="idusuario" value="<?php echo $idusuario; ?>">
                            <input type="hidden" name="id" value="<?php echo $dados['IDSERVIDOR'];?>">
                            <div class="form-group">
                                <label for="inputName">Nome</label>
                                <input type="text" id="inputName" name="nome" class="form-control"
                                    value="<?php echo $dados['NOME']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="inputName">Acesso</label>
                                <input type="text" id="inputName" name="acesso" class="form-control"
                                    value="<?php echo $dados['ACESSO']; ?>">
                            </div>

                            <div class="form-group">
                                <label for="clientlist">Selecione o Cliente: </label>
                                <select class="form-control custom-select" name="clientlist" id="clientlist">
                                    <option>-- Selecione --</option>
                                    <?php
                                     $sql="SELECT * FROM CLIENTE";
                                     $res=mysqli_query($connect, $sql);
                                     $idcliente = $dados['IDCLIENTE'];

                                        while ($posicao=mysqli_fetch_row($res)) {
                                            $vnome=$posicao[2];
                                            $vid=$posicao[0];

                                            $selected = ($vid == $idcliente) ? "selected='selected'" : "";
                                            echo "<option value='$vid'$selected>$vnome</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="servicos">Selecione o Serviço: </label>
                                <select id="servicos" class="form-control custom-select" name="servicos">
                                    <?php    
                                    $sql2="SELECT * FROM SERVICOCLIENTE";
                                    $res=mysqli_query($connect, $sql2);
                                    $dados2 = mysqli_fetch_array($res);
                                    $idservicocliente = $dados2['IDSERVICOCLIENTE'];                                echo "<option value='$vid'$selected>$vnome</option>";
                                    
                                ?>
                                </select>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <a href="../servidor/servidortodos.php?user=<?php echo $idusuario?>"
                                        class="btn btn-secondary">Voltar</a>
                                    <input type="submit" value="Salvar" class="btn btn-success float-right"
                                        name="btn-editar-servidor-todos">
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </section>
</div>

<!-- jquery-validation -->
<script src="../../../plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="../../../plugins/jquery-validation/additional-methods.min.js"></script>
<!-- AdminLTE App -->
<script src="../../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../../dist/js/demo.js"></script>
<script type="text/javascript">
$(document).ready(function() {

    $('#quickForm').validate({
        rules: {
            nome: {
                required: true
            },
            acesso: {
                required: true
            },
            clientlist: {
                required: true
            },
            servicos: {
                required: true
            },
        },
        messages: {
            nome: {
                required: "O campo Nome é obrigatório!"
            },
            acesso: {
                required: "O campo Acesso é obrigatório!"
            },
            clientlist: {
                required: "O campo Cliente é obrigatório!"
            },
            servicos: {
                required: "O campo Serviço é obrigatório!"
            },
        },
        errorElement: 'span',
        errorPlacement: function(error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function(element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        }
    });
});
</script>
<script>
$(function() {
    $("#clientlist").on("change", function() {
        $.ajax({
            url: 'pegarservicos-todos.php',
            type: 'POST',
            data: {
                id: $("#clientlist").val()
            },
            beforeSend: function() {
                $("#servicos").css({
                    'display': 'block'
                });
                $("#servicos").html("Carregando...");
            },
            success: function(data) {
                $("#servicos").css({
                    'display': 'block'
                });
                $("#servicos").html(data);
            },
            error: function(data) {
                $("#servicos").css({
                    'display': 'block'
                });
                $("#servicos").html("Houve um erro ao carregar");
            }
        });
    });
});
</script>

<?php
//Footer
include_once '../../view/includes/footer.php';
?>