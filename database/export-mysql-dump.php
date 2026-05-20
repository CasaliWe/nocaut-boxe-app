<?php

require_once __DIR__ . '/connection.php';

$sqlite = sqlite_pdo();
$output = $argv[1] ?? __DIR__ . '/../backups/mysql/mysql_migration_' . date('Ymd_His') . '.sql';
$directory = dirname($output);

if (!is_dir($directory)) {
    mkdir($directory, 0777, true);
}

$tables = [
    'admins',
    'aluno_treino_musculacao',
    'grupo_exercicios',
    'exercicios',
    'bloco_exercicio',
    'grupo_treino',
    'exercicio_completo',
];

$handle = fopen($output, 'wb');

if ($handle === false) {
    throw new RuntimeException('Nao foi possivel criar o arquivo SQL: ' . $output);
}

function write_sql($handle, string $sql = ''): void
{
    fwrite($handle, rtrim($sql) . PHP_EOL);
}

function mysql_literal(PDO $sqlite, mixed $value): string
{
    if ($value === null) {
        return 'NULL';
    }

    return $sqlite->quote((string) $value);
}

write_sql($handle, '-- Dump gerado a partir do SQLite atual do Nocaut Boxe');
write_sql($handle, '-- Gerado em: ' . date('Y-m-d H:i:s'));
write_sql($handle);
write_sql($handle, 'SET NAMES utf8mb4;');
write_sql($handle, 'SET FOREIGN_KEY_CHECKS=0;');
write_sql($handle);
write_sql($handle, '
CREATE TABLE IF NOT EXISTS schema_migrations (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    migration VARCHAR(255) NOT NULL,
    executed_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    UNIQUE KEY uq_schema_migrations_migration (migration)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
');

foreach (migration_files() as $file) {
    $migration = require $file;
    write_sql($handle, trim($migration['sql']) . ';');
    write_sql($handle);
}

foreach (migration_files() as $file) {
    $migration = require $file;
    write_sql($handle, "INSERT IGNORE INTO schema_migrations (migration) VALUES (" . $sqlite->quote($migration['name']) . ");");
}

write_sql($handle);

foreach ($tables as $table) {
    $columns = $sqlite
        ->query('PRAGMA table_info("' . str_replace('"', '""', $table) . '")')
        ->fetchAll();

    $columnNames = array_map(static fn (array $column): string => $column['name'], $columns);
    $quotedColumns = array_map('quote_mysql_identifier', $columnNames);
    $rows = $sqlite
        ->query('SELECT * FROM "' . str_replace('"', '""', $table) . '" ORDER BY id')
        ->fetchAll();

    write_sql($handle, '-- Dados: ' . $table . ' (' . count($rows) . ' registros)');

    foreach ($rows as $row) {
        $values = [];

        foreach ($columnNames as $columnName) {
            $values[] = mysql_literal($sqlite, $row[$columnName]);
        }

        write_sql(
            $handle,
            'INSERT INTO ' . quote_mysql_identifier($table) .
            ' (' . implode(', ', $quotedColumns) . ') VALUES (' . implode(', ', $values) . ');'
        );
    }

    $nextId = ((int) $sqlite->query('SELECT COALESCE(MAX(id), 0) + 1 FROM "' . str_replace('"', '""', $table) . '"')->fetchColumn());
    write_sql($handle, 'ALTER TABLE ' . quote_mysql_identifier($table) . ' AUTO_INCREMENT = ' . max(1, $nextId) . ';');
    write_sql($handle);
}

write_sql($handle, 'SET FOREIGN_KEY_CHECKS=1;');
fclose($handle);

echo 'Dump MySQL gerado em: ' . $output . PHP_EOL;
