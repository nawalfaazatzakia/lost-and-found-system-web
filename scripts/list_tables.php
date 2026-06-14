<?php
try {
    $pdo = new PDO('sqlite:' . __DIR__ . '/../database/database.sqlite');
    $stmt = $pdo->query("SELECT name FROM sqlite_master WHERE type='table' ORDER BY name");
    foreach ($stmt as $row) {
        echo $row['name'] . PHP_EOL;
    }
} catch (Throwable $e) {
    echo get_class($e) . ': ' . $e->getMessage() . PHP_EOL;
}
