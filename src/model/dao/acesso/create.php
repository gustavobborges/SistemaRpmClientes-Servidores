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

if(isset($_POST['btn-cadastrar-acesso'])):
	$acesso = clear($_POST['acesso']);
	$id = clear($_POST['id']);
	$idusuario = clear($_POST['idusuario']);
	$idservicocliente = clear($_POST['idservicocliente']);

	$sql = "INSERT INTO ACESSO (ACESSO, IDSERVIDOR) VALUES ('$acesso', '$id')";
	

	if(mysqli_query($connect, $sql)):
		header('Location: ../../../view/servidor/view.php?user='.$idusuario.'&idservicocliente='.$idservicocliente.'&id='.$id.'&ok');
	else:
		header('Location: ../../../view/servidor/view.php?user='.$idusuario.'&idservicocliente='.$idservicocliente.'&id='.$id.'&error');
	endif;
endif;