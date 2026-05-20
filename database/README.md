# Banco de dados

Este projeto usa Eloquent sem Laravel completo. As migrations ficam em `database/migrations`, uma por tabela.

## Rodar migrations no MySQL

Configure no `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nome_do_banco
DB_USERNAME=usuario
DB_PASSWORD=senha
DB_CHARSET=utf8mb4
DB_COLLATION=utf8mb4_unicode_ci
```

Depois execute:

```bash
php database/migrate.php
```

## Importar dados do SQLite atual

Com as tabelas ja criadas no MySQL:

```bash
php database/import-sqlite-to-mysql.php
```

Se precisar refazer a importacao em um banco de teste, use:

```bash
php database/import-sqlite-to-mysql.php --truncate
```

Use `--truncate` somente quando tiver certeza de que pode limpar as tabelas do MySQL.

## Gerar um dump SQL para importar no servidor

Quando o MySQL remoto nao aceitar conexao externa, gere o arquivo:

```bash
php database/export-mysql-dump.php
```

Depois importe esse `.sql` dentro do servidor Ubuntu usando o cliente MySQL.
