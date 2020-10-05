<?php
//Encerrando a sessão

//Sessão
session_start();
session_unset();
session_destroy();
header('Location: index.php');


?>