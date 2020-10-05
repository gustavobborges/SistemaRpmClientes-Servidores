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

if(isset($_POST['btn-cadastrar-servidor'])):
	$nome = clear($_POST['nome']);
	$acesso = clear($_POST['acesso']);
	$id = clear($_POST['id']);
	$idusuario = clear($_POST['idusuario']);
	$idcliente = clear($_POST['idcliente']);
	$idservico = clear($_POST['idservico']);


	$sql = "INSERT INTO SERVIDOR (NOME, ACESSO, IDCLIENTE, IDSERVICO, IDSERVICOCLIENTE) VALUES ('$nome', '$acesso' , '$idcliente', '$idservico', '$id' )";

	if(mysqli_query($connect, $sql)):
		header('Location: ../../../view/servicoclienteview/view.php?user='.$idusuario.'&id='.$id.'&ok');
	else:
		header('Location: ../../../view/servicoclienteview/view.php?user='.$idusuario.'&id='.$id.'&error');
	endif;
endif;