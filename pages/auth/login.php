<?php
    session_start();

    // verifica auth na pág de login;
    if(isset($_SESSION['login'])){
        header("Location: ../treinos-musculacao/treinos-musculacao.php");
        exit;
    }

    //importa configurações;
    require __DIR__ . '/../../config/config.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>

    <!-- HEADER -->
    <?php include_once __DIR__ . '/../../modulos-admin/header/index.php'; ?>
    <!-- HEADER -->

</head>
<body>

    <!-- LOADING -->
    <?php include_once __DIR__ . '/../../modulos-admin/loading/index.php'; ?>
    <!-- LOADING -->
    
    <!-- TELA DE LOGIN -->
    <?php include_once __DIR__ . '/../../modulos-admin/login/index.php'; ?>
    <!-- TELA DE LOGIN -->



    

    <!--BOOTSTRAP JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
        
</body>
</html>