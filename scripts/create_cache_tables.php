<?php
try {
    $path = __DIR__ . '/../database/database.sqlite';
    $pdo = new PDO('sqlite:' . $path);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $pdo->exec("CREATE TABLE IF NOT EXISTS cache (
        `key` TEXT PRIMARY KEY,
        value TEXT,
        expiration INTEGER
    )");

    $pdo->exec("CREATE TABLE IF NOT EXISTS cache_locks (
        `key` TEXT PRIMARY KEY,
        owner TEXT,
        expiration INTEGER,
        created_at DATETIME,
        updated_at DATETIME
    )");

    echo "cache tables created\n";
} catch (Throwable $e) {
    echo get_class($e) . ': ' . $e->getMessage() . PHP_EOL;
}
