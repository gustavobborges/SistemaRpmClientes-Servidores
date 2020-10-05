<?php
// Sessão
function flash($name, $text = '') {
    if(isset($_SESSION[$name])) {
        $msg = $_SESSION[$name];
        unset($_SESSION[$name]);
        return $msg;
    } else {
        $_SESSION[$name] = $text;
    }
    return '';
}