<?php
//Conexão
include_once '../../model/db_connect.php';
//Header
include_once '../../view/includes/header.php';
// Toastr
include_once '../includes/toastr.php';

if(isset($_GET['user'])):
	$idusuario = mysqli_escape_string($connect, $_GET['user']);
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
                        <h3 class="card-title">Novo Contato</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                                title="Collapse">
                                <i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="../../model/dao/contato/todos/create.php" method="POST" id="quickForm">
                        <input type="hidden" name="idusuario" value="<?php echo $idusuario; ?>">

                            <div class="form-group">
                                <label for="inputName">Nome</label>
                                <input type="text" id="inputName" name="nome" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="inputName">Cargo</label>
                                <input type="text" id="inputName" name="cargo" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="inputName">Email</label>
                                <input type="text" id="inputName" name="email" class="form-control">
                            </div>                           
                            <div class="form-group">
                                <label for="clientlist">Selecione o cliente: </label>
                                <select class="form-control custom-select" name="clientlist">
                                <option value="">-- Selecione --</option>

                                    <?php
                                        $sql="SELECT * FROM CLIENTE";
                                        $res=mysqli_query($connect, $sql);

                                        while ($posicao=mysqli_fetch_row($res)) {
                                            $vnome=$posicao[2];
                                            $vid=$posicao[0];
                                            echo "<option value=$vid>$vnome</option>";
                                        }
                                    ?>
                                </select>
                            </div>    
                            <div class="row">
                                <div class="col-12">
                                    <a href="../contato/clistatodos.php?user=<?php echo $idusuario; ?>" class="btn btn-secondary">Voltar</a>
                                    <input type="submit" value="Cadastrar" class="btn btn-success float-right" name="btn-cadastrar-contato">
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

            cargo: {
                required: true
            },
            
            email: {
                email: true
            },

            clientlist: {
                required: true
            }
        },
        messages: {
            nome: {
                required: "O campo Nome é obrigatório!"
            },
            cargo: {
                required: "O campo Cargo é obrigatório!"
            },
            email: {
                email: "O email precisa ser válido!"
            },
            clientlist: {
                required: "O campo Cliente é obrigatório!"
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