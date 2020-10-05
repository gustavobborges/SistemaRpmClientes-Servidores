<?php
// Sessão
session_start();
// Conexão
require_once '../../db_connect.php';
if(isset($_POST['btn-deletar-servidor'])):

	$id = mysqli_escape_string($connect, $_POST['id']);
	$idservicocliente = mysqli_escape_string($connect, $_POST['idservicocliente']);
	$idusuario = mysqli_escape_string($connect, $_POST['idusuario']);

	$sql = "DELETE FROM SERVIDOR WHERE IDSERVIDOR = '$id'";

	if(mysqli_query($connect, $sql)):
		header('Location: ../../../view/servicoclienteview/view.php?user='.$idusuario.'&id='.$idservicocliente.'&del');
	else:
		header('Location: ../../../view/servicoclienteview/view.php?user='.$idusuario.'&id='.$idservicocliente.'&errordel');
	endif;
endif;