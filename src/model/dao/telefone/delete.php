<?php
// Sessão
session_start();
// Conexão
require_once '../../db_connect.php';
if(isset($_POST['btn-deletar-telefone'])):

	$idtelefone = mysqli_escape_string($connect, $_POST['id']);
    $idusuario = mysqli_escape_string($connect, $_POST['idusuario']);
    $idcontato = mysqli_escape_string($connect, $_POST['idcontato']);
	$idcliente = mysqli_escape_string($connect, $_POST['idcliente']);

	$sql = "DELETE FROM TELEFONE WHERE IDTELEFONE = '$idtelefone'";

	if(mysqli_query($connect, $sql)):
		header('Location: ../../../view/contato/view.php?user='.$idusuario.'&idcliente='.$idcliente.'&id='.$idcontato.'&del');
	else:
		header('Location: ../../../view/contato/view.php?user='.$idusuario.'&idcliente='.$idcliente.'&id='.$idcontato.'&errordel');
	endif;
endif;