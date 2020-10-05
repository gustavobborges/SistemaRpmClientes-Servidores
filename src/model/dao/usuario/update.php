<?php
// Sessão
session_start();
// Conexão
require_once '../../db_connect.php';

if(isset($_POST['btn-editar-usuario'])):
	$nome = mysqli_escape_string($connect, $_POST['nome']);	
	$login = mysqli_escape_string($connect, $_POST['login']);	
	$senha = mysqli_escape_string($connect, $_POST['senha']);	
	$estado = mysqli_escape_string($connect, $_POST['estadolist']);	
	$tipo = mysqli_escape_string($connect, $_POST['usertypelist']);	
	$id = mysqli_escape_string($connect, $_POST['id']);
	$idusuario = mysqli_escape_string($connect, $_POST['idusuario']);

	$sql = "UPDATE USUARIO SET NOME = '$nome', LOGINUSUARIO = '$login', SENHA = '$senha', ESTADO = '$estado', IDTIPOUSUARIO = '$tipo' WHERE IDUSUARIO = '$id'";

	if(mysqli_query($connect, $sql)):
		header('Location: ../../../view/usuario/usuariolista.php?user='.$idusuario.'&ok');
	else:
		header('Location: ../../../view/usuario/usuariolista.php?user='.$idusuario.'&error');
	endif;
endif;