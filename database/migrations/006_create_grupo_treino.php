<?php

$sql = "
    CREATE TABLE IF NOT EXISTS grupo_treino (
        id INT UNSIGNED NOT NULL AUTO_INCREMENT,
        id_grupo_treino INT UNSIGNED NULL,
        id_treino INT UNSIGNED NULL,
        identificador_bloco VARCHAR(255) NULL,
        PRIMARY KEY (id),
        KEY idx_grupo_treino_id_grupo_treino (id_grupo_treino),
        KEY idx_grupo_treino_id_treino (id_treino),
        KEY idx_grupo_treino_identificador_bloco (identificador_bloco)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
";

return [
    'name' => '006_create_grupo_treino',
    'sql' => $sql,
    'up' => static function (PDO $pdo) use ($sql): void {
        $pdo->exec($sql);
    },
];
