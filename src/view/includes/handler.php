<?php
session_start();
include 'functions.php';

if(isset($_POST['submit'])) {
    flash("msg", "Sucesso!");

    header("Location: ../../index.php");

}