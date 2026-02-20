<?php
// public/index.php - Entry point aplikasi OClock
session_start();

// Autoload dan konfigurasi
require_once __DIR__ . '/../src/config/database.php';
require_once __DIR__ . '/../src/config/helpers.php';

// Handle actions (API calls)
$action = $_GET['action'] ?? '';

if ($action) {
    // Route ke controller
    if (in_array($action, ['login', 'register', 'logout'])) {
        require_once __DIR__ . '/../src/controllers/auth.php';
        exit;
    }
    
    if (in_array($action, ['save_task', 'delete_task'])) {
        require_once __DIR__ . '/../src/controllers/tasks.php';
        exit;
    }
    
    if (in_array($action, ['update_profile', 'change_password'])) {
        require_once __DIR__ . '/../src/controllers/profile.php';
        exit;
    }
    
    if (in_array($action, ['get_user_tasks', 'delete_user', 'admin_delete_task'])) {
        require_once __DIR__ . '/../src/controllers/admin.php';
        exit;
    }
}

// Get requested page
$page = $_GET['page'] ?? 'home';

// Route mapping
$routes = [
    'home'     => '../views/pages/home.php',
    'login'    => '../views/pages/login.php',
    'register' => '../views/pages/register.php',
    'dashboard'=> '../views/pages/dashboard.php',
    'tasks'    => '../views/pages/tasks.php',
    'profile'  => '../views/pages/profile.php',
    'admin'    => '../views/pages/admin.php',
];

// Check if route exists
if (array_key_exists($page, $routes)) {
    $file = __DIR__ . '/' . $routes[$page];
    if (file_exists($file)) {
        require_once $file;
    } else {
        http_response_code(404);
        echo "404 - Page not found";
    }
} else {
    http_response_code(404);
    echo "404 - Page not found";
}
