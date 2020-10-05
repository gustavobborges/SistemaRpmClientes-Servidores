<?php
// Sessão
session_start();
// Conexão
require_once '../../../db_connect.php';

if(isset($_POST['btn-editar-contato-todos'])):
	$nome = mysqli_escape_string($connect, $_POST['nome']);
	$cargo = mysqli_escape_string($connect, $_POST['cargo']);
	$idcliente = mysqli_escape_string($connect, $_POST['clientlist']);
	$idusuario = mysqli_escape_string($connect, $_POST['idusuario']);
	$id = mysqli_escape_string($connect, $_POST['id']);

	$sql = "UPDATE CONTATO SET NOME = '$nome', CARGO = '$cargo', IDCLIENTE = '$idcliente' WHERE IDCONTATO = '$id'";

	if(mysqli_query($connect, $sql)):
		header('Location: ../../../../view/contato/clistatodos.php?user='.$idusuario.'&ok');
	else:
		header('Location: ../../../../view/contato/clistatodos.php?user='.$idusuario.'&error');
	endif;
	
endif;