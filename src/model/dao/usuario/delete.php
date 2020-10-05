<?php
// Sessão
session_start();
// Conexão
require_once '../../db_connect.php';
if(isset($_POST['btn-deletar-usuario'])):

	$id = mysqli_escape_string($connect, $_POST['id']);
	$idusuario = mysqli_escape_string($connect, $_POST['idusuario']);

	$sql = "DELETE FROM USUARIO WHERE IDUSUARIO = '$id'";

	if(mysqli_query($connect, $sql)):
		header('Location: ../../../view/usuario/usuariolista.php?user='.$idusuario.'&del');
	else:
		header('Location: ../../../view/usuario/usuariolista.php?user='.$idusuario.'&errordel');
	endif;
endif;