<?php
// Sessão
session_start();
// Conexão
require_once '../../db_connect.php';

if(isset($_POST['btn-editar-contato'])):
	$nome = mysqli_escape_string($connect, $_POST['nome']);
	$cargo = mysqli_escape_string($connect, $_POST['cargo']);
	$id = mysqli_escape_string($connect, $_POST['id']);
	$idcliente = mysqli_escape_string($connect, $_POST['idcliente']);
	$idusuario = mysqli_escape_string($connect, $_POST['idusuario']);
	$email = mysqli_escape_string($connect, $_POST['email']);

	$sql = "UPDATE CONTATO SET NOME = '$nome', CARGO = '$cargo', IDCLIENTE = '$idcliente', EMAIL = '$email' WHERE IDCONTATO = '$id'";

	if(mysqli_query($connect, $sql)):
		header('Location: ../../../view/clienteview/clienteview.php?user='.$idusuario.'&id='.$idcliente.'&ok'); 
	else:
		header('Location: ../../../view/clienteview/clienteview.php?user='.$idusuario.'&id='.$idcliente.'&error');
	endif;
endif;