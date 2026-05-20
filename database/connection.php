<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;

if (file_exists(__DIR__ . '/../.env')) {
    Dotenv::createImmutable(__DIR__ . '/../')->safeLoad();
}

function db_env(string $key, ?string $default = null): ?string
{
    $value = $_ENV[$key] ?? $_SERVER[$key] ?? getenv($key);

    if ($value === false || $value === null || $value === '') {
        return $default;
    }

    return $value;
}

function mysql_pdo(): PDO
{
    $host = db_env('DB_HOST', '127.0.0.1');
    $port = db_env('DB_PORT', '3306');
    $database = db_env('DB_DATABASE', '');
    $username = db_env('DB_USERNAME', '');
    $password = db_env('DB_PASSWORD', '');
    $charset = db_env('DB_CHARSET', 'utf8mb4');

    $dsn = "mysql:host={$host};port={$port};dbname={$database};charset={$charset}";

    return new PDO($dsn, $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);
}

function sqlite_pdo(): PDO
{
    $path = db_env('SQLITE_DATABASE', __DIR__ . '/../db/db.sqlite');

    if (!preg_match('/^([A-Za-z]:)?[\/\\\\]/', $path)) {
        $path = __DIR__ . '/../' . $path;
    }

    $pdo = new PDO('sqlite:' . $path);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    return $pdo;
}

function migration_files(): array
{
    $files = glob(__DIR__ . '/migrations/*.php') ?: [];
    sort($files, SORT_STRING);

    return $files;
}

function quote_mysql_identifier(string $identifier): string
{
    return '`' . str_replace('`', '``', $identifier) . '`';
}
