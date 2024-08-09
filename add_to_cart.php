<?php
$servername = "localhost"; // Replace with your server name if it's different
$username = "root";        // Replace with your MySQL username
$password = "";            // Replace with your MySQL password
$dbname = "cart_db";       // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve data from POST request
$product_name = $_POST['product_name'];
$price = $_POST['price'];
$user_name = $_POST['user_name'];
$phone_number = $_POST['phone_number'];

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO cart_items (product_name, price, user_name, phone_number) VALUES (?, ?, ?, ?)");
$stmt->bind_param("sdss", $product_name, $price, $user_name, $phone_number);

if ($stmt->execute()) {
    echo "Item added to cart";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
