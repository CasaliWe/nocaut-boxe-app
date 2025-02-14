<?php
   //importa configurações;
   require __DIR__ . '/config/config.php';

    // Pegando os dados do treino do aluno
    use Repositories\AlunoTreinoMusculacaoRepository;
    $treino_aluno = AlunoTreinoMusculacaoRepository::getTreinoAlunoUid($_GET['uid']);

    // Pegando os grupos de treino do aluno
   use Repositories\GrupoTreinoRepository;
   $grupos_treino = GrupoTreinoRepository::getAllUid($_GET['uid']);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>

    <!-- META TAGS -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta property="og:type" content="website">
    <meta property="og:image" content="<?php echo $base_url ?>assets/imagens/favicon-admin/thumb-admin.png">
    <meta property="og:image:width" content="310">
    <meta property="og:image:height" content="310">
    <meta property="og:title" content="<?php echo $title_site ?>">
    <meta name="description" content="<?php echo $descri_site ?>">
    <meta property="og:description" content="<?php echo $descri_site ?>">
    <meta property="og:url" content="<?php echo $base_url ?>">

    <!-- FAVICON -->
    <link rel="icon" href="<?php echo $base_url ?>assets/imagens/favicon-admin/favicon-admin.png">

    <!--FONTAWSOME-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <!--BOOSTRAP-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <!-- GLOBAL CSS -->
    <link rel="stylesheet" href="<?php echo $base_url ?>assets/css-global/style.css">

    <!-- BASE URL JS -->
    <script>
        var base_url = "<?= $_ENV['BASE_URL'] ?>";
    </script>

    <!-- GLOBAL JS -->
    <script src="<?php echo $base_url ?>assets/js-global/app.js"></script>


    <title><?php echo $pagAtual ?></title>

</head>
<body>

    <!-- LOADING -->
    <?php include_once  __DIR__ . '/modulos-admin/loading/index.php'; ?>
    <!-- LOADING -->

    <!-- CONTENT -->
    <?php include_once  __DIR__ . '/modulos-admin/contents/treino-aluno/index.php'; ?>
    <!-- CONTENT -->

    <!-- MODAL ALTERAR CARGA EXERCICIO -->
    <?php include_once  __DIR__ . '/modulos-admin/contents/treino-aluno/modais/alterar-carga-exercicio.php'; ?>
    <!-- MODAL ALTERAR CARGA EXERCICIO -->
    
    <!-- MODAL AVISOS -->
     <?php include_once  __DIR__ . "/modulos-admin/modal-aviso/index.php"; ?>
    <!-- MODAL AVISOS -->

    <!-- MODAL GIF FULLSCREEN -->
    <?php include_once  __DIR__ . "/modulos-admin/modal-gif-full-screen/index.php"; ?>
    <!-- MODAL GIF FULLSCREEN -->


    <!--BOOTSTRAP JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>





    <?php
        $uid = $_GET['uid'] ?? 'null';
    ?>
    <script>
        const uid = "<?= $uid; ?>";  // Passando o uid do PHP para o JavaScript

        // Criando o manifesto dinamicamente com o uid
        const dynamicManifest = {
            name: "Nocaut Boxe - Treino",
            short_name: "Treino",
            start_url: base_url + "/treino-aluno.php?uid=" + uid,  
            display: "standalone",
            background_color: "#ffffff",
            theme_color: "#000000",
            icons: [
                {
                    "src": base_url + "/assets/imagens/site-admin/logo.png",  
                    "sizes": "300x300",
                    "type": "image/png"
                }
            ]
        };


        const stringManifest = JSON.stringify(dynamicManifest);  
        const blob = new Blob([stringManifest], { type: "application/json" });
        const manifestURL = URL.createObjectURL(blob);

        const manifestLink = document.createElement("link");
        manifestLink.rel = "manifest";
        manifestLink.href = manifestURL; 
        document.head.appendChild(manifestLink);
    </script>


        
</body>
</html>