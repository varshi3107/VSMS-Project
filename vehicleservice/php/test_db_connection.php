<?php
// Enable error reporting for troubleshooting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection settings
$host = 'localhost';
$dbname = 'vehicle_service';  // Database name
$username = 'root';  // Default username for XAMPP
$password = 'Varshi@7319';  // Correct password

try {
    // Create a new PDO connection
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Database connected successfully!"; // Add this line for confirmation
} catch (PDOException $e) {
    // Handle connection failure
    echo "Connection failed: " . $e->getMessage();
    exit(); // Stop further execution if the connection fails
}
?>
