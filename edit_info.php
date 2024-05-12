<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Directory</title>
    <!-- Import Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>
<body class="bg">

<div class="container-fluid">
    <div class="col-10">
    <h1><img src="logoF.png" class="rounded float-start" height = "100px" width = "100px">Edit Student Information</h1>
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
                $religion = $_POST["religion"];
                $motherName = $_POST["mother_name"];
                $fatherName = $_POST["father_name"];
                
                if(empty($frstnm) || empty($lstnm) || empty($birthd) || empty($haddress) || empty($baddress) || empty($connum) || empty($sx) || empty($crs)){
                    echo "Please input all required fields.";
                } else {
                 
                    $sql = "UPDATE `tblstudentinfo` SET `Fname` = :ifrstnm, `Lname` = :ilstnm, `bdate` = :ibirthd, `homeaddr` = :ihaddress, `boardingaddr` = :ibaddress, `contact` = :iconnum, `email` = :iemail, `sex` = :isx, `course` = :icrs, `year_level` = :iyearLevel, `religion` = :ireligion, `mother_name` = :imotherName, `father_name` = :ifatherName WHERE `StudentID` = :istudID";
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
                    $stmt->bindParam(':ireligion', $religion);
                    $stmt->bindParam(':imotherName', $motherName);
                    $stmt->bindParam(':ifatherName', $fatherName);
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
                <form action="edit_info.php" method="post" class="row" id="updateForm" onsubmit="return confirmUpdate()">
                <div class="mb-3 w-50">
                <label class="form-label mb-0">Student ID: </label>
                        <input type="text" class="form-control" name="Student_ID" readonly value="<?php echo $student['StudentID']; ?>">
                    </div>

                    <div class="mb-3 w-50">
                    <label class="form-label mb-0">First Name: </label>
                        <input type="text" class="form-control" name="firstname" value="<?php echo $student['Fname']; ?>">
                    </div>

                    <div class="mb-3 w-50">
                    <label class="form-label mb-0">Last Name: </label>
                        <input type="text" class="form-control" name="lastname"  value="<?php echo $student['Lname']; ?>">
                    </div>

                    <div class="mb-3 w-50">
                    <label class="form-label mb-0">Birth Date: </label>
                        <input type="date" class="form-control" name="birthdate"  value="<?php echo $student['bdate']; ?>">
                    </div>

                <div class="mb-3 w-50">
                <label class="form-label mb-0">Home Address: </label>
                    <input type="text" class="form-control" name="homeadd" value="<?php echo $student['homeaddr']; ?>">
                </div>

                <div class="mb-3 w-50">
                <label class="form-label mb-0">Boarding Address: </label>
                    <input type="text" class="form-control" name="boardingadd" value="<?php echo $student['boardingaddr']; ?>">
                </div>

                <div class="mb-3 w-50">
                <label class="form-label mb-0">Contact No.: </label>
                     <input type="tel" class="form-control" name="contact" value="<?php echo $student['contact']; ?>">
                </div>

                <div class="mb-3 w-50">
                <label class="form-label mb-0">Email Address: </label>
                     <input type="email" class="form-control" name="email" value="<?php echo $student['email']; ?>">
                </div>


                <div class="mb-3 w-50">
                <label class="form-label mb-0">Civil Status: </label>
                <select class="form-select" name="civil_status">
                <option value=""></option>
                    <option value="Single" <?php echo ($student['civil_status'] == 'Single') ? 'selected' : ''; ?>>Single</option>
                    <option value="Married" <?php echo ($student['civil_status'] == 'Married') ? 'selected' : ''; ?>>Married</option>
                    <option value="Divorced" <?php echo ($student['civil_status'] == 'Divorced') ? 'selected' : ''; ?>>Divorced</option>
                    <option value="Widowed" <?php echo ($student['civil_status'] == 'Widowed') ? 'selected' : ''; ?>>Widowed</option>
                </select>
                </div>


                <div class="mb-3 w-50">
                <label class="form-label mb-0">Religion: </label>
                    <input type="text" class="form-control" name="religion" readonly value="<?php echo $student['religion']; ?>">
                </div>


                    <div class="mb-3 w-50">
                    <label class="form-label mb-0">Mother's Name: </label>
                        <input type="text" class="form-control" name="mother_name" readonly value="<?php echo $student['mother_name']; ?>">
                    </div>

                <div class="mb-3 w-50">
                <label class="form-label mb-0">Father's Name: </label>
                    <input type="text" class="form-control" name="father_name" readonly value="<?php echo $student['father_name']; ?>">
                </div>

                <div class="mb-3 w-50">
                <label class="form-label mb-0">Sex: </label>
                <select class="form-select" name="sex">
                <option readonly value=""></option>
                    <option value="M" <?php echo ($student['sex'] == 'M') ? 'selected' : ''; ?>>M</option>
                    <option value="F" <?php echo ($student['sex'] == 'F') ? 'selected' : ''; ?>>F</option>
                </select>
                </div>

                <div class="mb-3 w-50">
                <label class="form-label mb-0">Course: </label>
                    <input type="text" class="form-control" name="Course" value="<?php echo $student['course']; ?>">
                </div>

                <div class="mb-3 w-50">
                <label class="form-label mb-0">Year Level: </label>
                    <input type="text" class="form-control" name="year_level" value="<?php echo $student['year_level']; ?>">
                </div>

                    <div class="text-center" style="text-align: center;">
                        <button type="submit" name="btnSave" id="btnSave" class="btn btn-primary w-25">Save</button>
                    </div>
                </form>
            </fieldset>
            <?php
            }
        } 
        ?>
        </div>
    </div>

   
    <style>
        
        .bg {
            background-color: #f5f5f5;
        }
        body {
            font-family: Arial, sans-serif;
            color: black;
            background-color: #f5f5f5;
            margin: 1;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 10;
        }
        .container-fluid {
            font-size: larger;
            border-top-left-radius: 8px;
            max-width: 50rem;
            padding: 20px;
            border-radius: 8px;
            background-color: orange;
        }
        h1 {
            color: black;
            text-align: left;
            margin-bottom: 20px;
        }
        .border-dark-subtle {
            background-color: #f9ddb1; 
        }
        .p-3 {
            padding: 1rem;
        }
        .w-50 {
            width: 100%;
            padding-right: 350px;
        }
        .form-label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }
        .form-control {
            width: 100%;
            padding: 8px;
            border-radius: 4px;
            border: 1px solid #ccc;
            box-sizing: border-box;
            margin-bottom: 10px;
        }
        .btn-primary {
            font-size: large;
            font-weight: bolder;
            background-color: orange;
            color: black;
            border: none;
            padding: 15px 290px;
            border-radius: 4px;
            cursor: pointer;
        }
        .btn-primary:hover {

            background-color: orange;
        }
        .text-right {
            text-align: right;
        }
        img {
            margin-right: 80px;
        }
    </style>
</body>
<script>
function confirmUpdate(event) {
    event.preventDefault(); // Prevent the default form submission
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, update it!'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('updateForm').submit(); // Submit the form manually
        }
    })
}

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
</html>
