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

if(isset($_POST['btn-cadastrar-servicocliente'])):
	$idservico = clear($_POST['servicelist']);
	$estado = clear($_POST['estadolist']);
	$idcliente = clear($_POST['idcliente']);
	$idusuario = clear($_POST['idusuario']);


	$sql = "INSERT INTO SERVICOCLIENTE (IDSERVICO, ESTADO, IDCLIENTE) VALUES ('$idservico', '$estado', '$idcliente')";

	if(mysqli_query($connect, $sql)):
		header('Location: ../../../view/clienteview/clienteview.php?user='.$idusuario.'&id='.$idcliente.'&ok');
	
	else:
		header('Location: ../../../view/clienteview/clienteview.php?user='.$idusuario.'&id='.$idcliente.'&error');
	endif;
endif;