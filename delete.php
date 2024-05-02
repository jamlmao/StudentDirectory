<?php
session_start();

if (!isset($_SESSION["id"])) {
    header("location:mainpage.php");
    exit();
}

require("dbconnect.php");

// Check if StudentID is provided in the request
if(isset($_GET["StudentID"])){
    $idToDelete = $_GET["StudentID"];

    // Perform the deletion
    $sql = "UPDATE tblstudentinfo SET deleted = 0 WHERE StudentID = :student_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':student_id', $idToDelete);

    if ($stmt->execute()) {
        header("location: mainpage.php");
        exit();
    } else {
        echo "Failed to delete student";
    }
} else {
    echo "Invalid request";
}
?>