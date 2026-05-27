<?php

$sql = "
    CREATE TABLE IF NOT EXISTS aluno_solicitacoes (
        id INT UNSIGNED NOT NULL AUTO_INCREMENT,
        nome VARCHAR(255) NOT NULL,
        rua VARCHAR(255) NULL,
        numero VARCHAR(50) NULL,
        bairro VARCHAR(255) NULL,
        cep VARCHAR(20) NULL,
        tipo_documento VARCHAR(30) NULL,
        documento VARCHAR(50) NULL,
        telefone_contato VARCHAR(30) NULL,
        telefone_emergencia VARCHAR(30) NULL,
        responsavel_nome VARCHAR(255) NULL,
        responsavel_telefone VARCHAR(30) NULL,
        data_nascimento DATE NULL,
        sexo VARCHAR(50) NULL,
        modalidade VARCHAR(50) NULL,
        autoriza_imagem TINYINT(1) NOT NULL DEFAULT 0,
        tem_problema_saude TINYINT(1) NOT NULL DEFAULT 0,
        descricao_problema_saude TEXT NULL,
        facebook VARCHAR(255) NULL,
        instagram VARCHAR(255) NULL,
        observacoes TEXT NULL,
        status VARCHAR(30) NOT NULL DEFAULT 'pendente',
        aprovado_em DATETIME NULL,
        created_at DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
        updated_at DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (id),
        KEY idx_aluno_solicitacoes_status (status),
        KEY idx_aluno_solicitacoes_nome (nome),
        KEY idx_aluno_solicitacoes_created_at (created_at)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
";

return [
    'name' => '010_create_aluno_solicitacoes',
    'sql' => $sql,
    'up' => static function (PDO $pdo) use ($sql): void {
        $pdo->exec($sql);
    },
];
