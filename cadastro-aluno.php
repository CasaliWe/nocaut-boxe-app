<?php
   require __DIR__ . '/config/config.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
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

    <link rel="icon" href="<?php echo $base_url ?>assets/imagens/favicon-admin/favicon-admin.png">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo $base_url ?>assets/css-global/style.css">

    <title><?= $_ENV['NOME_SITE']; ?> | Cadastro de aluno</title>
</head>
<body class="bg-light">
    <?php include_once  __DIR__ . '/modulos-admin/loading/index.php'; ?>

    <?php include_once  __DIR__ . '/modulos-admin/contents/cadastro-aluno/index.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>
