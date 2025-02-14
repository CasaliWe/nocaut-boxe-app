<?php
   //verifica auth;
   include_once __DIR__ . '/../../helpers/verifica-auth.php';

   //importa configurações;
   require __DIR__ . '/../../config/config.php';

   // verifica se tem o parametro pesquisa na url
   $pesquisa = isset($_GET['pesquisa']) ? $_GET['pesquisa'] : null;

   use Repositories\AlunoTreinoMusculacaoRepository;
   $aluno_treino_musculacao = AlunoTreinoMusculacaoRepository::getAll($pesquisa);
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
        <?php include_once  __DIR__ . '/../../modulos-admin/contents/treinos-musculacao/index.php';?>
        <!-- módulo content página -->
    </main>
    <!-- CONTENT -->
    
    <!-- MODAL LINK COPIADO -->
     <?php include_once  __DIR__ . "/../../modulos-admin/contents/treinos-musculacao/modais/modal-link-copiado.php"; ?>
    <!-- MODAL LINK COPIADO -->
             
    <!-- MODAL AVISOS -->
     <?php include_once  __DIR__ . "/../../modulos-admin/modal-aviso/index.php"; ?>
    <!-- MODAL AVISOS -->

    <!-- MODAL ADD TREINO MUSCULAÇÃO -->
    <?php include_once  __DIR__ . "/../../modulos-admin/contents/treinos-musculacao/modais/add-treino-musculacao.php"; ?>
    <!-- MODAL ADD TREINO MUSCULAÇÃO -->

    <!-- MODAL DELETAR TREINO MUSCULAÇÃO -->
    <?php include_once  __DIR__ . "/../../modulos-admin/contents/treinos-musculacao/modais/delete-treino-musculacao.php"; ?>
    <!-- MODAL DELETAR TREINO MUSCULAÇÃO -->


    <!--BOOTSTRAP JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
        
</body>
</html>