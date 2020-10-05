<?php
// Sessão
session_start();
// Conexão
require_once '../../../db_connect.php';

if(isset($_POST['btn-editar-servidor-todos'])):
	$id = mysqli_escape_string($connect, $_POST['id']);
	$idusuario = mysqli_escape_string($connect, $_POST['idusuario']);
	
	$nome = mysqli_escape_string($connect, $_POST['nome']);	
	$acesso = mysqli_escape_string($connect, $_POST['acesso']);	
	$idcliente = mysqli_escape_string($connect, $_POST['clientlist']);
	$idservicocliente = mysqli_escape_string($connect, $_POST['servicos']);
	
	$sqls = "SELECT * FROM SERVICOCLIENTE WHERE IDSERVICOCLIENTE = '$idservicocliente'";
	$resultado = mysqli_query($connect, $sqls);
	$dados = mysqli_fetch_array($resultado);
	$idservico = $dados['IDSERVICO'];


	$sql = "UPDATE SERVIDOR SET NOME = '$nome', ACESSO = '$acesso', IDCLIENTE = '$idcliente', IDSERVICOCLIENTE = '$idservicocliente', IDSERVICO = '$idservico' WHERE IDSERVIDOR = '$id'";
	
	if(mysqli_query($connect, $sql)):
		header('Location: ../../../../view/servidor/servidortodos.php?user='.$idusuario.'&ok');
	else:
		header('Location: ../../../../view/servidor/servidortodos.php?user='.$idusuario.'&error');
	endif;
endif;