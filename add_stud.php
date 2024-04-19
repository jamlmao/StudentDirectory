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
            <h1>Add Student Info</h1>
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
                    echo "Please input all fields.";
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

            <fieldset class="border border-2 border-dark-subtle p-3 ms-auto me-auto" style="width: 45rem;">
                <form action="add_stud.php" method="post" class="row">
                    <div class="mb-3 w-50">
                        <label class="form-label mb-0">Student ID: </label>
                        <input type="text" name="Student_ID" class="form-control" pattern="[0-9]+" title="Please enter only numeric values">
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
                        <button type="submit" name="btnSave" class="btn btn-primary w-25">Add</button>
                    </div>
                </form>
            </fieldset>
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
