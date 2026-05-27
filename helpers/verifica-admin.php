<?php

include_once __DIR__ . '/verifica-auth.php';

if(($_SESSION['tipo-user'] ?? '') !== 'administrador'){
    header("Location: ../treinos-musculacao/treinos-musculacao.php?error=true");
    exit;
}

?>
