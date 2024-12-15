<?php

// Load .env
require_once __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

// Start session
session_start();

// Set timezone
date_default_timezone_set('Asia/Jakarta');

// Error reporting
if ($_ENV['APP_ENV'] === 'development') {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
} else {
    error_reporting(0);
    ini_set('display_errors', 0);
}

// MongoDB configuration
$config = [
    'mongodb' => [
        'uri' => $_ENV['MONGODB_URI'] ?? 'mongodb://localhost:27017',
        'database' => $_ENV['MONGODB_DATABASE'] ?? 'healthtracker'
    ]
];

return $config; 