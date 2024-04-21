<?php
session_start();

	if(isset($_REQUEST['id'])){
		
		try {
			
			require("dbconnect.php");
		
			$sql = "UPDATE tblstudentinfo SET is_delete = '1' WHERE id  = :id";
			
			$values = array(":id" => $_REQUEST['id']);
			
			$result = $conn->prepare($sql);
			$result->execute($values);
			
			if($result->rowCount()>0){
				header("location:delete.php");
				exit();
			}
			
		} catch(PDOException $e){
			exit("Unexpected error has been occurred!" . $e);
		}
		
	}
