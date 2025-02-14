<link rel="stylesheet" href="<?php echo $base_url ?>modulos-admin/navegacao/css/style.css">


<!-- MOBILE -->
<div id="content-navegacao-mobile" class="px-5">
    <button id="btn-close" onclick="abrirNavMobile()"> <i class="fas fa-close fs-1 text-danger"></i> </button>

    <!-- NAVEGAÇÃO -->
    <?php include __DIR__ . "/nav/index.php";?>
    <!-- NAVEGAÇÃO -->

    <div id="footer-nav">
        <p class="small mb-0 fw-semibold">USUÁRIO ATIVO</p>
        <p class="small fw-bold text-danger"><?= $_SESSION['nome-user'] ?></p>
    </div>
</div>

<section id="header-navegacao-mobile" class="shadow-lg bg-dark">
    <img id="logo-nav-mobile" src="<?php echo $base_url ?>assets/imagens/site-admin/logo.png" alt="Logo">

    <button onclick="abrirNavMobile()" style="background-color: transparent; border: none; cursor: pointer;"> <i class="fas fa-bars fs-1 color-toggler"></i> </button>
</section>
<!-- MOBILE -->



<!-- DESKTOP -->
<aside id="navegacao-desktop" class="position-fixed left-0 vh-100 d-flex flex-column bg-secondary bg-opacity-25 shadow-lg">
    <div class="bg-dark py-4 w-100 px-3 d-flex justify-content-center align-items-center"><img class="w-50" src="<?php echo $base_url ?>assets/imagens/site-admin/logo.png" alt="Logo"></div>

    <!-- NAVEGAÇÃO -->
    <?php include __DIR__ . "/nav/index.php";?>
    <!-- NAVEGAÇÃO -->


    <div id="footer-nav">
        <p class="small mb-0 fw-semibold text-uppercase"><?= $_SESSION['tipo-user'] ?></p>
        <p class="small fw-bold text-danger"><?= $_SESSION['nome-user'] ?></p>
    </div>
</aside>
<!-- DESKTOP -->


<script src="<?php echo $base_url ?>modulos-admin/navegacao/js/app.js"></script>