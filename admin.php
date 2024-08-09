<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cart_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT product_name, price, user_name, phone_number, added_at FROM cart_items";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Cart Items</title>
</head>
<body>
    <h1>Admin - View Cart Items</h1>
    <div id="cart-items-admin">
        <table border="1">
            <tr>
                <th>Product Name</th>
                <th>Price (TZ)</th>
                <th>User Name</th>
                <th>Phone Number</th>
                <th>Date Added</th>
            </tr>
            <?php
            if ($result->num_rows > 0) {
                // Output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row["product_name"]. "</td><td>" . $row["price"]. "</td><td>" . $row["user_name"]. "</td><td>" . $row["phone_number"]. "</td><td>" . $row["added_at"]. "</td></tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No items found</td></tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>

<?php
$conn->close();
?>
