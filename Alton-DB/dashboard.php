<!-- dashboard.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banking Dashboard</title>
</head>
<body>
    <h1>Welcome to Your Banking Dashboard</h1>
    <p>Your account details:</p>
    <ul>
        <?php
        // Start the session
        session_start();

        // Retrieve user ID from session
        $userid = $_SESSION['userid'];

        // Establish database connection
        $servername = "localhost";
        $username = "quickme1_4211"; // Your MySQL username
        $password = "csci4211"; // Your MySQL password
        $dbname = "dbvpny1qngaxgp";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Retrieve user details
        $sql = "SELECT * FROM login_tbl WHERE userid = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $userid);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo "<li>First Name: " . $row['firstname'] . "</li>";
            echo "<li>Last Name: " . $row['lastname'] . "</li>";
            echo "<li>Address: " . $row['address'] . "</li>";
            echo "<li>Email: " . $row['email'] . "</li>";
            echo "<li>Phone Number: " . $row['phone'] . "</li>";
        } else {
            echo "<li>User details not found</li>";
        }

        // Close statement and connection
        $stmt->close();
        $conn->close();
        ?>
    </ul>
    <p>Your account types:</p>
    <ul>
        <?php
        // Display links to each account type page
        echo "<li><a href='checking.php?userid=$userid'>Checking Account</a></li>";
        echo "<li><a href='savings.php?userid=$userid'>Savings Account</a></li>";
        echo "<li><a href='investment.php?userid=$userid'>Investment Account</a></li>";
        ?>
    </ul>
    <form name="logout" method="post" action = "login.html">
        <button type="submit">Logout</button>
    </form>
</body>
</html>
