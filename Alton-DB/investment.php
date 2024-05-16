<?php
session_start();
$userid = $_GET['userid'];

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

// Retrieve investment account details
$sql = "SELECT * FROM investment WHERE userid = '$userid'";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    // If no savings account exists, create one
    $createSql = "INSERT INTO investment (userid, lastname, firstname, address, email, phone, Balance, Date, `interest-rate`, `total-amount`) VALUES (?, '', '', '', '', '', 0, NOW(), 0.1, 0)";
    $createStmt = $conn->prepare($createSql);
    $createStmt->bind_param("s", $userid);
    if ($createStmt->execute()) {
        echo "Investment account created successfully!";
    } else {
        echo "Error creating savings account: " . $conn->error;
    }
}

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        $account_number = $row["Acct_no"];
        // Check if it has been a year since the account was opened
        $currentDate = date_create();
        $accountOpenDate = date_create($row["Date"]);
        $diff = date_diff($currentDate, $accountOpenDate);
        $years = $diff->y;
        $months = $diff->m;
        $days = $diff->d;

        if ($years >= 1) {
            // Calculate interest
            $interestRate = $row["interest-rate"] / 100; // Convert percentage to decimal
            $currentBalance = $row["Balance"];
            $interest = $currentBalance * $interestRate;

            // Update balance with interest
            $newBalance = $currentBalance + $interest;
            
            // Update the investment account balance with the new balance
            $updateSql = "UPDATE investment SET Balance = $newBalance WHERE Acct_no = '" . $row["Acct_no"] . "'";
            if ($conn->query($updateSql) === TRUE) {
                echo "Account Number: " . $row["Acct_no"]. " - Balance: $" . $newBalance. "<br>";
                echo "<a href='deposit.php?account_type=investment&account_number=" . $row['Acct_no'] . "'>Deposit</a> | ";
                echo "<a href='withdraw.php?account_type=investment&account_number=" . $row['Acct_no'] . "'>Withdraw</a><br>";
                echo "<a href='transfer.php?account_type=checking&account_number=" . $row['Acct_no'] . "'>Transfer</a><br>";
            } else {
                echo "Error updating balance: " . $conn->error;
            }
        } else {
            // If it hasn't been a year, display a message indicating that withdrawals are not allowed yet
            echo "Account Number: " . $row["Acct_no"]. " - Balance: $" . $row["Balance"]. "<br>";
            echo "Withdrawals are not allowed until one year has passed since the account was opened.<br>";
        }

        // Retrieve and display transactions for the account
        $transactions_sql = "SELECT * FROM investment_transactions WHERE transid = '$account_number' ORDER BY trans_date DESC";
        $transactions_result = $conn->query($transactions_sql);

        if ($transactions_result->num_rows > 0) {
            echo "<h3>Transaction History:</h3>";
            echo "<table border='1'>";
            echo "<tr><th>Transaction ID</th><th>Type</th><th>Amount</th><th>Date</th></tr>";
            while ($transaction = $transactions_result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $transaction['transid'] . "</td>";
                echo "<td>" . $transaction['trans_type'] . "</td>";
                echo "<td>" . $transaction['trans-amount'] . "</td>";
                echo "<td>" . $transaction['trans_date'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "No transactions found for this account.";
        }
    }
} else {
    echo "No investment account found.";
}

$conn->close();
?>
