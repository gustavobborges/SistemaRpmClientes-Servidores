<?php
// Sessão
session_start();
// Conexão
require_once '../../db_connect.php';
if(isset($_POST['btn-deletar-servico'])):

	$id = mysqli_escape_string($connect, $_POST['id']);
	$idusuario = mysqli_escape_string($connect, $_POST['idusuario']);

	$sql = "DELETE FROM SERVICO WHERE IDSERVICO = '$id'";

	if(mysqli_query($connect, $sql)):
		header('Location: ../../../view/servico/sistemalista.php?user='.$idusuario.'&del');
	else:
		header('Location: ../../../view/servico/sistemalista.php?user='.$idusuario.'&errordel');
	endif;
endif;