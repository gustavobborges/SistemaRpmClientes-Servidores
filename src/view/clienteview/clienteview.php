<?php
//Conexão
include_once '../../model/db_connect.php';
//Header
include_once '../../view/includes/header.php';
//Toastr
include_once '../includes/toastr.php';


if(isset($_GET['user'])) {
        $idusuario = $_GET['user'];
    }
?>

<?php 

include_once 'cards.php';

include_once '../servicocliente/sclista.php';

include_once '../contato/clista.php';

?>

<link type="text/css" rel="stylesheet" href="style.css">

<?php

//Footer
include_once '../includes/footer.php';
?>
