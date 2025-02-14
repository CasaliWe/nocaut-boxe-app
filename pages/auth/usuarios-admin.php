<?php
   //verifica auth;
   include_once __DIR__ . '/../../helpers/verifica-auth.php';

   //importa configurações;
   require __DIR__ . '/../../config/config.php';

   //busca usuários do sistema;
   use Repositories\AdminsRepository;
   $usuarios = AdminsRepository::getAdmins();
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
        <?php include_once  __DIR__ . '/../../modulos-admin/contents/usuarios-admin/index.php';?>
        <!-- módulo content página -->
    </main>
    <!-- CONTENT -->

    
    <!-- MODAL AVISOS -->
     <?php include_once  __DIR__ . "/../../modulos-admin/modal-aviso/index.php"; ?>
    <!-- MODAL AVISOS -->

    <!-- MODAL ADD USER SISTEMA -->
    <?php include_once  __DIR__ . "/../../modulos-admin/contents/usuarios-admin/modais/add-usuario-sistema.php"; ?>
    <!-- MODAL ADD USER SISTEMA -->

    <!-- MODAL DELETE USER -->
    <?php include_once  __DIR__ . "/../../modulos-admin/contents/usuarios-admin/modais/aviso-delete.php"; ?>
    <!-- MODAL DELETE USER -->


    <!--BOOTSTRAP JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
        
</body>
</html>