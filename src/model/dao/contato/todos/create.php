<?php
// Sessão
session_start();
// Conexão
require_once '../../../db_connect.php';
// Clear
function clear($input) {
	global $connect;
	// sql
	$var = mysqli_escape_string($connect, $input);
	// xss
	$var = htmlspecialchars($var);
	return $var;
}

if(isset($_POST['btn-cadastrar-contato'])):
	$nome = clear($_POST['nome']);
	$cargo = clear($_POST['cargo']);
	$id = clear($_POST['clientlist']);
	$idusuario = clear($_POST['idusuario']);
	$email = clear($_POST['email']);

	$sql = "INSERT INTO CONTATO (NOME, CARGO, IDCLIENTE, EMAIL) VALUES ('$nome', '$cargo', '$id', '$email')";

	if(mysqli_query($connect, $sql)):
		header('Location: ../../../../view/contato/clistatodos.php?user='.$idusuario.'&ok');
	
	else:
		header('Location: ../../../../view/contato/clistatodos.php?user='.$idusuario.'&error');
	endif;

endif;