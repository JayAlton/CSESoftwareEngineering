<?php
// Establish database connection
$servername = "localhost";
$username = "username"; // Your MySQL username
$password = "password"; // Your MySQL password
$dbname = "dbvpny1qngaxgp";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get account type from URL parameter
$type = $_GET['type'];

// Write SQL query based on account type
$sql = "SELECT * FROM accounts WHERE type = '$type'"; // Assuming 'accounts' is your table name

// Execute SQL query
$result = $conn->query($sql);

// Display account information
if ($result->num_rows > 0) {
    echo "<h2>$type Account Details</h2>";
    echo "<table>";
    echo "<tr><th>Account Number</th><th>Balance</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["account_number"]."</td><td>".$row["balance"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "No accounts found";
}

// Close connection
$conn->close();
?>
