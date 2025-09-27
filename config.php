<?php
/**
 * Centralized database configuration and connection.
 * Loads credentials from environment variables with sensible defaults for local development.
 * Exposes a mysqli connection instance as $db.
 */

// Resolve environment variables with fallbacks for local dev
$DB_HOST = getenv('DB_HOST') ?: ($_ENV['DB_HOST'] ?? '127.0.0.1');
$DB_PORT = getenv('DB_PORT') ?: ($_ENV['DB_PORT'] ?? '3306');
$DB_NAME = getenv('DB_NAME') ?: ($_ENV['DB_NAME'] ?? 'online_bus');
$DB_USER = getenv('DB_USER') ?: ($_ENV['DB_USER'] ?? 'root');
$DB_PASSWORD = getenv('DB_PASSWORD') ?: ($_ENV['DB_PASSWORD'] ?? '');

// Validate port integer
if (!is_numeric($DB_PORT)) {
    $DB_PORT = '3306';
}
$DB_PORT = (int)$DB_PORT;

// Establish mysqli connection
$db = @mysqli_connect($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME, $DB_PORT);

// Handle connection errors gracefully
if (!$db) {
    // In production, you may want to log the error and show a generic message
    header('Content-Type: text/html; charset=utf-8', true, 500);
    echo "<h3>Database connection error</h3>";
    echo "<p>Unable to connect to the database. Please try again later.</p>";
    // Detailed error for debugging (comment out in production)
    echo "<pre style='color:#a00;'>(" . htmlspecialchars(mysqli_connect_errno()) . ") " . htmlspecialchars(mysqli_connect_error()) . "</pre>";
    exit;
}

// Optionally set charset
if (!mysqli_set_charset($db, 'utf8mb4')) {
    // Charset setting failed; continue but warn in comment
    // echo "<!-- Warning: Failed to set charset to utf8mb4 -->";
}
