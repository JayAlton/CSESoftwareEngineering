<html>
<body>

<?php
// Connect to the database
$db_host = "localhost";
$db_user = "quickme1_4211";
$db_password = "csci4211";
$db_name = "dbvpny1qngaxgp";

$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the variables from the URL request string
$userid = $_REQUEST['userid'];
$firstname = $_REQUEST['firstname'];
$lastname = $_REQUEST['lastname'];
$address = $_REQUEST['address'];
$email = $_REQUEST['email'];
$phone = $_REQUEST['phone'];
$password = $_REQUEST['password'];
$tquestion = $_REQUEST['tquestion'];
$tanswer = $_REQUEST['tanswer'];

echo("$lastname<br>");
echo("$firstname<br>");

// Prepare the SQL statement
$query = "INSERT INTO `login_tbl` (`userid`, `password`, `firstname`, `lastname`, `address`, `email`, `phone`, `testquestion`, `testanswer`)
          VALUES ('$userid', '$password', '$firstname', '$lastname', '$address', '$email', '$phone', '$tquestion', '$tanswer')";

// Execute the query
if ($conn->query($query) === TRUE) {
    echo "Successfully saved the entry.";
} else {
    echo "Trouble saving information to the database: " . $conn->error;
}

// Close the database connection
$conn->close();
?>

</body>
</html>
