
<?php

$sourceFolder = __DIR__.'/../assets/imagens/arquivos/gifs-musculacao/';
$backupDir = __DIR__.'/../backups/arquivos/gifs-musculacao/';
$backupFolder = $backupDir . 'backup_' . date('d-m-Y') . '/';

function copyFolder(string $source, string $destination): void {
    if (!is_dir($source)) {
        die("A pasta de origem não existe.");
    }
    
    if (!is_dir($destination)) {
        mkdir($destination, 0777, true);
    }
    
    $files = scandir($source);
    foreach ($files as $file) {
        if ($file === '.' || $file === '..') {
            continue;
        }
        
        $srcPath = rtrim($source, '/') . '/' . $file;
        $destPath = rtrim($destination, '/') . '/' . $file;
        
        if (is_dir($srcPath)) {
            copyFolder($srcPath, $destPath);
        } else {
            copy($srcPath, $destPath);
        }
    }
}

copyFolder($sourceFolder, $backupFolder);

header('Location: ../pages/backups/backups-sistema.php?backup=true');
exit;