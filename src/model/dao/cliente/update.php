<?php
// Sessão
session_start();
// Conexão
require_once '../../db_connect.php';

if(isset($_POST['btn-editar-cliente'])):
	$nome = mysqli_escape_string($connect, $_POST['nome']);
	$estado = mysqli_escape_string($connect, $_POST['estadolist']);
	$idusuario = mysqli_escape_string($connect, $_POST['idusuario']);
	$id = mysqli_escape_string($connect, $_POST['idcliente']);
	
	$sql = "UPDATE CLIENTE SET NOME = '$nome', ESTADO = '$estado' WHERE IDCLIENTE = '$id'";

	if(mysqli_query($connect, $sql)):
		header('Location: ../../../view/home/home.php?user='.$idusuario.'&ok');
	else:
		header('Location: ../../../view/home/home.php?user='.$idusuario.'&error');
	endif;
	
endif;