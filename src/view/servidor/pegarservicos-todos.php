<?php

//Conexão com o Banco de Dados:
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sistemaibridgeLTE3";

$connect = mysqli_connect($servername, $username, $password, $dbname);
mysqli_set_charset($connect, "utf8");

$id = $_POST['id'];

$sql = "SELECT 
        SERVICOCLIENTE.IDSERVICOCLIENTE AS IDSERVICOCLIENTE,
        SERVICOCLIENTE.IDCLIENTE,
        SERVICOCLIENTE.IDSERVICO,
        SERVICO.IDSERVICO,
        SERVICO.NOME

        FROM SERVICOCLIENTE LEFT JOIN SERVICO
        ON SERVICOCLIENTE.IDSERVICO = SERVICO.IDSERVICO        
        WHERE IDCLIENTE = '$id' ";

$resultado = mysqli_query($connect, $sql);

// if(isset($_GET['id'])) {
//     while ($posicao=mysqli_fetch_row($resultado)) {
//     $dados = mysqli_fetch_array($resultado);
//     $vidservico=$posicao[2];
//     $vnomeservico=$posicao[4];
//     $vid=$posicao[0];
//     $idservicocliente = $dados['IDSERVICOCLIENTE'];

//     $selected = ($vid == $idservicocliente) ? "selected='selected'" : "";
//     echo "<option value='$vid'$selected> Id: $vid | Sistema: $vnomeservico</option>";
//     }
// }

// else {

while ($posicao=mysqli_fetch_row($resultado)):
    $vnomeservico=$posicao[4];
    $vid=$posicao[0];
    $selected = ($vid == $idservicocliente) ? "selected='selected'" : "";
    echo "<option value='$vid'$selected> Id: $vid | Sistema: $vnomeservico</option>";
endwhile;

// }

  /*  foreach($fetchAll as $servicos) {
        echo '<option>'.$servicos['IDSERVICOCLIENTE'].'</option>';
    }


    */