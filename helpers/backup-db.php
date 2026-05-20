<?php

require_once __DIR__.'/../vendor/autoload.php';

use Dotenv\Dotenv;

Dotenv::createImmutable(__DIR__.'/../')->safeLoad();

$connection = $_ENV['DB_CONNECTION'] ?? 'sqlite';
$backupDir = __DIR__.'/../backups/db/';

if (!is_dir($backupDir)) {
    mkdir($backupDir, 0777, true);
}

if ($connection === 'mysql') {
    $backupFile = $backupDir . 'backup_' . date('d-m-Y') . '.sql';
    $host = escapeshellarg($_ENV['DB_HOST'] ?? '127.0.0.1');
    $port = escapeshellarg($_ENV['DB_PORT'] ?? '3306');
    $database = escapeshellarg($_ENV['DB_DATABASE'] ?? '');
    $username = escapeshellarg($_ENV['DB_USERNAME'] ?? '');
    $password = $_ENV['DB_PASSWORD'] ?? '';

    $command = sprintf(
        'mysqldump --host=%s --port=%s --user=%s --password=%s --single-transaction --quick --default-character-set=utf8mb4 %s > %s',
        $host,
        $port,
        $username,
        escapeshellarg($password),
        $database,
        escapeshellarg($backupFile)
    );

    exec($command, $output, $code);
    $success = $code === 0 && is_file($backupFile) && filesize($backupFile) > 0;
} else {
    $databaseFile = $_ENV['SQLITE_DATABASE'] ?? __DIR__.'/../db/db.sqlite';
    $backupFile = $backupDir . 'backup_' . date('d-m-Y') . '.sqlite';
    $success = copy($databaseFile, $backupFile);
}

if ($success) {
    header('Location: ../pages/backups/backups-sistema.php?backup=true');
    exit;
} else {
    header('Location: ../pages/backups/backups-sistema.php?error=true');
    exit;
}

