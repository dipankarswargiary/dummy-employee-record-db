<?php

// Database connection
$dsn = "mysql:host=localhost;dbname=employee_test";
$dbusername = "root";
$password = "password";

try {
    $pdo = new PDO($dsn, $dbusername, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}