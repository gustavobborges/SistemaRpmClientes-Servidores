<?php
// Sessão
session_start();
// Conexão
require_once '../../db_connect.php';

if(isset($_POST['btn-editar-servico'])):
	$nome = mysqli_escape_string($connect, $_POST['nome']);	
	$id = mysqli_escape_string($connect, $_POST['id']);
	$idusuario = mysqli_escape_string($connect, $_POST['idusuario']);

	$sql = "UPDATE SERVICO SET NOME = '$nome' WHERE IDSERVICO = '$id'";
	
	if(mysqli_query($connect, $sql)):
		header('Location: ../../../view/servico/sistemalista.php?user='.$idusuario.'&ok');
	else:
		header('Location: ../../../view/servico/sistemalista.php?user='.$idusuario.'&error');
	endif;
endif;