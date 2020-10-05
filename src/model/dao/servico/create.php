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

if(isset($_POST['btn-cadastrar-servico'])):
	$nome = clear($_POST['nome']);
	$idusuario = clear($_POST['idusuario']);

	$sql = "INSERT INTO SERVICO (NOME) VALUES ('$nome')";

	if(mysqli_query($connect, $sql)):
		header('Location: ../../../view/servico/sistemalista.php?user='.$idusuario.'&ok');
	else:
		header('Location: ../../../view/servico/sistemalista.php?user='.$idusuario.'&error');
	endif;
endif;