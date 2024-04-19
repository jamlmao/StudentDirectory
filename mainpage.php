<?php
require("dbconnect.php");

// Retrieve all student info from the database
$sql_select = "SELECT * FROM `tblstudentinfo`";
$stmt = $conn->prepare($sql_select);
$stmt->execute();
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo "<h2>Student Info:</h2>";

if($students){
    echo "<table border='1'>";
    echo "<tr><th>Student ID</th><th>First Name</th><th>Last Name</th><th>Birth Date</th><th>Home Address</th><th>Boarding Address</th><th>Contact No.</th><th>Email Address</th><th>Civil Status</th><th>Religion</th><th>Sex</th><th>Course</th><th>Year Level</th><th>Parents' Name</th><th>Edit</th></tr>";
    foreach($students as $student){
        echo "<tr>";
        echo "<td>" . $student['StudentID'] . "</td>";
        echo "<td>" . $student['Fname'] . "</td>";
        echo "<td>" . $student['Lname'] . "</td>";
        echo "<td>" . $student['bdate'] . "</td>";
        echo "<td>" . $student['homeaddr'] . "</td>";
        echo "<td>" . $student['boardingaddr'] . "</td>";
        echo "<td>" . $student['contact'] . "</td>";
        echo "<td>" . $student['email'] . "</td>";
        echo "<td>" . $student['civil_status'] . "</td>";
        echo "<td>" . $student['religion'] . "</td>";
        echo "<td>" . ($student['sex'] == 'M' ? 'Male' : 'Female') . "</td>";
        echo "<td>" . $student['course'] . "</td>";
        echo "<td>" . $student['year_level'] . "</td>";
        echo "<td>Mother: " . $student['mother_name'] . "<br> Father: " . $student['father_name'] . "</td>";
        echo "<td><a href='edit_info.php?student_id=" . $student['StudentID'] . "'><button>Edit</button></a></td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No students found!";
}
?>