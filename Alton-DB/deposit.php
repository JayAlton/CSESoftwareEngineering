<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deposit Funds</title>
</head>
<body>
    <h1>Deposit Funds</h1>
    <?php
    // Establish database connection
    $servername = "localhost";
    $username = "quickme1_4211"; // MySQL username
    $password = "csci4211"; // MySQL password
    $dbname = "dbvpny1qngaxgp";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get account type and number from URL parameters
    $account_type = $_GET['account_type'];
    $account_number = $_GET['account_number'];

    // Prepare SQL statement based on account type
    $sql = "";
    $transaction_table = "";
    switch ($account_type) {
        case "checking":
            $sql = "UPDATE checking SET balance = balance + ? WHERE Acct_no = ?";
            $transaction_table = "checking_transactions";
            break;
        case "savings":
            $sql = "UPDATE savings SET balance = balance + ? WHERE Acct_no = ?";
            $transaction_table = "savings_transactions";
            break;
        case "investment":
            $sql = "UPDATE investment SET balance = balance + ? WHERE Acct_no = ?";
            $transaction_table = "investment_transactions";
            break;
        default:
            echo "Invalid account type";
            exit;
    }

    // Execute SQL statement
    if (!empty($_POST['amount'])) {
        $amount = $_POST['amount'];
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ds", $amount, $account_number);
        if ($stmt->execute()) {
            // Retrieve the new balance
            $balance_sql = "SELECT balance FROM " . $account_type . " WHERE Acct_no = ?";
            $balance_stmt = $conn->prepare($balance_sql);
            $balance_stmt->bind_param("s", $account_number);
            $balance_stmt->execute();
            $balance_result = $balance_stmt->get_result();
            $row = $balance_result->fetch_assoc();
            $new_balance = $row["balance"];

            // Retrieve the user details
            $details_sql = "SELECT lastname, firstname, phone FROM " . $account_type . " WHERE Acct_no = ?";
            $details_stmt = $conn->prepare($details_sql);
            $details_stmt->bind_param("s", $account_number);
            $details_stmt->execute();
            $details_result = $details_stmt->get_result();
            $details_row = $details_result->fetch_assoc();
            $lastname = $details_row["lastname"];
            $firstname = $details_row["firstname"];
            $phone = $details_row["phone"];

            // Insert transaction record
            $transaction_sql = "INSERT INTO " . $transaction_table . " (transid, trans_type, trans_date, `trans-amount`, lastname, firstname, phone) VALUES (?, 'Deposit', NOW(), ?, ?, ?, ?)";
            $transaction_stmt = $conn->prepare($transaction_sql);
            $transaction_stmt->bind_param("sdsss", $account_number, $amount, $lastname, $firstname, $phone);
            $transaction_stmt->execute();

            echo "<p>Deposit successful! New balance: $$new_balance</p>";
        } else {
            echo "<p>Error: " . $conn->error . "</p>";
        }
        $stmt->close();
    }

    // Close connection
    $conn->close();
    ?>
    <form action="deposit.php?account_type=<?php echo $account_type; ?>&account_number=<?php echo $account_number; ?>" method="POST">
        <label for="amount">Amount:</label>
        <input type="number" id="amount" name="amount" required><br>
        <button type="submit">Deposit</button>
    </form>
    <a href="dashboard.php">Back to Dashboard</a> <!-- Link back to the dashboard page -->
</body>
</html>
