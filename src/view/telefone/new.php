<?php
//Conexão
include_once '../../model/db_connect.php';
//Header
include_once '../../view/includes/header.php';

if(isset($_GET['user'])):
	$idusuario = mysqli_escape_string($connect, $_GET['user']);
endif;

if(isset($_GET['id'])):
    $id = mysqli_escape_string($connect, $_GET['id']);
    $sql = "SELECT * FROM CONTATO; ";
    $resultado = mysqli_query($connect, $sql);
    $dados = mysqli_fetch_array($resultado);
endif;

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
                        <h3 class="card-title">Novo Telefone</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                                title="Collapse">
                                <i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="../../model/dao/telefone/create.php" method="POST" id="quickForm">
                        <input type="hidden" name="idusuario" value="<?php echo $idusuario; ?>">
                        <input type="hidden" name="idcliente" value="<?php echo $dados['IDCLIENTE']; ?>">
                        <input type="hidden" name="idcontato" value="<?php echo $id; ?>">

                            <div class="form-group">
                                <label for="inputName">DDD</label>
                                <input type="text" id="inputName" name="ddd" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="inputName">Número</label>
                                <input type="text" id="inputName" name="telefone" class="form-control">
                            </div>
                           
                            <div class="row">
                                <div class="col-12">
                                    <a href="../contato/view.php?user=<?php echo $idusuario ?>&idcliente=<?php echo $dados['IDCLIENTE'] ?>&id=<?php echo $id ?> " class="btn btn-secondary">Voltar</a>
                                    <input type="submit" value="Cadastrar" class="btn btn-success float-right" name="btn-cadastrar-telefone">
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
            ddd: {
                required: true,
                minlength: 2,
                maxlength: 3
            },
            telefone: {
                required: true,
                minlength: 8,
                maxlength: 12
            },
    
        },
        messages: {
            ddd: {
                required: "O campo DDD é obrigatório!",
                minlength: "O campo DDD deve ter pelo menos 2 números!",
                maxlength: "O campo DDD deve ter no máximo 3 números!"
            },
            telefone: {
                required: "O campo Número é obrigatório!",
                minlength: "O campo Número deve ter pelo menos 8 números!",
                maxlength: "O campo Número deve ter no máximo 12 números!"
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
<?php
//Footer
include_once '../../view/includes/footer.php';
?>