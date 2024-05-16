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

// Retrieve checking account details
$sql = "SELECT * FROM checking WHERE userid = '$userid'";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    // If no savings account exists, create one
    $createSql = "INSERT INTO checking (userid, lastname, firstname, address, email, phone, Balance, Date) VALUES (?, '', '', '', '', '', 0, NOW())";
    $createStmt = $conn->prepare($createSql);
    $createStmt->bind_param("s", $userid);
    if ($createStmt->execute()) {
        echo "Checking account created successfully!";
    } else {
        echo "Error creating savings account: " . $conn->error;
    }
}

if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        $account_number = $row["Acct_no"];
        echo "Account Number: " . $account_number . " - Balance: $" . $row["Balance"] . "<br>";
        echo "<a href='deposit.php?account_type=checking&account_number=" . $account_number . "'>Deposit</a> | ";
        echo "<a href='withdraw.php?account_type=checking&account_number=" . $account_number . "'>Withdraw</a> | ";
        echo "<a href='transfer.php?account_type=checking&account_number=" . $account_number . "'>Transfer</a><br>";

        // Retrieve and display transactions for the account
        $transactions_sql = "SELECT * FROM checking_transactions WHERE transid = '$account_number' ORDER BY trans_date DESC";
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
    echo "No checking account found.";
}

$conn->close();
?>
