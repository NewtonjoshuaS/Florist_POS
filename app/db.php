<?php

/**
 * Simple PDO database connection helper.
 */

function db()
{
    static $pdo = null;

    if ($pdo !== null) {
        return $pdo;
    }

    $configPath = __DIR__ . '/config.php';
    if (!file_exists($configPath)) {
        $configPath = __DIR__ . '/config.example.php';
    }

    $config = require $configPath;
    $db = $config['db'];

    $dsn = sprintf(
        'mysql:host=%s;port=%d;dbname=%s;charset=%s',
        $db['host'],
        $db['port'],
        $db['database'],
        $db['charset']
    );

    try {
        $pdo = new PDO($dsn, $db['username'], $db['password'], [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);
    } catch (PDOException $e) {
        die('Database connection failed: ' . htmlspecialchars($e->getMessage()));
    }

    return $pdo;
}

