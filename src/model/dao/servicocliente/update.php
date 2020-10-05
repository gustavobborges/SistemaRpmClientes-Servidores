<?php
// Sessão
session_start();
// Conexão
require_once '../../db_connect.php';

if(isset($_POST['btn-editar-servicocliente'])):
	$id = mysqli_escape_string($connect, $_POST['id']);
	$estado = mysqli_escape_string($connect, $_POST['estadolist']);
	$idservico = mysqli_escape_string($connect, $_POST['serviceclientlist']);
	$idcliente = mysqli_escape_string($connect, $_POST['idcliente']);
	$idusuario= mysqli_escape_string($connect, $_POST['idusuario']);


	$sql = "UPDATE SERVICOCLIENTE SET IDSERVICO = '$idservico', ESTADO = '$estado' WHERE IDSERVICOCLIENTE = '$id'";

	if(mysqli_query($connect, $sql)):
		header('Location: ../../../view/clienteview/clienteview.php?user='.$idusuario.'&id='.$idcliente.'&ok');
	else:
		header('Location: ../../../view/clienteview/clienteview.php?user='.$idusuario.'&id='.$idcliente.'&error');
	endif;
endif;