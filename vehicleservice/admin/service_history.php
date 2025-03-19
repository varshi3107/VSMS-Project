<?php
include '../php/db.php'; // Adjust path if necessary
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Service History</title>
</head>
<body style="background-image: url('pic/background.jpg');">
    <header>
        <h1>Service History</h1>
        <nav>
            <a href="dashboard.html">Dashboard</a>
            <a href="manage_requests.php">Manage Service Requests</a>
            <a href="service_history.php">Service History</a>
        </nav>
    </header>

    <main style="background-color: rgba(255, 255, 255, 0.5); padding: 115px;">
        <h3 style="color: black;">Service History</h3>
        <table style="border-color: black;" border="1">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Vehicle Type</th>
                    <th>Service Details</th>
                    <th>Service Date</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Attempt to retrieve service history
                try {
                    // SQL query to select all service history
                    $sql = "SELECT * FROM service_history"; 
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();

                    // Fetch all history as an associative array
                    $history = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    // Check if there is any history and display it
                    if (count($history) > 0) {
                        foreach ($history as $record) {
                            echo "<tr>
                                    <td>{$record['name']}</td>
                                    <td>{$record['email']}</td>
                                    <td>{$record['vehicle_type']}</td>
                                    <td>{$record['service_details']}</td>
                                    <td>{$record['service_date']}</td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>No service history found.</td></tr>";
                    }
                } catch (PDOException $e) {
                    echo "<tr><td colspan='5'>Error retrieving service history: " . $e->getMessage() . "</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </main>

    <footer>
        <p>&copy; 2024 Vehicle Service Shop</p>
    </footer>
</body>
</html>
