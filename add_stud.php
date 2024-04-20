<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Directory</title>
    <!-- Import Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container-fluid {
            max-width: 40rem;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: orange;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .col-10 {
            width: 100%;
        }
        .form-wrapper {
            width: 100%;
            max-width: 70rem;
        }
        .border-dark-subtle {
            border: 1px solid #ddd;
            background-color: white;
            border-radius: 8px;
            padding: 20px;
        }
        .form-row {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }
        .mb-3 {
            flex: 0 0 50%;
            max-width: calc(50% - 20px);
        }
        .text-right {
            text-align: right;
            width: 100%;
        }
        .form-label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }
        .form-control, .form-select {
            width: 100%;
            padding: 8px;
            border-radius: 4px;
            border: 1px solid #ccc;
            box-sizing: border-box;
            margin-bottom: 10px;
        }
        .btn-primary {
            background-color: black;
            color: white;
            border: none;
            padding: 10px 290px;
            border-radius: 4px;
            cursor: pointer;
        }
        .btn-primary:hover {
            background-color: orange;
        }
    </style>
</head>
<body>

    <div class="container-fluid">
        <div class="col-10">
            <center><h1>Add Student Info</h1></center>
            <?php
            if(isset($_POST["btnSave"])){
                require("dbconnect.php");
                
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
                $year_level = $_POST["year_level"];
                $civil_status = $_POST["civil_status"];
                $religion = $_POST["religion"];
                $mother_name = $_POST["mother_name"];
                $father_name = $_POST["father_name"];
                
                if(empty($studID) || empty($frstnm) || empty($lstnm) || empty($birthd) || empty($haddress) || empty($baddress) || empty($connum) || empty($email) || empty($civil_status) || empty($religion) || empty($mother_name) || empty($father_name) || empty($sx) || empty($crs) || empty($year_level)){
                    echo "                      Please input all fields.";
                } else {
                    $sql = "INSERT INTO `tblstudentinfo`(`StudentID`, `Fname`, `Lname`, `bdate`, `homeaddr`, `boardingaddr`, `contact`, `email`, `civil_status`, `religion`, `mother_name`, `father_name`, `sex`, `course`, `year_level`) VALUES (:istudID, :ifrstnm, :ilstnm, :ibirthd, :ihaddress, :ibaddress, :iconnum, :iemail, :icivil_status, :ireligion, :imother_name, :ifather_name, :isx, :icrs, :iyear_level)";
                    $values = array(":istudID" => $studID, ":ifrstnm" => $frstnm, ":ilstnm" => $lstnm, ":ibirthd" => $birthd, ":ihaddress" => $haddress, ":ibaddress" => $baddress, ":iconnum" => $connum, ":iemail" => $email, ":icivil_status" => $civil_status, ":ireligion" => $religion, ":imother_name" => $mother_name, ":ifather_name" => $father_name, ":isx" => $sx, ":icrs" => $crs, ":iyear_level" => $year_level);
                    $result = $conn->prepare($sql);
                    $result->execute($values);
                    
                    if($result->rowCount() > 0){
                        echo "Record has been saved!";
                    } else {
                        echo "No record has been saved!";
                    }
                   
                }
            }
            ?>

            <fieldset class="border border-2 border-dark-subtle p-3">
                <form action="add_stud.php" method="post" class="form-wrapper">
                    <div class="form-row">
                        <div class="mb-3">
                            <label class="form-label mb-0">Student ID: </label>
                            <input type="text" name="Student_ID" class="form-control" pattern="[0-9]+" title="Please enter only numeric values">
                        </div>

                        <div class="mb-3">
                            <label class="form-label mb-0">First Name: </label>
                            <input type="text" class="form-control" name="firstname">
                        </div>

                        <div class="mb-3">
                            <label class="form-label mb-0">Last Name: </label>
                            <input type="text" class="form-control" name="lastname">
                        </div>

                        <div class="mb-3">
                            <label class="form-label mb-0">Birth Date: </label>
                            <input type="date" class="form-control" name="birthdate">
                        </div>

                        <div class="mb-3">
                            <label class="form-label mb-0">Home Address: </label>
                            <input type="text" class="form-control" name="homeadd">
                        </div>

                        <div class="mb-3">
                            <label class="form-label mb-0">Boarding Address: </label>
                            <input type="text" class="form-control" name="boardingadd">
                        </div>

                        <div class="mb-3">
                            <label class="form-label mb-0">Contact No.: </label>
                            <input type="tel" class="form-control" name="contact">
                        </div>

                        <div class="mb-3">
                            <label class="form-label mb-0">Email Address: </label>
                            <input type="email" class="form-control" name="email">
                        </div>

                        <div class="mb-3">
                            <label class="form-label mb-0">Civil Status: </label>
                            <select class="form-select" name="civil_status">
                                <option value=""></option>
                                <option value="Single">Single</option>
                                <option value="Married">Married</option>
                                <option value="Divorced">Divorced</option>
                                <option value="Widowed">Widowed</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label mb-0">Religion: </label>
                            <input type="text" class="form-control" name="religion">
                        </div>

                        <div class="mb-3">
                            <label class="form-label mb-0">Mother's Name: </label>
                            <input type="text" class="form-control" name="mother_name">
                        </div>

                        <div class="mb-3">
                            <label class="form-label mb-0">Father's Name: </label>
                            <input type="text" class="form-control" name="father_name">
                        </div>

                        <div class="mb-3">
                            <label class="form-label mb-0">Sex: </label>
                            <select class="form-select" name="sex">
                                <option value=""></option>
                                <option value="M">M</option>
                                <option value="F">F</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label mb-0">Course: </label>
                            <input type="text" class="form-control" name="Course">
                        </div>

                        <div class="mb-3">
                            <label class="form-label mb-0">Year Level: </label>
                            <input type="text" class="form-control" name="year_level">
                        </div>
                    </div>
                    <div class="text-right">
                        <button type="submit" name="btnSave" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </fieldset>
        </div>
    </div>

    <script>
        Swal.fire({
            title: "Student info Added",
            showClass: {
                popup: `
                animate__animated
                animate__fadeInUp
                animate__faster
                `
            },
            hideClass: {
                popup: `
                animate__animated
                animate__fadeOutDown
                animate__faster
                `
            }
        });
    </script>

</body>
</html>
