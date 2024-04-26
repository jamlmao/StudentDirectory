<?php
session_start();
require_once('dbconnect.php');

if (isset($_GET["id"])) {
    $idToUpdate = $_GET["id"];

    // Perform the deletion
    $sqlUPDATE = "UPDATE tblstudentinfo SET is_delete = '1' WHERE StudentID  = :id";
    $stmtUPDATE = $conn->prepare($sqlUpdate);
    $stmtUPDATE->bindParam(':id', $idToUpdate);

    if ($stmtUPDATE->execute()) {
        header("location: delete.php");
        exit();
    } else {
        echo "Failed to delete record";
    }
} else {
    echo "Invalid request";
}
?>