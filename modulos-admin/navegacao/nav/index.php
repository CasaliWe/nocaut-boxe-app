<?php
    // verificando qual página
    $urlAtual = $_SERVER['REQUEST_URI'];

    // titulos content páginas
    $tituloContentPagina = "";

    // link ativo página
    $activeTreinoMusculacao = false;
    $activeUsuariosAdmin = false;
    $activeCadastroExerciciosMusculacao = false;
    $activeEditarTreinoMusculacao = false;
    $activeExerciciosTreinoMusculacao = false;
    $activeBackups = false;

    // Devolve o nome da página atual
    if(strpos($urlAtual, 'treinos-musculacao.php') !== false){
        $tituloContentPagina = "Treinos Musculação";
        $activeTreinoMusculacao = true;
    }else if(strpos($urlAtual, 'usuarios-admin.php') !== false){
        $tituloContentPagina = "Usuários do sistema";
        $activeUsuariosAdmin = true;
    }else if(strpos($urlAtual, 'adicionar-exercicios-musculacao.php') !== false){
        $tituloContentPagina = "Cadastro de exercícios da musculação";
        $activeCadastroExerciciosMusculacao = true;
    }else if(strpos($urlAtual, 'editar-treino.php') !== false){
        $tituloContentPagina = "Editar treino";
        $activeEditarTreinoMusculacao = true;
    }else if(strpos($urlAtual, 'exercicios-treino.php') !== false){
        $tituloContentPagina = "Exercícios do treino";
        $activeExerciciosTreinoMusculacao = true;
    }else if(strpos($urlAtual, 'backups-sistema.php') !== false){
        $tituloContentPagina = "Backups do sistema";
        $activeBackups = true;
    }else{
        $tituloContentPagina = "Painel administrativo";
        $activeDashboard = true;
    }
?>




<nav class="d-flex flex-column w-100 mt-5 pt-5 mt-lg-0 pt-lg-0">
    <a href="<?= $base_url; ?>pages/treinos-musculacao/treinos-musculacao.php" class="link-nav-desktop <?= $activeTreinoMusculacao || $activeCadastroExerciciosMusculacao || $activeEditarTreinoMusculacao || $activeExerciciosTreinoMusculacao ? 'active-link-desktop' : ''; ?>">Treinos Musculação</a>
    <a href="<?= $base_url; ?>pages/auth/usuarios-admin.php" class="link-nav-desktop <?= $activeUsuariosAdmin ? 'active-link-desktop' : ''; ?>">Usuários do sistema</a>
    <a href="<?= $base_url; ?>pages/backups/backups-sistema.php" class="link-nav-desktop <?= $activeBackups ? 'active-link-desktop' : ''; ?>">Backups do sistema</a>
    <a class="link-nav-desktop"><?php include __DIR__ . "/../../btn-logout/index.php"; ?></a>
</nav>