<?php

//Conexão com o Banco de Dados:
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sistemaibridgeLTE3";

$connect = mysqli_connect($servername, $username, $password, $dbname);
mysqli_set_charset($connect, "utf8");


//TESTE DE CONEXÃO
if(mysqli_connect_error()):
    echo "Falha ao conectar com o Banco de Dados: ".mysqli_connect_error();
//else:
//    echo "Conexão bem sucedida";
endif;
