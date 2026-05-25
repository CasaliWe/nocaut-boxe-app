<?php
   //verifica auth;
   include_once __DIR__ . '/../../helpers/verifica-auth.php';

   //importa configuracoes;
   require __DIR__ . '/../../config/config.php';

   use Repositories\ServicoValorRepository;
   $servicos_valores = ServicoValorRepository::getAll();
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

    <!-- NAVEGACAO -->
    <?php include_once  __DIR__ . '/../../modulos-admin/navegacao/index.php'; ?>
    <!-- NAVEGACAO -->


    <!-- CONTENT -->
    <main id="content-pagina">
        <h5 id="titulo-content-pagina" class="fw-semibold"><?php echo $tituloContentPagina ?></h5>

        <!-- modulo content pagina -->
        <?php include_once  __DIR__ . '/../../modulos-admin/contents/configuracoes/index.php';?>
        <!-- modulo content pagina -->
    </main>
    <!-- CONTENT -->

    <!-- MODAL AVISOS -->
     <?php include_once  __DIR__ . "/../../modulos-admin/modal-aviso/index.php"; ?>
    <!-- MODAL AVISOS -->

    <!-- MODAL ADD SERVICO VALOR -->
    <?php include_once  __DIR__ . "/../../modulos-admin/contents/configuracoes/modais/add-servico-valor.php"; ?>
    <!-- MODAL ADD SERVICO VALOR -->

    <!-- MODAL EDITAR SERVICO VALOR -->
    <?php include_once  __DIR__ . "/../../modulos-admin/contents/configuracoes/modais/editar-servico-valor.php"; ?>
    <!-- MODAL EDITAR SERVICO VALOR -->

    <!-- MODAL DELETAR SERVICO VALOR -->
    <?php include_once  __DIR__ . "/../../modulos-admin/contents/configuracoes/modais/deletar-servico-valor.php"; ?>
    <!-- MODAL DELETAR SERVICO VALOR -->


    <!--BOOTSTRAP JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>
</html>
