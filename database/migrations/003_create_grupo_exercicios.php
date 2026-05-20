<?php

$sql = "
    CREATE TABLE IF NOT EXISTS grupo_exercicios (
        id INT UNSIGNED NOT NULL AUTO_INCREMENT,
        nome VARCHAR(255) NULL,
        PRIMARY KEY (id)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
";

return [
    'name' => '003_create_grupo_exercicios',
    'sql' => $sql,
    'up' => static function (PDO $pdo) use ($sql): void {
        $pdo->exec($sql);
    },
];
