<?php
   //verifica auth;
   include_once __DIR__ . '/../../helpers/verifica-auth.php';

   //importa configurações;
   require __DIR__ . '/../../config/config.php';

   use Repositories\ExerciciosRepository;
   $exercicios_grupos = ExerciciosRepository::getAll();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>

    <!-- HEADER -->
    <?php include_once  __DIR__ . '/../../modulos-admin/header/index.php'; ?>
    <!-- HEADER -->

</head>
<body>

    <!-- LOADING -->
    <?php include_once  __DIR__ . '/../../modulos-admin/loading/index.php'; ?>
    <!-- LOADING -->

    <!-- NAVEGAÇÃO -->
    <?php include_once  __DIR__ . '/../../modulos-admin/navegacao/index.php'; ?>
    <!-- NAVEGAÇÃO -->


    <!-- CONTENT -->
    <main id="content-pagina">
        <h5 id="titulo-content-pagina" class="fw-semibold"><?php echo $tituloContentPagina ?></h5>

        <!-- módulo content página -->
        <?php include_once  __DIR__ . '/../../modulos-admin/contents/adicionar-exercicios-musculacao/index.php';?>
        <!-- módulo content página -->
    </main>
    <!-- CONTENT -->

    
    <!-- MODAL AVISOS -->
     <?php include_once  __DIR__ . "/../../modulos-admin/modal-aviso/index.php"; ?>
    <!-- MODAL AVISOS -->

    <!-- MODAL EDITAR EXERCÍCIO -->
    <?php include_once  __DIR__ . "/../../modulos-admin/contents/adicionar-exercicios-musculacao/modais/editar-exercicio.php"; ?>
    <!-- MODAL EDITAR EXERCÍCIO -->

    <!-- MODAL DELETAR EXERCÍCIO -->
    <?php include_once  __DIR__ . "/../../modulos-admin/contents/adicionar-exercicios-musculacao/modais/deletar-exercicio.php"; ?>
    <!-- MODAL DELETAR EXERCÍCIO -->
         
    <!-- MODAL ADD GRUPO -->
    <?php include_once  __DIR__ . "/../../modulos-admin/contents/adicionar-exercicios-musculacao/modais/add-grupo.php"; ?>
    <!-- MODAL ADD GRUPO -->

    <!-- MODAL DELETAR GRUPO -->
    <?php include_once  __DIR__ . "/../../modulos-admin/contents/adicionar-exercicios-musculacao/modais/deletar-grupo.php"; ?>
    <!-- MODAL DELETAR GRUPO -->

    <!-- MODAL EDITAR GRUPO -->
    <?php include_once  __DIR__ . "/../../modulos-admin/contents/adicionar-exercicios-musculacao/modais/editar-grupo.php"; ?>
    <!-- MODAL EDITAR GRUPO -->

    <!-- MODAL GIF FULLSCREEN -->
    <?php include_once  __DIR__ . "/../../modulos-admin/modal-gif-full-screen/index.php"; ?>
    <!-- MODAL GIF FULLSCREEN -->



    <!--BOOTSTRAP JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
        
</body>
</html>