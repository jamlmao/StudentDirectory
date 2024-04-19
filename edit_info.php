<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Directory</title>
    <!-- Import Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<div class="container-fluid">
    <div class="col-10">
        <h1>Edit Student Information</h1>
            <?php
            require("dbconnect.php");
            session_start();

            if(isset($_POST["btnSave"])){
                $studID = $_POST["Student_ID"];
                $frstnm = $_POST["firstname"];
                $lstnm = $_POST["lastname"];
                $birthd = $_POST["birthdate"];
                $haddress = $_POST["homeadd"];
                $baddress = $_POST["boardingadd"];
                $connum = $_POST["contact"];
                $email = $_POST["email"];
                $sx = $_POST["sex"];
                $crs = $_POST["Course"];
                $yearLevel = $_POST["year_level"];
                
                if(empty($frstnm) || empty($lstnm) || empty($birthd) || empty($haddress) || empty($baddress) || empty($connum) || empty($sx) || empty($crs)){
                    echo "Please input all required fields.";
                } else {
                 
                    $sql = "UPDATE `tblstudentinfo` SET `Fname` = :ifrstnm, `Lname` = :ilstnm, `bdate` = :ibirthd, `homeaddr` = :ihaddress, `boardingaddr` = :ibaddress, `contact` = :iconnum, `email` = :iemail, `sex` = :isx, `course` = :icrs, `year_level` = :iyearLevel WHERE `StudentID` = :istudID";
                    $stmt = $conn->prepare($sql);
                    $stmt->bindParam(':istudID', $studID);
                    $stmt->bindParam(':ifrstnm', $frstnm);
                    $stmt->bindParam(':ilstnm', $lstnm);
                    $stmt->bindParam(':ibirthd', $birthd);
                    $stmt->bindParam(':ihaddress', $haddress);
                    $stmt->bindParam(':ibaddress', $baddress);
                    $stmt->bindParam(':iconnum', $connum);
                    $stmt->bindParam(':iemail', $email);
                    $stmt->bindParam(':isx', $sx);
                    $stmt->bindParam(':icrs', $crs);
                    $stmt->bindParam(':iyearLevel', $yearLevel);
                    $stmt->execute();

                    if($stmt->rowCount() > 0){
                        echo "Record has been updated!";
                    } else {
                        echo "No record has been updated!";
                    }
            
                    header("Location: mainpage.php?student_id=$studID");
                    exit(); 
                }
            }

        if(isset($_GET["student_id"])) {
            $studID = $_GET["student_id"];


            $sql = "SELECT * FROM tblstudentinfo WHERE StudentID = :student_id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':student_id', $studID);
            $stmt->execute();
            $student = $stmt->fetch(PDO::FETCH_ASSOC);

            if(!$student) {
                echo "Student not found!";
            } else {
        ?>
      

            <fieldset class="border border-2 border-dark-subtle p-3 ms-auto me-auto" style="width: 45rem;">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="row">
                <div class="mb-3 w-50">
                <label class="form-label mb-0">Student ID: </label>
                        <input type="text" class="form-control" name="Student_ID">
                    </div>

                    <div class="mb-3 w-50">
                        <label class="form-label mb-0">First Name: </label>
                        <input type="text" class="form-control" name="firstname">
                    </div>

                    <div class="mb-3 w-50">
                        <label class="form-label mb-0">Last Name: </label>
                        <input type="text" class="form-control" name="lastname">
                    </div>

                    <div class="mb-3 w-50">
                        <label class="form-label mb-0">Birth Date: </label>
                        <input type="date" class="form-control" name="birthdate">
                    </div>

                    <div class="mb-3 w-50">
                        <label class="form-label mb-0">Home Address: </label>
                        <input type="text" class="form-control" name="homeadd">
                    </div>

                    <div class="mb-3 w-50">
                        <label class="form-label mb-0">Boarding Address: </label>
                        <input type="text" class="form-control" name="boardingadd">
                    </div>

                    <div class="mb-3 w-50">
                        <label class="form-label mb-0">Contact No.: </label>
                        <input type="tel" class="form-control" name="contact">
                    </div>

                    <div class="mb-3 w-50">
                        <label class="form-label mb-0">Email Address: </label>
                        <input type="email" class="form-control" name="email">
                    </div>

                    <div class="mb-3 w-50">
                        <label class="form-label mb-0">Civil Status: </label>
                        <select class="form-select" name="civil_status">
                            <option value=""></option>
                            <option value="Single">Single</option>
                            <option value="Married">Married</option>
                            <option value="Divorced">Divorced</option>
                            <option value="Widowed">Widowed</option>
                        </select>
                    </div>

                    <div class="mb-3 w-50">
                        <label class="form-label mb-0">Religion: </label>
                        <input type="text" class="form-control" name="religion">
                    </div>

                    <div class="mb-3 w-50">
                        <label class="form-label mb-0">Mother's Name: </label>
                        <input type="text" class="form-control" name="mother_name">
                    </div>

                    <div class="mb-3 w-50">
                        <label class="form-label mb-0">Father's Name: </label>
                        <input type="text" class="form-control" name="father_name">
                    </div>

                    <div class="mb-3 w-50">
                        <label class="form-label mb-0">Sex: </label>
                        <select class="form-select" name="sex">
                            <option value=""></option>
                            <option value="M">M</option>
                            <option value="F">F</option>
                        </select>
                    </div>

                    <div class="mb-3 w-50">
                        <label class="form-label mb-0">Course: </label>
                        <input type="text" class="form-control" name="Course">
                    </div>

                    <div class="mb-3 w-50">
                        <label class="form-label mb-0">Year Level: </label>
                        <input type="text" class="form-control" name="year_level">

                    <div style="text-align: right;">
                        <button type="submit" name="btnSave" class="btn btn-primary w-25">edit</button>
                    </div>
                </form>
            </fieldset>
            <?php
            }
        } else {
            echo "Student ID not provided!";
        }
        ?>
        </div>
    </div>

    <!-- JavaScript Section -->
    <script>
        function search(event){
            if(event.keyCode == 13){
                let search = document.getElementById("txtSearch").value;
                if(search.length >= 3 || search.length === 0){
                    loadItems();
                }
            } 
        }

        function loadItems(){
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function(){
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("htmlContent").innerHTML = this.responseText;
                }
            };
            let search = document.getElementById("txtSearch").value;	
            xhttp.open("GET", "CancelSearch.php?search="+search, true);
            xhttp.send();
        }
    </script>
</body>
</html>
