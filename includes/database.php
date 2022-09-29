<?php
$db = mysqli_connect(
    $_ENV['DB_HOST'] ?? '',
    $_ENV['DB_USER'] ?? '', 
    $_ENV['DB_PASS'] ?? '', 
    $_ENV['DB_NAME'] ?? ''
);

if (!$db) {
    echo "Error: Could not connect to MySQL.";
    echo "Depuration errno: " . mysqli_connect_errno();
    echo "Depuration error: " . mysqli_connect_error();
    exit;
}