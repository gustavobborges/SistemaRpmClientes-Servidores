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

if(isset($_POST['btn-cadastrar-telefone'])):
	$ddd = clear($_POST['ddd']);
	$telefone = clear($_POST['telefone']);
    $idcliente = clear($_POST['idcliente']);
	$idcontato = clear($_POST['idcontato']);
	$idusuario = clear($_POST['idusuario']);


	$sql = "INSERT INTO TELEFONE (DDD, NUMERO, IDCONTATO, IDCLIENTE) VALUES ('$ddd', '$telefone', '$idcontato', '$idcliente')";
	
	if(mysqli_query($connect, $sql)):
		header('Location: ../../../view/contato/view.php?user='.$idusuario.'&idcliente='.$idcliente.'&id='.$idcontato.'&ok');
	else:
		header('Location: ../../../view/contato/view.php?user='.$idusuario.'&idcliente='.$idcliente.'&id='.$idcontato.'&error');
	endif;
endif;