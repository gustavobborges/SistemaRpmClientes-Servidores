<?php
// Sessão
session_start();
// Conexão
require_once '../../db_connect.php';
if(isset($_POST['btn-deletar-acesso'])):

	$id = mysqli_escape_string($connect, $_POST['id']);
	$idservidor = mysqli_escape_string($connect, $_POST['idservidor']);
	$idservicocliente = mysqli_escape_string($connect, $_POST['idservicocliente']);
	$idusuario = mysqli_escape_string($connect, $_POST['idusuario']);
    	
	$sql = "DELETE FROM ACESSO WHERE IDACESSO = '$id'";

	if(mysqli_query($connect, $sql)):
		header('Location: ../../../view/servidor/view.php?user='.$idusuario.'&idservicocliente='.$idservicocliente.'&id='.$idservidor.'&del');
	else:
		header('Location: ../../../view/servidor/view.php?user='.$idusuario.'&idservicocliente='.$idservicocliente.'&id='.$idservidor.'&errordel');
	endif;
endif;