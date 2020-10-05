<?php
// Sessão
session_start();
// Conexão
require_once '../../../db_connect.php';
if(isset($_POST['btn-deletar-servidor-todos'])):

	$id = mysqli_escape_string($connect, $_POST['id']);
	$idusuario = mysqli_escape_string($connect, $_POST['idusuario']);

	$sql = "DELETE FROM SERVIDOR WHERE IDSERVIDOR = '$id'";

	if(mysqli_query($connect, $sql)):
		header('Location: ../../../../view/servidor/servidortodos.php?user='.$idusuario.'&del');
	else:
		header('Location: ../../../../view/servidor/servidortodos.php?user='.$idusuario.'&errordel');
	endif;
endif;