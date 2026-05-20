<?php

require_once __DIR__ . '/connection.php';

try {
    $pdo = mysql_pdo();
} catch (PDOException $exception) {
    fwrite(STDERR, 'Nao foi possivel conectar no MySQL: ' . $exception->getMessage() . PHP_EOL);
    exit(1);
}

$pdo->exec("
    CREATE TABLE IF NOT EXISTS schema_migrations (
        id INT UNSIGNED NOT NULL AUTO_INCREMENT,
        migration VARCHAR(255) NOT NULL,
        executed_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (id),
        UNIQUE KEY uq_schema_migrations_migration (migration)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
");

$applied = $pdo
    ->query('SELECT migration FROM schema_migrations ORDER BY migration')
    ->fetchAll(PDO::FETCH_COLUMN);

$applied = array_flip($applied);
$ran = 0;

foreach (migration_files() as $file) {
    $migration = require $file;
    $name = $migration['name'] ?? basename($file, '.php');

    if (isset($applied[$name])) {
        echo "[skip] {$name}" . PHP_EOL;
        continue;
    }

    echo "[run] {$name}" . PHP_EOL;
    $migration['up']($pdo);

    $stmt = $pdo->prepare('INSERT INTO schema_migrations (migration) VALUES (?)');
    $stmt->execute([$name]);
    $ran++;
}

echo $ran === 0
    ? "Nenhuma migration pendente." . PHP_EOL
    : "Migrations executadas: {$ran}" . PHP_EOL;
