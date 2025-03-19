<?php
include 'db.php'; // Ensure this file has the correct database connection

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $vehicle_type = $_POST['vehicle_type'];
    $service_details = $_POST['service_details'];

    try {
        // Insert into service_requests
        $sql = "INSERT INTO service_requests (name, email, vehicle_type, service_details) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$name, $email, $vehicle_type, $service_details]);

        // Insert into service_history
        $sql_history = "INSERT INTO service_history (name, email, vehicle_type, service_details) VALUES (?, ?, ?, ?)";
        $stmt_history = $conn->prepare($sql_history);
        $stmt_history->execute([$name, $email, $vehicle_type, $service_details]);

        // Redirect to confirmation page
        header("Location: ../request_confirmation.php");
        exit();
    } catch (PDOException $e) {
        echo "Error submitting service request: " . $e->getMessage();
    }
}
?>
