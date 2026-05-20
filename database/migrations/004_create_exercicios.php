<?php

$sql = "
    CREATE TABLE IF NOT EXISTS exercicios (
        id INT UNSIGNED NOT NULL AUTO_INCREMENT,
        nome VARCHAR(255) NULL,
        gif VARCHAR(255) NULL,
        grupo_exercicios_id INT UNSIGNED NULL,
        PRIMARY KEY (id),
        KEY idx_exercicios_grupo_exercicios_id (grupo_exercicios_id)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
";

return [
    'name' => '004_create_exercicios',
    'sql' => $sql,
    'up' => static function (PDO $pdo) use ($sql): void {
        $pdo->exec($sql);
    },
];
