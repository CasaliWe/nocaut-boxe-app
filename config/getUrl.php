<?php

    // Obtém a URL atual
    $urlAtual = $_SERVER['REQUEST_URI'];

    // Devolve o nome da página atual para colocar no título
    if(strpos($urlAtual, 'index.php') !== false){
        $pagAtual = $_ENV['NOME_SITE'];
    }else if(strpos($urlAtual, 'pages/auth/login.php') !== false){
        $pagAtual = $_ENV['NOME_SITE'] . ' | Login';
    }else if(strpos($urlAtual, 'treino-aluno.php') !== false){
        $pagAtual = $_ENV['NOME_SITE'] . ' | Treino do Aluno';
    }else{
        $pagAtual = $_ENV['NOME_SITE'];
    }