<?php

$errorMsg = "";

if (isset($_POST["btnSave"])) {
    require("dbconnect.php");
    $username = $_POST["username"];
    $passcode = password_hash($_POST["passcode"], PASSWORD_BCRYPT);

   if (empty($username)) {
        $errorMsg = "Please enter a valid username!";
    } else if (empty($passcode)) {
        $errorMsg = "Please enter a valid passcode!";
    } else {

        $sql = "INSERT INTO tbluser (username,passcode,accounttype) VALUES (:username, :passcode,:accounttype)";
        $values = array(
            
            ":username" => $username,
            ":passcode" => $passcode,
            ":accounttype" => "Admin"
        );

        $result = $conn->prepare($sql);
        $result->execute($values);

        if ($result->rowCount() > 0) {
            echo "Record has been saved!";
            header("Location: index.php");
            exit();
        } else {
            echo "No record has been saved!";
        }
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Document</title>
</head>
<body>
<form action="register.php" method="POST">
        <h2>Registration</h2>
    <?php if (!empty($errorMsg)) { ?>
        <p class="error-message"><?php echo $errorMsg; ?></p>
    <?php } ?>
    

    <label>Username:</label>
    <input type="text" name="username"><br>

    <label>Password:</label>
    <input type="password" name="passcode" required><br>

    <button type="submit" name="btnSave">Register</button>
</form>
</body>
</html>