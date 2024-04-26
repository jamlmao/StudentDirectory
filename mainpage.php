<!DOCTYPE html>
<html lang="en">
<header>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="mainstyle.css">
</header>
<body>

<div class="container">
        <div class="sidebar">
            <div class="logo">
                <img src="Style/Images/logoF.png" alt="Logo">
            </div>
            <div class="search-bar">
                <input type="text" placeholder="SEARCH">
                <button type="submit"><i class="fas fa-search"></i></button>
            </div>
            <div class="buttons">
             <button class="btn1">ADD</button>
            </div>
            <button class="btn2">REGISTER</button>
            <div class="logout">
                <button><i class="fas fa-sign-out-alt"></i></button>
            </div>
        </div>
        <div class="content">
<?php
require("dbconnect.php");


// Retrieve all student info from the database
$sql_select = "SELECT * FROM `tblstudentinfo`";
$stmt = $conn->prepare($sql_select);
$stmt->execute();
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo "<h2>STUDENT INFO:</h2>";

if($students){
    echo "<table border=1>";
    echo "<thead><tr><th>Student ID</th><th>First Name</th><th>Last Name</th><th>Birth Date</th><th>Home Address</th><th>Boarding Address</th><th>Contact No.</th><th>Email Address</th><th>Civil Status</th><th>Religion</th><th>Sex</th><th>Course</th><th>Year Level</th><th>Parents' Name</th><th>Edit</th><th>Delete</th></tr></thead>";
    foreach($students as $student){
        echo "<tr>";
        echo "<th>" . $student['StudentID'] . "</th>";
        echo "<th>" . $student['Fname'] . "</th>";
        echo "<th>" . $student['Lname'] . "</th>";
        echo "<th>" . $student['bdate'] . "</th>";
        echo "<th>" . $student['homeaddr'] . "</th>";
        echo "<th>" . $student['boardingaddr'] . "</th>";
        echo "<th>" . $student['contact'] . "</th>";
        echo "<th>" . $student['email'] . "</th>";  
        echo "<th>" . $student['civil_status'] . "</th>";
        echo "<th>" . $student['religion'] . "</th>";
        echo "<th>" . ($student['sex'] == 'M' ? 'Male' : 'Female') . "</th>";
        echo "<th>" . $student['course'] . "</th>";
        echo "<th>" . $student['year_level'] . "</th>";
        echo "<th>Mother: " . $student['mother_name'] . "<br> Father: " . $student['father_name'] . "</th>";
        echo "<th><a href='edit_info.php?student_id=" . $student['StudentID'] . "'><button>Edit</button></a></th>";
        echo "<th><button class='delete-btn' onclick='softDelete(" . $student["StudentID"] . ")'>Delete</buttton></th>";
        echo "</tr>";  
    
        
        //echo "<td><button class='delete-button' student_id='" . $student['StudentID'] . "'>Delete</button></td>";
        //echo "<th><a href='delete.php?student_id=" . $student['StudentID'] . "'><button>Delete</button></a>";
        
    }
    echo "</table>";
} else {
    echo "No students found!";
}
?>

<script>

function softDelete(id) {
            if (confirm("Are you sure you want to delete this record?")) {
                $.ajax({
                    type: "GET",
                    url: "delete.php",
                    data: { StudentID: id },
                    success: function(response){
                        alert(response); 
                    }
                });
            }
        }
</script>
</body>
</html>


