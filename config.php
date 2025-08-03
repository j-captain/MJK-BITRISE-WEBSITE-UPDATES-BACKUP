<?php
define('DB_HOST', 'localhost');
define('DB_NAME', 'alphate2_newbitrise');
define('DB_USER', 'alphate2_joel');
define('DB_PASS', 'Mwangi@12345!');

$dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4';

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
} catch (PDOException $e) {
    error_log("Database connection failed: " . $e->getMessage(), 0);
    die("<h1>Database connection error. Please try again later.</h1>");
}

?>