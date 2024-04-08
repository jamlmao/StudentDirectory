<?php
session_start();


if (isset($_POST["btnLogin"])) {
    require("dbconnect.php");
    $username = isset($_POST["username"]) ? $_POST["username"] : '';
    $password = isset($_POST["passcode"]) ? $_POST["passcode"] : '';

    $sql = "SELECT * FROM tbluser WHERE username = :username";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(":username", $username);
    $stmt->execute();
    $user = $stmt->fetch();

    if ($user) {
       
        if (password_verify($password, $user['passcode'])) {
           
            if ($user['accounttype'] == 'Admin') {
                $_SESSION['id'] = $user['id'];
                $_SESSION['username'] = $username;
                header("Location:MainPage.php");
                exit();
            } 
        } else {
            $errorMsg = "Invalid password!";
        }
    } else {
        $errorMsg = "Invalid username!";
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
<form action="index.php" method="POST">
        <h2>Login</h2>
        <?php if (!empty($errorMsg)) { ?>
            <p class="error-message"><?php echo $errorMsg; ?></p>
        <?php } ?>

        <label>Username:</label>
        <input type="text" name="username"><br>

        <label>Password:</label>
        <input type="password" name="passcode"><br>

        <button type="submit" name="btnLogin">Login</button>
        <button id="register-btn" onclick="location.href='register.php'" type="button">Register</button>
    </form>
</body>
</html>