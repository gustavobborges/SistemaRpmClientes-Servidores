<?php
// Sessão
session_start();
// Conexão
require_once '../../db_connect.php';

if(isset($_POST['btn-editar-acesso'])):
	$id = mysqli_escape_string($connect, $_POST['id']);
    $acesso = mysqli_escape_string($connect, $_POST['acesso']);
	$idservidor = mysqli_escape_string($connect, $_POST['idservidor']);
	$idservicocliente = mysqli_escape_string($connect, $_POST['idservicocliente']);
	$idusuario = mysqli_escape_string($connect, $_POST['idusuario']);

	$sql = "UPDATE ACESSO SET ACESSO = '$acesso' WHERE IDACESSO = '$id'";

	if(mysqli_query($connect, $sql)):
		#------ MENSAGEM  ----------    $_SESSION['mensagem'] = "Atualizado com sucesso!";
		header('Location: ../../../view/servidor/view.php?user='.$idusuario.'&idservicocliente='.$idservicocliente.'&id='.$idservidor.'&ok');
	else:
		#------ MENSAGEM  ----------    $_SESSION['mensagem'] = "Erro ao atualizar";
		header('Location: ../../../view/servidor/view.php?user='.$idusuario.'&idservicocliente='.$idservicocliente.'&id='.$idservidor.'&error');
	endif;
endif;
