<?php      
        
        session_start();

            if (!isset($_SESSION["id"])) {
                header("location:index.php");
                exit();
            }

            require("dbconnect.php");

            if(isset($_REQUEST["logout"])){
                session_destroy();
                header("location:index.php");
                exit();
            }

            
?>

<!DOCTYPE html>
<html lang="en">
<header>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="mainstyle.css">
</header>
<body>

<div class="container">
        <div class="sidebar">
            <div class="logo">
                <img src="Style/Images/logoF.png" alt="Logo">
            </div>
            <div class="search-bar">
                <form action="" method="GET">
                    <input type="text" name="search" placeholder="SEARCH">
                    <button type="submit"><i class="fas fa-search"></i></button>
                </form>
            </div>
            <div class="buttons">
             <button class="btn1">ADD</button>
            </div>
            <button class="btn2">REGISTER</button>
            <div class="logout">
            <button onclick="location.href='MainPage.php?logout=<?php echo $_SESSION["id"]; ?>'"><i class="fas fa-sign-out-alt"></i></button> 
            </div>
        </div>
        <div class="content">
        <?php
require("dbconnect.php");

// Sanitize the search term
$searchTerm = filter_input(INPUT_GET, 'search', FILTER_SANITIZE_STRING);

// Initialize the SQL query
$sql_select = "SELECT * FROM `tblstudentinfo` WHERE deleted = 1";

// Check if a search term is provided
if (!empty($searchTerm)) {
    // Add a condition to the SQL query to filter based on the search term
    $sql_select.= " AND (Fname LIKE? OR Lname LIKE? OR email LIKE? OR course LIKE? OR year_level LIKE?)";
}

// Prepare the statement
$stmt = $conn->prepare($sql_select);

// Bind the search term to the placeholders in the SQL query
if (!empty($searchTerm)) {
    $stmt->bindValue(1, "%{$searchTerm}%", PDO::PARAM_STR);
    $stmt->bindValue(2, "%{$searchTerm}%", PDO::PARAM_STR);
    $stmt->bindValue(3, "%{$searchTerm}%", PDO::PARAM_STR);
    $stmt->bindValue(4, "%{$searchTerm}%", PDO::PARAM_STR);
    $stmt->bindValue(5, "%{$searchTerm}%", PDO::PARAM_STR);
}

// Execute the statement
$stmt->execute();
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo "<h2>STUDENT INFO:</h2>";

if ($students) {
    echo "<table border=1>";
    echo "<thead><tr><th>Student ID</th><th>First Name</th><th>Last Name</th><th>Birth Date</th><th>Home Address</th><th>Boarding Address</th><th>Contact No.</th><th>Email Address</th><th>Civil Status</th><th>Religion</th><th>Sex</th><th>Course</th><th>Year Level</th><th>Parents' Name</th><th>Edit</th><th>Delete</th></tr></thead>";
    foreach ($students as $student){
        echo "<tr>";
        echo "<th>". $student['StudentID']. "</th>";
        echo "<th>". str_replace($searchTerm, "<span class='highlight'>$searchTerm</span>", $student['Fname']). "</th>";
        echo "<th>". str_replace($searchTerm, "<span class='highlight'>$searchTerm</span>", $student['Lname']). "</th>";
        echo "<th>". $student['bdate']. "</th>";
        echo "<th>". $student['homeaddr']. "</th>";
        echo "<th>". $student['boardingaddr']. "</th>";
        echo "<th>". $student['contact']. "</th>";
        echo "<th>". $student['email']. "</th>";
        echo "<th>". $student['civil_status']. "</th>";
        echo "<th>". $student['religion']. "</th>";
        echo "<th>". ($student['sex'] == 'M'? 'Male' : 'Female'). "</th>";
        echo "<th>". $student['course']. "</th>";
        echo "<th>". $student['year_level']. "</th>";
        echo "<th>Mother: ". $student['mother_name']. "<br> Father: ". $student['father_name']. "</th>";
        echo "<th><a href='edit_info.php?student_id=". $student['StudentID']. "'><button><i class='fas fa-user-pen'></i></button></a></th>";
        echo "<th><button type='button' onclick='confirmDelete(". $student['StudentID']. ")'><i class='fa fa-trash'></i></button></th>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No students found!";
}
?>


    </div>   
</div>
    
</body>

<script>

function confirmDelete(StudentID) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = 'delete.php?StudentID=' + StudentID;
        }
    })
}
    function redirectTo(url) {
        window.location.href = url;
    }

    document.addEventListener("DOMContentLoaded", function() {
        document.querySelector(".btn1").addEventListener("click", function() {
            redirectTo('add_stud.php');
        });

    });
</script>

</html>


