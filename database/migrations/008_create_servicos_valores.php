<?php

$sql = "
    CREATE TABLE IF NOT EXISTS servicos_valores (
        id INT UNSIGNED NOT NULL AUTO_INCREMENT,
        descricao VARCHAR(255) NOT NULL,
        valor DECIMAL(10,2) NOT NULL DEFAULT 0.00,
        created_at DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
        updated_at DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (id),
        KEY idx_servicos_valores_descricao (descricao)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
";

return [
    'name' => '008_create_servicos_valores',
    'sql' => $sql,
    'up' => static function (PDO $pdo) use ($sql): void {
        $pdo->exec($sql);
    },
];
