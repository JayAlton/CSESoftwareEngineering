<?php
// Debugging: Check if PHP code is being executed
echo "PHP code is being executed.<br>";

// Database configuration for XAMPP
$db_host = "localhost"; // XAMPP default host
$db_user = "root"; // XAMPP default username
$db_password = ""; // XAMPP default password (usually empty)
$db_name = "dbvpny1qngaxgp"; // Change this to your database name

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "Form submitted.<br>";

    // Get the form data
    $userid = $_POST['user'];
    $password = $_POST['pass'];

    echo "Userid: $userid, Password: $password<br>";

    // Establish a connection to the database
    $conn = mysqli_connect($db_host, $db_user, $db_password, $db_name);

    // Check if the connection is successful
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    echo "Database connection successful.<br>";

    // Perform user authentication
    $query = "SELECT userid FROM login_tbl WHERE userid='$userid' AND password='$password'";
    $result = mysqli_query($conn, $query);

    // Check if the query executed successfully
    if ($result) {
        $count = mysqli_num_rows($result);
        echo "Number of rows: $count<br>";
        if ($count != 1) {
            $error_message = "Invalid username or password. Please try again.";
        } else {
            session_start();
            $_SESSION['userid'] = $userid;
            header("Location: bankhome.html"); // Redirect to success page
            exit();
        }
    } else {
        $error_message = "Error: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html>



<head>

<html>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://www.securetsys.com/ad/w3.css">


<style>
form {
    border: 3px solid #f1f1f1;
}

input[type=text], input[type=password] {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
}

button {
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
}

buttongreen {
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
}


buttonred {
    background-color: #990012;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
}



.cancelbtn {
    width: auto;
    padding: 10px 18px;
    background-color: #f44336;
}

.imgcontainer {
    text-align: center;
    margin: 24px 0 12px 0;
}

img.avatar {
    width: 40%;
    border-radius: 50%;
}

.container {
    padding: 16px;
}

span.psw {
    float: right;
    padding-top: 16px;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
    span.psw {
       display: block;
       float: none;
    }
    .cancelbtn {
       width: 100%;
    }
}
</style>
</head>
<body>

<!-- Navigation -->
<nav>
  <ul class="w3-navbar w3-black">
    <li><a href="https://www.quickmednotes.com/rowor/login.html">Home</a></li>
    <li><a href="https://www.quickmednotes.com/rowor/aboutus.html">About Us</a></li>
    <li><a href="https://www.quickmednotes.com/rowor/studentmenu.html">students</a></li>
    <li><a href="https://www.quickmednotes.com/rowor/coursemenu.html">Courses</a></li>
    <li><a href="https://www.quickmednotes.com/rowor/facultymenu.html">Faculty</a></li>
    <li><a href="https://www.quickmednotes.com/rowor/contactus.html">Contact US</a></li>
    <li><a href="href="https://www.securetsys.com/rowor/sngobi/sessionlogout.php">Sign Out</a></li>
     
  </ul>
</nav>
<! End of Navigation>

<! Content Starts>
<div class="imgcontainer">
    <img src="securetsyslogo1.png" border=0 width=250 height=57>
  </div>
<center><h2>Authentication Form</h2></center>


<?php

If ($password =="")
   {
    echo("<center><br><br><span style='color:#000000;font-size:14pt; font-family: arial'><buttonred>
<a href=\"https://www.quickmednotes.com.com/rowor/login.html\"  target=\"_top\" data-role=\"button\" data-theme=\"e\" data-inline=\"true\">Invalid Userid or Password, Click here to sign in.</buttonred></a> 
</span></center>");
        exit(); 
    }


If ($userid =="")
   {
    echo("<center><br><br><span style='color:#000000;font-size:14pt; font-family: arial'><buttonred>
<a href=\"https://www.quickmednotes.com/rowor/login.html\"  target=\"_top\" data-role=\"button\" data-theme=\"e\" data-inline=\"true\">Invalid Userid or Password, Click here to sign in</a></buttonred>
</span></center>");
        exit(); 
    }



echo("$userid\n");
echo("$password\n");

$sql="SELECT userid FROM `login_tbl` WHERE `userid`='$userid' and `password`='$password'"; 
$r = mysql_query($sql); 
$count=mysql_affected_rows();
echo("$count\n");


    if($count!=1){
    echo("<center><br><br><span style='color:#000000;font-size:14pt; font-family: arial'><buttonred>
<a href=\"https://www.quickmednotes.com/rowor/login.html\"  target=\"_top\" data-role=\"button\" data-theme=\"e\" data-inline=\"true\">Invalid Userid or Password, Click here to sign in.</a></buttonred>
</span></center>");
echo("no the userid and password didi not match\n");
        exit(); 
     }

else
{
$_SESSION['userid'] = $userid;



echo("<br><span style='color:#000000;font-size:16pt; font-family: arial'>
<u><b><center> Terms of Use</b></center></u>
<br>
<center>Welcome to the Student rtegistration System!</center>
<table>
<tr>
<td width=5>
</td>
<td><center>The Student trgistration System contains sensitive personal records. You may only proceed if you are authorized to access these records.
It is against the law to access these records without the express permission of the owners. If you are in
agreement with the terms and conditions for use of this software, you may proceed.</center>
</td>
<td width=5>
</td>
</tr>
</table>
<br>");
?>

<center>
<buttongreen><a href="index.html"  target="_top">
Click to proceed</a></buttongreen>
</span></buttonred></center>

<?php

}
 

?>


<center>
<br>
OR
<br>
<br>
<buttonred>
<a href="https://www.quickmednotes.com/rowor/sngobi/sessionlogout.php" target="_top">Sign Out</a>
</buttonred>
</center>
<br>
<br>

<center><img asulogo.png width="100%"></center>


<!-- Footer -->
<footer class="w3-container w3-padding-64 w3-center w3-black w3-xlarge">
  <a href="#"><i class="fa fa-facebook-official"></i></a>
  <a href="#"><i class="fa fa-pinterest-p"></i></a>
  <a href="#"><i class="fa fa-twitter"></i></a>
  <a href="#"><i class="fa fa-flickr"></i></a>
  <a href="#"><i class="fa fa-linkedin"></i></a>
  <p class="w3-medium">
  (c) Copyright Dr. Said Ngobi, 2024.
  </p>
</footer>

</body>
</html>