<?php

$sql = "
    CREATE TABLE IF NOT EXISTS bloco_exercicio (
        id INT UNSIGNED NOT NULL AUTO_INCREMENT,
        identificador VARCHAR(255) NULL,
        nome_bloco VARCHAR(255) NULL,
        aluno_treino_id INT UNSIGNED NULL,
        PRIMARY KEY (id),
        KEY idx_bloco_exercicio_identificador (identificador),
        KEY idx_bloco_exercicio_aluno_treino_id (aluno_treino_id)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
";

return [
    'name' => '005_create_bloco_exercicio',
    'sql' => $sql,
    'up' => static function (PDO $pdo) use ($sql): void {
        $pdo->exec($sql);
    },
];
