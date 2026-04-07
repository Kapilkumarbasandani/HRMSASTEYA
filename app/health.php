<?php
/**
 * Health check endpoint for load balancers and container orchestration.
 * Returns HTTP 200 if the application is healthy.
 */

header('Content-Type: application/json');
header('Cache-Control: no-cache, no-store, must-revalidate');

$health = [
    'status' => 'ok',
    'timestamp' => date('c')
];

// Optional: Check database connectivity
$dbHealthy = true;
if (file_exists(__DIR__ . '/config.php')) {
    try {
        include_once __DIR__ . '/config.php';
        if (defined('APP_HOST') && defined('APP_USERNAME') && defined('APP_PASSWORD') && defined('APP_DB')) {
            $conn = @new mysqli(APP_HOST, APP_USERNAME, APP_PASSWORD, APP_DB);
            if ($conn->connect_error) {
                $dbHealthy = false;
                $health['database'] = 'error';
            } else {
                $health['database'] = 'connected';
                $conn->close();
            }
        }
    } catch (Exception $e) {
        $dbHealthy = false;
        $health['database'] = 'error';
    }
}

if (!$dbHealthy) {
    http_response_code(503);
    $health['status'] = 'unhealthy';
}

echo json_encode($health);
