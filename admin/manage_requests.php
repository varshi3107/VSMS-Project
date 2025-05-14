
<?php
// Include the database connection file
include 'db.php';

// Handle form submission for marking requests as completed
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['complete_request'])) {
        // Complete request
        $request_id = $_POST['request_id'];
        $sql = "UPDATE service_requests SET status = 'completed' WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$request_id]);
    } elseif (isset($_POST['delete_request'])) {
        // Delete request
        $request_id = $_POST['request_id'];
        $sql = "DELETE FROM service_requests WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$request_id]);
    }

    // Redirect back to the manage requests page to reflect changes
    header("Location: manage_requests.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Manage Service Requests</title>
</head>
<body>
    <header>
        <h1>Manage Service Requests</h1>
        <nav>
            <a href="dashboard.html">Dashboard</a>
            <a href="manage_requests.php">Manage Service Requests</a>
            <a href="service_history.php">Service History</a>
        </nav>
    </header>

    <main style="background-color: rgba(255, 255, 255, 0.5); padding: 115px">
        <h3 style="color: black;">Pending Service Requests</h3>
        <table style="border-color: black;" border="1">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Vehicle Type</th>
                    <th>Service Details</th>
                    <th>Request Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                try {
                    // SQL query to get all pending service requests
                    $sql = "SELECT * FROM service_requests WHERE status = 'pending'";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();

                    // Fetch all service requests as an associative array
                    $requests = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    // Check if there are any records
                    if (count($requests) > 0) {
                        // Loop through and display each service request in a table row
                        foreach ($requests as $request) {
                            echo "<tr>
                                    <td>{$request['name']}</td>
                                    <td>{$request['email']}</td>
                                    <td>{$request['vehicle_type']}</td>
                                    <td>{$request['service_details']}</td>
                                    <td>{$request['request_date']}</td>
                                    <td>
                                        <form method='POST' style='display:inline;'>
                                            <input type='hidden' name='request_id' value='{$request['id']}'>
                                            <button type='submit' name='complete_request'>Complete</button>
                                        </form>
                                        <form method='POST' style='display:inline;'>
                                            <input type='hidden' name='request_id' value='{$request['id']}'>
                                            <button type='submit' name='delete_request' onclick='return confirm(\"Are you sure you want to delete this request?\");'>Delete</button>
                                        </form>
                                    </td>
                                  </tr>";
                        }
                    } else {
                        // If no records found
                        echo "<tr><td colspan='6'>No pending service requests found.</td></tr>";
                    }
                } catch (PDOException $e) {
                    // Display an error message if the query fails
                    echo "<tr><td colspan='6'>Error retrieving service requests: " . $e->getMessage() . "</td></tr>";
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
