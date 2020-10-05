<?php
//Conexão
include_once 'src/model/db_connect.php';
//Header
include_once 'src/view/includes/headerindex.php';

//Botão entrar:
if(isset($_POST['btn-entrar'])):
    $erros = array();
    $login = mysqli_escape_string($connect, $_POST['login']);
    $senha = mysqli_escape_string($connect, $_POST['senha']);

    if(empty($login) or empty($senha)):
        $erros[] = "<li> Os campos login e senha precisam ser preenchidos!</li>";
    else:
        $sql = "SELECT LOGINUSUARIO FROM USUARIO WHERE LOGINUSUARIO = '$login'";
        $resultado = mysqli_query($connect, $sql);

        if(mysqli_num_rows($resultado) > 0):
            $sql = "SELECT * FROM USUARIO WHERE LOGINUSUARIO = '$login' AND SENHA = '$senha' ";
            $resultado = mysqli_query($connect, $sql);

                if((mysqli_num_rows($resultado) == 1)):
                    $dados = mysqli_fetch_array($resultado); //Convertendo o resultado da Query em um Array
                    mysqli_close($connect);
                    $_SESSION['logado'] = true;
                    $_SESSION['id_usuario'] = $dados['IDUSUARIO'];
                    $idusuario = $dados['IDUSUARIO'];
                    header("Location: src/view/home/home?user=$idusuario");
                else:
                    $erros[] = "<li> Usuário e senha não conferem. </li>";
                endif;
        else:
            $erros[] = "O usuário inserido não existe.";
        endif;   
    endif;    
endif;
?>


<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <img class="imglogin" src="img/robot.png" alt="robot" style="margin-bottom: -20px"></img>
        </div>
        <div class="card">
            <!-- /.login-logo -->

            <div class="card-body login-card-body">
                <p class="login-box-msg">Faça seu login</p>

                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <div class="mensagemerro">
                <?php
                if(!empty($erros)):
                    foreach($erros as $erro):
                        echo $erro;
                    endforeach;
                endif;
                ?>
                </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="login" placeholder="Usuário">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" name="senha" placeholder="Senha">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember">
                                <label for="remember">
                                    Lembrar de mim
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" name="btn-entrar" class="btn btn-primary btn-block">Entrar</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <div class="social-auth-links text-center mb-3" style="margin-top:40px">
                    <p class="mb-1">
                        <a href="forgot-password.html">Esqueci minha senha</a>
                    </p>
                </div>
                <!-- /.login-card-body -->
            </div>
        </div>
        <!-- /.login-box -->

        <!-- jQuery -->
        <script src="../../plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- AdminLTE App -->
        <script src="../../dist/js/adminlte.min.js"></script>

</body>

</html>

<?php
//Footer
include_once 'src/view/includes/footerindex.php';
?>