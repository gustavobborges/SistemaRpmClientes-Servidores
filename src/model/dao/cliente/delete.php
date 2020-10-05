<?php
// Sessão
session_start();
// Conexão
require_once '../../db_connect.php';
if(isset($_POST['btn-deletar-cliente'])):

	$id = mysqli_escape_string($connect, $_POST['id']);
	$idusuario = mysqli_escape_string($connect, $_POST['idusuario']);

	$sql = "DELETE FROM CLIENTE WHERE IDCLIENTE = '$id'";

	if(mysqli_query($connect, $sql)):
		header('Location: ../../../view/home/home.php?user='.$idusuario.'&del');
	else:
		header('Location: ../../../view/home/home.php?user='.$idusuario.'&errordel');
	endif;
endif;