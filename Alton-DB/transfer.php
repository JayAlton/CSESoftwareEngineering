<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transfer Funds</title>
</head>
<body>
    <h1>Transfer Funds</h1>
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
    $account_type = $_GET['account_type'] ?? '';
    $account_number = $_GET['account_number'] ?? '';

    // Get the amount and target account from the form submission
    $amount = $_POST['amount'] ?? '';
    $target_account = $_POST['target_account'] ?? '';

    // If the form is submitted
    if (!empty($amount) && !empty($target_account)) {
        // Prepare SQL statements for updating both source and target accounts
        $source_sql = "";
        $target_sql = "";
        switch ($account_type) {
            case "checking":
                $source_sql = "UPDATE checking SET balance = balance - ? WHERE Acct_no = ?";
                break;
            case "savings":
                $source_sql = "UPDATE savings SET balance = balance - ? WHERE Acct_no = ?";
                break;
            case "investment":
                $source_sql = "UPDATE investment SET balance = balance - ? WHERE Acct_no = ?";
                break;
            default:
                echo "Invalid account type";
                break;
        }

        switch ($target_account) {
            case "checking":
                $target_sql = "UPDATE checking SET balance = balance + ? WHERE Acct_no = ?";
                break;
            case "savings":
                $target_sql = "UPDATE savings SET balance = balance + ? WHERE Acct_no = ?";
                break;
            case "investment":
                $target_sql = "UPDATE investment SET balance = balance + ? WHERE Acct_no = ?";
                break;
            default:
                echo "Invalid target account";
                break;
        }

        // Execute SQL statements
        $stmt_source = $conn->prepare($source_sql);
        $stmt_source->bind_param("ds", $amount, $account_number);
        $stmt_target = $conn->prepare($target_sql);
        $stmt_target->bind_param("ds", $amount, $target_account); // Use target account number here

        if ($stmt_source->execute() && $stmt_target->execute()) {
            echo "<p>Transfer successful!</p>";

            // Insert transfer transactions into respective account transaction tables
            $source_transaction_sql = "INSERT INTO " . $account_type . "_transactions (transid, trans_type, trans_date, `trans-amount`) VALUES (?, 'Transfer', NOW(), ?)";
            $target_transaction_sql = "INSERT INTO " . $target_account . "_transactions (transid, trans_type, trans_date, `trans-amount`) VALUES (?, 'Transfer', NOW(), ?)";

            $source_transaction_stmt = $conn->prepare($source_transaction_sql);
            $source_transaction_stmt->bind_param("sd", $account_number, $amount);
            $source_transaction_stmt->execute();

            $target_transaction_stmt = $conn->prepare($target_transaction_sql);
            $target_transaction_stmt->bind_param("sd", $account_number, $amount);
            $target_transaction_stmt->execute();
        } else {
            echo "<p>Error: " . $conn->error . "</p>";
        }

        // Close statements
        $stmt_source->close();
        $stmt_target->close();
    }

    // Close connection
    $conn->close();
    ?>
    <form action="transfer.php?account_type=<?php echo $account_type; ?>&account_number=<?php echo $account_number; ?>" method="POST">
        <label for="amount">Amount:</label>
        <input type="number" id="amount" name="amount" required><br>
        <label for="target_account">Transfer to:</label>
        <select id="target_account" name="target_account" required>
            <option value="checking">Checking Account</option>
            <option value="savings">Savings Account</option>
            <option value="investment">Investment Account</option>
        </select><br>
        <button type="submit">Transfer</button>
    </form>
    <a href="dashboard.php">Back to Dashboard</a> <!-- Link back to the dashboard page -->
</body>
</html>
