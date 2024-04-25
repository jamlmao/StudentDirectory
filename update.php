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
?>