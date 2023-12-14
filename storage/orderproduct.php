<?php
// Set header to indicate JSON response
header('Access-Control-Allow-Origin: http://localhost:3001');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');

// Connect to the database
require_once('db.php');

// Initialize response array
$response = array();

// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the raw data from the request body
    $jsonData = file_get_contents('php://input');

    // Decode the JSON data
    $data = json_decode($jsonData, true);

    // Check if decoding was successful
    if ($data !== null) {
        // Access the data
        $product = $data['product'];
        $category = $data['category'];
        $orderCompany = $data['orderCompany'];

        // Insert the data into the orders table
        $sql = "INSERT INTO orders (product, category, order_company_name) 
                VALUES ('$product', '$category', '$orderCompany')";

        if ($conn->query($sql) === TRUE) {
            $response['status'] = 'success';
            $response['message'] = 'New record created successfully';
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Error: ' . $sql . '<br>' . $conn->error;
        }
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Invalid JSON data';
    }
} else {
    $response['status'] = 'error';
    $response['message'] = 'Invalid request method';
}

// Close the database connection
$conn->close();

// Output the JSON response
echo json_encode($response);
?>
