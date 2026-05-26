<?php

$sql = "
    CREATE TABLE IF NOT EXISTS alunos (
        id INT UNSIGNED NOT NULL AUTO_INCREMENT,
        nome VARCHAR(255) NOT NULL,
        data_inicio DATE NULL,
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
        servico_valor_id INT UNSIGNED NULL,
        pacote_descricao VARCHAR(255) NULL,
        valor_pacote DECIMAL(10,2) NOT NULL DEFAULT 0.00,
        juros_percentual DECIMAL(5,2) NOT NULL DEFAULT 0.00,
        desconto_percentual DECIMAL(5,2) NOT NULL DEFAULT 0.00,
        valor_final DECIMAL(10,2) NOT NULL DEFAULT 0.00,
        status VARCHAR(30) NOT NULL DEFAULT 'em aberto',
        data_pagamento DATE NULL,
        data_vencimento DATE NULL,
        created_at DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
        updated_at DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (id),
        KEY idx_alunos_nome (nome),
        KEY idx_alunos_modalidade (modalidade),
        KEY idx_alunos_status (status),
        KEY idx_alunos_data_vencimento (data_vencimento),
        KEY idx_alunos_data_nascimento (data_nascimento),
        KEY idx_alunos_servico_valor_id (servico_valor_id),
        CONSTRAINT fk_alunos_servico_valor_id
            FOREIGN KEY (servico_valor_id) REFERENCES servicos_valores(id)
            ON DELETE SET NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
";

return [
    'name' => '009_create_alunos',
    'sql' => $sql,
    'up' => static function (PDO $pdo) use ($sql): void {
        $pdo->exec($sql);
    },
];
