<?php
// Sessão
session_start();
// Conexão
require_once '../../db_connect.php';

if(isset($_POST['btn-editar-servidor'])):
	$nome = mysqli_escape_string($connect, $_POST['nome']);	
	$acesso = mysqli_escape_string($connect, $_POST['acesso']);	
	$id = mysqli_escape_string($connect, $_POST['id']);
	$idservicocliente = mysqli_escape_string($connect, $_POST['idservicocliente']);
	$idcliente = mysqli_escape_string($connect, $_POST['idcliente']);
	$idusuario = mysqli_escape_string($connect, $_POST['idusuario']);


	$sql = "UPDATE SERVIDOR SET NOME = '$nome', ACESSO = '$acesso' WHERE IDSERVIDOR = '$id'";
	
	if(mysqli_query($connect, $sql)):
		header('Location: ../../../view/servicoclienteview/view.php?user='.$idusuario.'&id='.$idservicocliente.'&ok');
	else:
		header('Location: ../../../view/servicoclienteview/view.php?user='.$idusuario.'&id='.$idservicocliente.'&error');
	endif;
endif;