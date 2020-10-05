<?php
// Sessão
session_start();
// Conexão
require_once '../../db_connect.php';

if(isset($_POST['btn-editar-tipousuario'])):
	$nome = mysqli_escape_string($connect, $_POST['nome']);	
	$idusuario = mysqli_escape_string($connect, $_POST['idusuario']);
	$id = mysqli_escape_string($connect, $_POST['id']);

	$sql = "UPDATE TIPOUSUARIO SET NOME = '$nome' WHERE IDTIPOUSUARIO = '$id'";

	if(mysqli_query($connect, $sql)):
		header('Location: ../../../view/tipousuario/tipousuariolista.php?user='.$idusuario.'&ok');
	else:
		header('Location: ../../../view/tipousuario/tipousuariolista.php?user='.$idusuario.'&error');
	endif;
endif;