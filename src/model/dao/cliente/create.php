  <!-- Toastr -->
  <link rel="stylesheet" href="../../../../plugins/toastr/toastr.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../../../dist/css/adminlte.min.css">

  <?php
// Sessão
session_start();
// Conexão
require_once '../../db_connect.php';

// Clear
function clear($input) {
	global $connect;
	// sql
	$var = mysqli_escape_string($connect, $input);
	// xss
	$var = htmlspecialchars($var);
	return $var;
}

if(isset($_POST['btn-cadastrar-cliente'])):
	$nome = clear($_POST['nome']);
	$estado = clear($_POST['estadolist']);
	$idusuario = clear($_POST['idusuario']);

	// if(empty($nome)) {
	// 	header('Location: ../../../view/cliente/new?user='.$idusuario.'&fc');
	// } else {

	$sql = "INSERT INTO CLIENTE (NOME, ESTADO) VALUES ('$nome', '$estado')";

	if(mysqli_query($connect, $sql)):
	?>
  <?php
		header('Location: ../../../view/home/home?user='.$idusuario.'&ok');
		
	else:
		header('Location: ../../../view/home/home?user='.$idusuario.'&error');

	endif;
	// }
endif;