<?php
// Sessão
session_start();
// Conexão
require_once '../../db_connect.php';

if(isset($_POST['btn-editar-telefone'])):
	$ddd = mysqli_escape_string($connect, $_POST['ddd']);
    $telefone = mysqli_escape_string($connect, $_POST['numero']);
	$idtelefone = mysqli_escape_string($connect, $_POST['id']);
    $idcliente = mysqli_escape_string($connect, $_POST['idcliente']);
    $idcontato = mysqli_escape_string($connect, $_POST['idcontato']);
    $idusuario = mysqli_escape_string($connect, $_POST['idusuario']);

	$sql = "UPDATE TELEFONE SET DDD = '$ddd', NUMERO = '$telefone' WHERE IDTELEFONE = '$idtelefone'";

	if(mysqli_query($connect, $sql)):
		header('Location: ../../../view/contato/view.php?user='.$idusuario.'&idcliente='.$idcliente.'&id='.$idcontato.'&ok');
	else:
		header('Location: ../../../view/contato/view.php?user='.$idusuario.'&idcliente='.$idcliente.'&id='.$idcontato.'&error');
	endif;
endif;
