<?php
   //verifica auth e permissao de administrador;
   include_once __DIR__ . '/../../helpers/verifica-admin.php';

   //importa configuracoes;
   require __DIR__ . '/../../config/config.php';
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
        <?php include_once  __DIR__ . '/../../modulos-admin/contents/entradas-saidas/index.php';?>
        <!-- modulo content pagina -->
    </main>
    <!-- CONTENT -->

    <!-- MODAL AVISOS -->
    <?php include_once  __DIR__ . "/../../modulos-admin/modal-aviso/index.php"; ?>
    <!-- MODAL AVISOS -->


    <!--BOOTSTRAP JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>
</html>
