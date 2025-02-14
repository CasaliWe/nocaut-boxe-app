<?php 

    session_start();

    unset($_SESSION['login']); 
    unset($_SESSION['nome-user']); 
    unset($_SESSION['tipo-user']); 

    header("Location: ../pages/auth/login.php");

    exit;

?>