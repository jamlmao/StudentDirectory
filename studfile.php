<?php
require("dbconnect.php");

if(isset($_GET["student_id"])){
    $studID = $_GET["student_id"];
    // Retrieve student info from the database using student ID
    $sql_select = "SELECT * FROM `tblstudentinfo` WHERE `StudentID` = :istudID";
    $stmt = $conn->prepare($sql_select);
    $stmt->execute(array(":istudID" => $studID));
    $student = $stmt->fetch(PDO::FETCH_ASSOC);

    // Display the retrieved student info
    if($student){
        echo "<h2>Student Info:</h2>";
        echo "<p>Student ID: " . $student['StudentID'] . "</p>";
        echo "<p>First Name: " . $student['Fname'] . "</p>";
        echo "<p>Last Name: " . $student['Lname'] . "</p>";
        echo "<p>Birth Date: " . $student['bdate'] . "</p>";
        echo "<p>Home Address: " . $student['homeaddr'] . "</p>";
        echo "<p>Boarding Address: " . $student['boardingaddr'] . "</p>";
        echo "<p>Contact No.: " . $student['contactno'] . "</p>";
        echo "<p>Sex: " . ($student['sex'] == 'M' ? 'Male' : 'Female') . "</p>";
        echo "<p>Course: " . $student['course'] . "</p>";
    } else {
        echo "Student not found!";
    }
} else {
    echo "Student ID not provided!";
}
?>
