<?php

$host = 'localhost';
$dbname = 'accounts';
$user = 'root';
// Set your database password here if there is one
$password = '';

// If your MySQL is running on a non-standard port, include it in the DSN
$port = 3306; // or use the default 3306 if that's where MySQL is running
$dsn = "mysql:host=$host;dbname=$dbname;port=$port";

try {
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Database Connection failed: " . $e->getMessage();
    exit();
}
