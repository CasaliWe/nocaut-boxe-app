<?php

$sql = "
    CREATE TABLE IF NOT EXISTS exercicio_completo (
        id INT UNSIGNED NOT NULL AUTO_INCREMENT,
        exercicio INT UNSIGNED NULL,
        carga VARCHAR(255) NULL,
        serie_rep VARCHAR(255) NULL,
        grupo_exercicios_id INT UNSIGNED NULL,
        PRIMARY KEY (id),
        KEY idx_exercicio_completo_exercicio (exercicio),
        KEY idx_exercicio_completo_grupo_exercicios_id (grupo_exercicios_id)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
";

return [
    'name' => '007_create_exercicio_completo',
    'sql' => $sql,
    'up' => static function (PDO $pdo) use ($sql): void {
        $pdo->exec($sql);
    },
];
