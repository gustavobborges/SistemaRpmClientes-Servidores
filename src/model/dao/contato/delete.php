<?php
// Sessão
session_start();
// Conexão
require_once '../../db_connect.php';
if(isset($_POST['btn-deletar-contato'])):
	$idusuario = mysqli_escape_string($connect, $_POST['idusuario']);
	$idcliente = mysqli_escape_string($connect, $_POST['idcliente']);
	$id = mysqli_escape_string($connect, $_POST['id']);

	$sql = "DELETE FROM CONTATO WHERE IDCONTATO = '$id'";

	if(mysqli_query($connect, $sql)):
		header('Location: ../../../view/clienteview/clienteview.php?user='.$idusuario.'&id='.$idcliente.'&del');
	else:
		header('Location: ../../../view/clienteview/clienteview.php?user='.$idusuario.'&id='.$idcliente.'&errordel');

	endif;
endif;