<?php
include('db.php'); // Include your database connection file

// Allow cross-origin requests
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Fetch company names from the database
$query = "SELECT companyName FROM company";
$result = $conn->query($query);

if ($result) {
    $companyNames = [];

    // Fetch the company names into an array
    while ($row = $result->fetch_assoc()) {
        $companyNames[] = $row['companyName'];
    }

    // Output company names as JSON
    echo json_encode($companyNames);
} else {
    // Handle error, you might want to log or return an error response
    echo json_encode(['error' => 'Failed to fetch company names']);
}

// Close the database connection
$conn->close();
?>
