<?php
// Sessão
session_start();
// Conexão
require_once '../../../db_connect.php';
if(isset($_POST['btn-deletar-contato-todos'])):

	$idusuario = mysqli_escape_string($connect, $_POST['idusuario']);
	$id = mysqli_escape_string($connect, $_POST['id']);

	$sql = "DELETE FROM CONTATO WHERE IDCONTATO = '$id'";

	if(mysqli_query($connect, $sql)):
		header('Location: ../../../../view/contato/clistatodos.php?user='.$idusuario.'&del');
	else:
		header('Location: ../../../../view/contato/clistatodos.php?user='.$idusuario.'&errordel');
	endif;
endif;