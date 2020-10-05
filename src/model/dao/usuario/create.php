<?php
// Sessão
session_start();
// Conexão
require_once '../../db_connect.php';
// Clear
function clear($input) {
	global $connect;
	// sql
	$var = mysqli_escape_string($connect, $input);
	// xss
	$var = htmlspecialchars($var);
	return $var;
}

if(isset($_POST['btn-cadastrar-usuario'])):
	$nome = clear($_POST['nome']);
	$login = clear($_POST['login']);
	$senha = clear($_POST['senha']);
	$estado = clear($_POST['estadolist']);
	$tipo = clear($_POST['usertypelist']);
	$idusuario = clear($_POST['idusuario']);
	

	$sql = "INSERT INTO USUARIO (NOME, LOGINUSUARIO, SENHA, ESTADO, IDTIPOUSUARIO) VALUES ('$nome', '$login', '$senha', '$estado', '$tipo') ";

	if(mysqli_query($connect, $sql)):
		header('Location: ../../../view/usuario/usuariolista.php?user='.$idusuario.'&ok');
	else:
		header('Location: ../../../view/usuario/usuariolista.php?user='.$idusuario.'&error');
	endif;
endif;