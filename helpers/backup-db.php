<?php


$databaseFile = __DIR__.'/../db/db.sqlite';
$backupDir = __DIR__.'/../backups/db/';
$backupFile = $backupDir . 'backup_' . date('d-m-Y') . '.sqlite';

if (copy($databaseFile, $backupFile)) {
    header('Location: ../pages/backups/backups-sistema.php?backup=true');
    exit;
} else {
    header('Location: ../pages/backups/backups-sistema.php?error=true');
    exit;
}

