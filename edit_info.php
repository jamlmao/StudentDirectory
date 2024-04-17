<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Management</title>
    <!-- Import Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg">

    <div class="container-fluid">
        <div class="col-10">
           
            <h1>  <img src="logo.png" class="rounded float-start" height = "100px" width = "100px">_______Edit Student Info_______</h1> 
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
                $sx = $_POST["Sex"];
                $crs = $_POST["Course"];
                
                if(empty($studID) || empty($frstnm) || empty($lstnm) || empty($birthd) || empty($haddress) || empty($baddress) || empty($connum) || empty($sx) || empty($crs)){
                    echo "Please input all fields.";
                } else {
                    $sql = "UPDATE `tblstudentinfo` SET `Fname` = :ifrstnm, `Lname` = :ilstnm, `bdate` = :ibirthd, `homeaddr` = :ihaddress, `boardingaddr` = :ibaddress, `contactno` = :iconnum, `sex` = :isx, `course` = :icrs WHERE `StudentID` = :istudID";
        $values = array(":istudID" => $studID, ":ifrstnm" => $frstnm, ":ilstnm" => $lstnm, ":ibirthd" => $birthd, ":ihaddress" => $haddress, ":ibaddress" => $baddress, ":iconnum" => $connum, ":isx" => $sx, ":icrs" => $crs);
        $result = $conn->prepare($sql);
        $result->execute($values);

        if($result->rowCount() > 0){
            echo "Record has been updated!";
        } else {
            echo "No record has been updated!";
        }
        header("Location: studfile.php?student_id=$studID");
    }
}
?>

            <fieldset class="border border-2 border-dark-subtle p-1 ms-auto me-auto" style="width: 35rem;">
                <form action="add_item.php" method="post" class="row">
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
                        <label class="form-label mb-0">Sex: </label>
                        <input type="text" class="form-control" name="Sex">
                    </div>

                    <div class="mb-3 w-50">
                        <label class="form-label mb-0">Course: </label>
                        <input type="text" class="form-control" name="Course">
                    </div>


                    <div style="text-align: right;">
                        <button type="submit" name="btnSave" class="btn btn-primary w-25">Update</button>
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
<style>
        
        .bg {
            background-color: black;
        }
        body {
            font-family: Arial, sans-serif;
            color: white;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container-fluid {
            border-top-left-radius: 8px;
            max-width: 42rem;
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
            background-color: black; 
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
    </style>
</html>
