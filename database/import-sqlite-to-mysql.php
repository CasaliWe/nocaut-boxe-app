<?php

require_once __DIR__ . '/connection.php';

$truncate = in_array('--truncate', $argv, true);
$sqlite = sqlite_pdo();

try {
    $mysql = mysql_pdo();
} catch (PDOException $exception) {
    fwrite(STDERR, 'Nao foi possivel conectar no MySQL: ' . $exception->getMessage() . PHP_EOL);
    exit(1);
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

function table_count(PDO $pdo, string $table): int
{
    return (int) $pdo->query('SELECT COUNT(*) FROM ' . quote_mysql_identifier($table))->fetchColumn();
}

if ($truncate) {
    echo "Limpando tabelas MySQL antes da importacao..." . PHP_EOL;
    $mysql->exec('SET FOREIGN_KEY_CHECKS=0');

    foreach (array_reverse($tables) as $table) {
        $mysql->exec('TRUNCATE TABLE ' . quote_mysql_identifier($table));
    }

    $mysql->exec('SET FOREIGN_KEY_CHECKS=1');
} else {
    foreach ($tables as $table) {
        if (table_count($mysql, $table) > 0) {
            fwrite(STDERR, "Abortado: a tabela MySQL {$table} ja tem dados. Use --truncate apenas se quiser sobrescrever." . PHP_EOL);
            exit(1);
        }
    }
}

$mysql->beginTransaction();

try {
    foreach ($tables as $table) {
        $columns = $sqlite
            ->query('PRAGMA table_info("' . str_replace('"', '""', $table) . '")')
            ->fetchAll();

        $columnNames = array_map(static fn (array $column): string => $column['name'], $columns);
        $quotedColumns = array_map('quote_mysql_identifier', $columnNames);
        $placeholders = implode(', ', array_fill(0, count($columnNames), '?'));

        $insert = $mysql->prepare(
            'INSERT INTO ' . quote_mysql_identifier($table) .
            ' (' . implode(', ', $quotedColumns) . ') VALUES (' . $placeholders . ')'
        );

        $rows = $sqlite
            ->query('SELECT * FROM "' . str_replace('"', '""', $table) . '" ORDER BY id')
            ->fetchAll();

        foreach ($rows as $row) {
            $values = [];

            foreach ($columnNames as $columnName) {
                $values[] = $row[$columnName];
            }

            $insert->execute($values);
        }

        echo "[import] {$table}: " . count($rows) . " registros" . PHP_EOL;
    }

    $mysql->commit();
} catch (Throwable $exception) {
    if ($mysql->inTransaction()) {
        $mysql->rollBack();
    }

    throw $exception;
}

foreach ($tables as $table) {
    $nextId = (int) $mysql
        ->query('SELECT COALESCE(MAX(id), 0) + 1 FROM ' . quote_mysql_identifier($table))
        ->fetchColumn();

    $mysql->exec('ALTER TABLE ' . quote_mysql_identifier($table) . ' AUTO_INCREMENT = ' . max(1, $nextId));
}

$errors = [];

foreach ($tables as $table) {
    $sqliteCount = (int) $sqlite->query('SELECT COUNT(*) FROM "' . str_replace('"', '""', $table) . '"')->fetchColumn();
    $mysqlCount = table_count($mysql, $table);

    echo "[check] {$table}: sqlite={$sqliteCount} mysql={$mysqlCount}" . PHP_EOL;

    if ($sqliteCount !== $mysqlCount) {
        $errors[] = "{$table}: contagem diferente";
    }
}

$integrityChecks = [
    'exercicios_sem_grupo' => "
        SELECT COUNT(*)
        FROM exercicios e
        LEFT JOIN grupo_exercicios g ON g.id = e.grupo_exercicios_id
        WHERE e.grupo_exercicios_id IS NOT NULL AND g.id IS NULL
    ",
    'grupo_treino_sem_grupo_exercicios' => "
        SELECT COUNT(*)
        FROM grupo_treino gt
        LEFT JOIN grupo_exercicios g ON g.id = gt.id_grupo_treino
        WHERE gt.id_grupo_treino IS NOT NULL AND g.id IS NULL
    ",
    'grupo_treino_sem_treino' => "
        SELECT COUNT(*)
        FROM grupo_treino gt
        LEFT JOIN aluno_treino_musculacao a ON a.id = gt.id_treino
        WHERE gt.id_treino IS NOT NULL AND a.id IS NULL
    ",
    'exercicio_completo_sem_exercicio' => "
        SELECT COUNT(*)
        FROM exercicio_completo ec
        LEFT JOIN exercicios e ON e.id = ec.exercicio
        WHERE ec.exercicio IS NOT NULL AND e.id IS NULL
    ",
    'exercicio_completo_sem_grupo_treino' => "
        SELECT COUNT(*)
        FROM exercicio_completo ec
        LEFT JOIN grupo_treino gt ON gt.id = ec.grupo_exercicios_id
        WHERE ec.grupo_exercicios_id IS NOT NULL AND gt.id IS NULL
    ",
    'bloco_sem_treino' => "
        SELECT COUNT(*)
        FROM bloco_exercicio b
        LEFT JOIN aluno_treino_musculacao a ON a.id = b.aluno_treino_id
        WHERE b.aluno_treino_id IS NOT NULL AND a.id IS NULL
    ",
    'uid_duplicado' => "
        SELECT COUNT(*)
        FROM (
            SELECT uid
            FROM aluno_treino_musculacao
            WHERE uid IS NOT NULL AND uid <> ''
            GROUP BY uid
            HAVING COUNT(*) > 1
        ) duplicados
    ",
];

foreach ($integrityChecks as $name => $sql) {
    $count = (int) $mysql->query($sql)->fetchColumn();
    echo "[integrity] {$name}: {$count}" . PHP_EOL;

    if ($count !== 0) {
        $errors[] = "{$name}: {$count}";
    }
}

if ($errors) {
    fwrite(STDERR, "Importacao finalizada com problemas:" . PHP_EOL . implode(PHP_EOL, $errors) . PHP_EOL);
    exit(1);
}

echo "Importacao concluida e validada com sucesso." . PHP_EOL;
