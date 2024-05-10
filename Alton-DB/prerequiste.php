<?php
// Connect to the database
$dbcnx = mysqli_connect("localhost", "quickme1_4211", "csci4211", "quickme1_4211");
if (!$dbcnx) {
    echo("<p>Unable to connect to the database server at this time.</p>");
    exit();
}

$studentID = '1234567890';
$thecourseID = 'csci4211';

// retrieve all the Prerequisites for csci4211
$query = "SELECT PrereqID FROM Prerequisites WHERE courseID='$thecourseID'";
$results = mysqli_query($dbcnx, $query);

echo("The Studentid is: $studentID<br>");

// Function to check if student meets prerequisite grade requirement
function meetsPrerequisite($studentID, $courseID, $prerequisiteID, $dbcnx) {
    $query = "SELECT Grade FROM Grades WHERE studentID='$studentID' AND CourseID='$prerequisiteID' AND Grade IN ('A', 'B', 'C')";
    $result = mysqli_query($dbcnx, $query);
    return ($result && mysqli_num_rows($result) > 0);
}

// Function to display prerequisites for a course and determine if student meets them
function checkPrerequisites($studentID, $courseID, $dbcnx) {
    $query = "SELECT PrereqID FROM Prerequisites WHERE courseID='$courseID'";
    $result = mysqli_query($dbcnx, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        echo "Prerequisites for course $courseID:<br>";
        while ($row = mysqli_fetch_assoc($result)) {
            $prerequisiteID = $row['PrereqID'];
            echo "Prerequisite: $prerequisiteID - ";
            if (meetsPrerequisite($studentID, $courseID, $prerequisiteID, $dbcnx)) {
                echo "Met<br>";
            } else {
                echo "Not Met<br>";
            }
        }
    } else {
        echo "No prerequisites found for course $courseID<br>";
    }
}

// Print out the results
if ($results) {
    while ($row = mysqli_fetch_assoc($results)) {
        // print out the info
        $PrereqID = $row['PrereqID'];
        echo("$PrereqID<br>");
        // Now find out the grades
        $query1 = "SELECT Grade FROM Grades WHERE studentID='$studentID' AND CourseID='$PrereqID' AND Grade IN ('A', 'B', 'C')";
        $results1 = mysqli_query($dbcnx, $query1);
        if ($results1 && mysqli_num_rows($results1) > 0) {
            // If there's at least one row, the student has taken this prerequisite
            echo("Student has taken prerequisite $PrereqID and has grades A, B, or C.<br>");
        } else {
            // If no rows returned, student hasn't taken this prerequisite or didn't achieve a passing grade
            echo("Student hasn't taken prerequisite $PrereqID or hasn't achieved a passing grade.<br>");
        }
    }
} else {
    echo("No prerequisites found for course $thecourseID<br>");
}

// Example usage: check prerequisites for a student and course
checkPrerequisites($studentID, $thecourseID, $dbcnx);

mysqli_close($dbcnx);
?>
