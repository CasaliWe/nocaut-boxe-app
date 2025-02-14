<?php

require __DIR__ . '/../../../../config/config.php';
use Repositories\ExerciciosRepository;

$id = $_POST['id'];
$gifDeletar = $_POST['gif-deletar'];
$nome = $_POST['nome'];
$gif;


if (isset($_FILES['gif']) && $_FILES['gif']['error'] != UPLOAD_ERR_NO_FILE) {
    $pastaDestino = __DIR__ . '/../../../../assets/imagens/arquivos/gifs-musculacao/';
    $dataHora = date('YmdHis');
    $nomeArquivo = $dataHora . basename($_FILES['gif']['name']);
    $caminhoDestino = $pastaDestino . $nomeArquivo;
    $gif = $nomeArquivo;

    move_uploaded_file($_FILES['gif']['tmp_name'], $caminhoDestino);

    unlink($pastaDestino . $gifDeletar);

    $res = ExerciciosRepository::updateExercicio($nome, $gif, $id);

    if(!$res){
        header('Location: ../../../../pages/treinos-musculacao/adicionar-exercicios-musculacao.php?error=true');
        exit;
    }else{
        header('Location: ../../../../pages/treinos-musculacao/adicionar-exercicios-musculacao.php?success=true');
        exit;
    }
}else{
    $res = ExerciciosRepository::updateExercicio($nome, $gif = null, $id);

    if(!$res){
        header('Location: ../../../../pages/treinos-musculacao/adicionar-exercicios-musculacao.php?error=true');
        exit;
    }else{
        header('Location: ../../../../pages/treinos-musculacao/adicionar-exercicios-musculacao.php?success=true');
        exit;
    }
}

