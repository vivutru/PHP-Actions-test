<?php
declare(strict_types=1);
header('Content-Type: application/json');
echo json_encode([
    'status'    => 'ok',
    'php'       => PHP_VERSION,
    'server'    => $_SERVER['SERVER_SOFTWARE'] ?? 'unknown',
    'container' => gethostname() ?: 'unknown',
    'time_utc'  => gmdate('c'),
], JSON_PRETTY_PRINT);
