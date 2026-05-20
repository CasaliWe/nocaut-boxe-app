<?php

$sql = "
    CREATE TABLE IF NOT EXISTS aluno_treino_musculacao (
        id INT UNSIGNED NOT NULL AUTO_INCREMENT,
        uid VARCHAR(255) NULL,
        nome_aluno VARCHAR(255) NULL,
        tipo_treino VARCHAR(255) NULL,
        duracao_treino VARCHAR(255) NULL,
        regenerativo VARCHAR(255) NULL,
        modo_treino VARCHAR(255) NULL,
        intervalo VARCHAR(255) NULL,
        created_at DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
        updated_at DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (id),
        KEY idx_aluno_treino_uid (uid),
        KEY idx_aluno_treino_updated_at (updated_at)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
";

return [
    'name' => '002_create_aluno_treino_musculacao',
    'sql' => $sql,
    'up' => static function (PDO $pdo) use ($sql): void {
        $pdo->exec($sql);
    },
];
