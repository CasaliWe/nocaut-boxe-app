<?php

    session_start();

    // verificação auth
    if(!isset($_SESSION['login'])){
        header("Location: ../auth/login.php");
        exit;
    }

?>