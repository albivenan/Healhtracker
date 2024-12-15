<?php

use HealthTracker\Controllers\AuthController;
use HealthTracker\Controllers\HealthDataController;
use HealthTracker\Controllers\ActivityController;

try {
    // Load bootstrap
    $config = require_once __DIR__ . '/../src/bootstrap.php';

    // Hapus /albi dari URL untuk routing internal
    $request_uri = $_SERVER['REQUEST_URI'];
    $base_path = '/albi';
    
    // Log request untuk debugging
    error_log("Request URI: " . $request_uri);
    
    if (strpos($request_uri, $base_path) === 0) {
        $request_uri = substr($request_uri, strlen($base_path));
    }
    if (empty($request_uri)) {
        $request_uri = '/';
    }

    // Log processed URI
    error_log("Processed URI: " . $request_uri);

    // Parse URL
    $uri = parse_url($request_uri, PHP_URL_PATH);

    // Basic routing
    $routes = [
        '/' => function() {
            require __DIR__ . '/../views/home.php';
        },
        '/login' => function() {
            $auth = new AuthController();
            return $auth->login();
        },
        '/register' => function() {
            $auth = new AuthController();
            return $auth->register();
        },
        '/logout' => function() {
            $auth = new AuthController();
            return $auth->logout();
        }
    ];

    // Protected routes that require authentication
    $protectedRoutes = [
        '/dashboard' => function() {
            require __DIR__ . '/../views/dashboard.php';
        },
        '/health-data' => function() {
            $controller = new HealthDataController();
            return $controller->store();
        },
        '/health-data/weekly' => function() {
            $controller = new HealthDataController();
            return $controller->getWeeklyData();
        },
        '/activity' => function() {
            $controller = new ActivityController();
            return $controller->store();
        },
        '/activity/daily' => function() {
            $controller = new ActivityController();
            return $controller->getDailyActivity();
        },
        '/activity/weekly' => function() {
            $controller = new ActivityController();
            return $controller->getWeeklyActivity();
        }
    ];

    // Log current route
    error_log("Current route: " . $uri);

    // Check if route exists
    if (array_key_exists($uri, $routes)) {
        $routes[$uri]();
    } elseif (array_key_exists($uri, $protectedRoutes)) {
        if (!isset($_SESSION['user'])) {
            header('Location: ' . $base_path . '/login');
            exit;
        }
        $protectedRoutes[$uri]();
    } else {
        error_log("404 Not Found: " . $uri);
        http_response_code(404);
        require __DIR__ . '/../views/404.php';
    }
} catch (Throwable $e) {
    error_log("Fatal error: " . $e->getMessage() . "\nStack trace: " . $e->getTraceAsString());
    
    if (isset($_ENV['APP_DEBUG']) && $_ENV['APP_DEBUG'] === 'true') {
        echo "<h1>500 Internal Server Error</h1>";
        echo "<pre>";
        echo "Error: " . $e->getMessage() . "\n";
        echo "File: " . $e->getFile() . "\n";
        echo "Line: " . $e->getLine() . "\n";
        echo "Stack trace:\n" . $e->getTraceAsString();
        echo "</pre>";
    } else {
        http_response_code(500);
        require __DIR__ . '/../views/500.php';
    }
} 