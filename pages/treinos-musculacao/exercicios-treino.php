<?php
   //verifica auth;
   include_once __DIR__ . '/../../helpers/verifica-auth.php';

   //importa configurações;
   require __DIR__ . '/../../config/config.php';

   // Pegando os dados do treino do aluno
   use Repositories\AlunoTreinoMusculacaoRepository;
   $treino_aluno = AlunoTreinoMusculacaoRepository::getTreinoAluno($_GET['id']);

   // Pegando os grupos de exercícios para colocar no select
   use Repositories\ExerciciosRepository;
   $exercicios_grupos = ExerciciosRepository::getAllGrupos();

   // Pegando os grupos de treino do aluno
   use Repositories\GrupoTreinoRepository;
   $grupos_treino = GrupoTreinoRepository::getAll($_GET['id']);
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
        <?php include_once  __DIR__ . '/../../modulos-admin/contents/exercicios-treino/index.php';?>
        <!-- módulo content página -->
    </main>
    <!-- CONTENT -->

    
    <!-- MODAL AVISOS -->
     <?php include_once  __DIR__ . "/../../modulos-admin/modal-aviso/index.php"; ?>
    <!-- MODAL AVISOS -->

    <!-- MODAL ADICIONAR EXERCÍCIO TREINO -->
    <?php include_once  __DIR__ . "/../../modulos-admin/contents/exercicios-treino/modais/adicionar-exercicio-grupo.php"; ?>
    <!-- MODAL ADICIONAR EXERCÍCIO TREINO -->

    <!-- MODAL DELETAR EXERCÍCIO COMPLETO -->
    <?php include_once  __DIR__ . "/../../modulos-admin/contents/exercicios-treino/modais/deletar-exercicio-completo.php"; ?>
    <!-- MODAL DELETAR EXERCÍCIO COMPLETO -->

    <!-- MODAL DELETAR GRUPO COMPLETO -->
    <?php include_once  __DIR__ . "/../../modulos-admin/contents/exercicios-treino/modais/deletar-grupo-completo.php"; ?>
    <!-- MODAL DELETAR GRUPO COMPLETO -->

    <!-- MODAL GIF FULLSCREEN -->
    <?php include_once  __DIR__ . "/../../modulos-admin/modal-gif-full-screen/index.php"; ?>
    <!-- MODAL GIF FULLSCREEN -->


    <!--BOOTSTRAP JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
        
</body>
</html>