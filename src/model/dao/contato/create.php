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

if(isset($_POST['btn-cadastrar-contato'])):
	$nome = clear($_POST['nome']);
	$cargo = clear($_POST['cargo']);
	$idcliente = clear($_POST['id']);
	$idusuario = clear($_POST['idusuario']);
	$email = clear($_POST['email']);

	$sql = "INSERT INTO CONTATO (NOME, CARGO, IDCLIENTE, EMAIL) VALUES ('$nome', '$cargo', '$idcliente', '$email')";

	if(mysqli_query($connect, $sql)):
		header('Location: ../../../view/clienteview/clienteview.php?user='.$idusuario.'&id='.$idcliente.'&ok');
	
	else:
		header('Location: ../../../view/clienteview/clienteview.php?user='.$idusuario.'&id='.$idcliente.'&error');
	endif;
endif;