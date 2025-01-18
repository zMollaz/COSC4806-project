<?php

// Connect to the database
require_once 'database.php';
$db = db_connect();

// Create the visits table
$db->exec("CREATE TABLE IF NOT EXISTS visits (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    count INT UNSIGNED DEFAULT 0
)");

// Insert the initial visit count
$db->exec("INSERT INTO visits (id, count) VALUES (1, 0) ON DUPLICATE KEY UPDATE count = VALUES(count)");

// Create the ratings table
$db->exec("CREATE TABLE IF NOT EXISTS ratings (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT UNSIGNED,
    movie_title VARCHAR(255),
    rating TINYINT UNSIGNED
)");

// Create the users table
$db->exec("CREATE TABLE IF NOT EXISTS users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) UNIQUE,
    password VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)");

// Create the logs table
$db->exec("CREATE TABLE IF NOT EXISTS logs (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255),
    attempt VARCHAR(10),
    time TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)");

echo "Database initialized successfully.\n";

?>