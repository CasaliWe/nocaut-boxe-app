<?php

$sql = "
    CREATE TABLE IF NOT EXISTS admins (
        id INT UNSIGNED NOT NULL AUTO_INCREMENT,
        login VARCHAR(255) NOT NULL,
        senha VARCHAR(255) NOT NULL,
        nome VARCHAR(255) NOT NULL,
        tipo VARCHAR(255) NOT NULL,
        PRIMARY KEY (id),
        KEY idx_admins_login (login)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
";

return [
    'name' => '001_create_admins',
    'sql' => $sql,
    'up' => static function (PDO $pdo) use ($sql): void {
        $pdo->exec($sql);
    },
];
