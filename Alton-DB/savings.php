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

// Retrieve savings account details
$sql = "SELECT * FROM savings WHERE userid = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $userid);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    // If no savings account exists, create one
    $createSql = "INSERT INTO savings (userid, lastname, firstname, address, email, phone, Balance, Date, `interest-rate`, `total-amount`) VALUES (?, '', '', '', '', '', 0, NOW(), 0.1, 0)";
    $createStmt = $conn->prepare($createSql);
    $createStmt->bind_param("s", $userid);
    if ($createStmt->execute()) {
        echo "Savings account created successfully!";
    } else {
        echo "Error creating savings account: " . $conn->error;
    }
}

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $account_number = $row["Acct_no"];
        
        // Check if it has been a year since the account was opened
        $currentDate = date_create();
        $accountOpenDate = date_create($row["Date"]);
        $diff = date_diff($currentDate, $accountOpenDate);
        $years = $diff->y;
        $months = $diff->m;
        $days = $diff->d;

        // Calculate interest
        $interestRate = $row["interest-rate"] / 100; // Convert percentage to decimal
        $currentBalance = $row["Balance"];
        $interest = $currentBalance * $interestRate;

        // Update balance with interest
        $newBalance = $currentBalance + $interest;

        // Update the savings account balance with the new balance
        $updateSql = "UPDATE savings SET Balance = ? WHERE Acct_no = ?";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bind_param("ds", $newBalance, $account_number);
        
        if ($updateStmt->execute()) {
            echo "Account Number: " . $row["Acct_no"] . " - Balance: $" . $newBalance . "<br>";
            echo "<a href='deposit.php?account_type=savings&account_number=" . $row['Acct_no'] . "'>Deposit</a> | ";
            echo "<a href='withdraw.php?account_type=savings&account_number=" . $row['Acct_no'] . "'>Withdraw</a><br>";
            echo "<a href='transfer.php?account_type=checking&account_number=" . $row['Acct_no'] . "'>Transfer</a><br>";
        } else {
            echo "Error updating balance: " . $conn->error;
        }

        // Retrieve and display transactions for the account
        $transactions_sql = "SELECT * FROM savings_transactions WHERE transid = ? ORDER BY trans_date DESC";
        $transactions_stmt = $conn->prepare($transactions_sql);
        $transactions_stmt->bind_param("s", $account_number);
        $transactions_stmt->execute();
        $transactions_result = $transactions_stmt->get_result();

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
    echo "No savings account found.";
}

$stmt->close();
$conn->close();
?>
