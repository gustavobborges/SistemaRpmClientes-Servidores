<?php
// Sessão
session_start();
// Conexão
require_once '../../../db_connect.php';
// Clear
function clear($input) {
	global $connect;
	// sql
	$var = mysqli_escape_string($connect, $input);
	// xss
	$var = htmlspecialchars($var);
	return $var;
}

if(isset($_POST['btn-cadastrar-servidor-todos'])):
	$idusuario = clear($_POST['idusuario']);

	$nome = clear($_POST['nome']);
	$acesso = clear($_POST['acesso']);
	$idcliente = clear($_POST['clientlist']);
	$id = clear($_POST['servicos']);

	$sqls = "SELECT * FROM SERVICOCLIENTE WHERE IDSERVICOCLIENTE = '$id'";
	$resultado = mysqli_query($connect, $sqls);
	$dados = mysqli_fetch_array($resultado);
	$idservico = $dados['IDSERVICO'];

	$sql = "INSERT INTO SERVIDOR (NOME, ACESSO, IDCLIENTE, IDSERVICO, IDSERVICOCLIENTE) VALUES ('$nome', '$acesso' , '$idcliente', '$idservico', '$id' )";

	if(mysqli_query($connect, $sql)):
		header('Location: ../../../../view/servidor/servidortodos.php?user='.$idusuario.'&ok');
	else:
		header('Location: ../../../../view/servidor/servidortodos.php?user='.$idusuario.'&error');
	endif;
	
endif;