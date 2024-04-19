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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Style/indexstyle.css">
    <title>Login</title>

</head>


<style type="text/css">
    body{
    background-image: url(Style/Images/bgtest.jpg);
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-size: cover;
}
</style>



<body>

      <div class="container">

    

        <div>
        <img src="Style/Images/logoL.png" height="325px", width="330px">
        </div>
        
        <div class="box form-box">
            
        
            
            <header>LOGIN</header>
            <!-- <?php if (!empty($errorMsg)) { ?>
            <p class="error-message"><?php echo $errorMsg; ?></p>
        <?php } ?> -->
            <form action="index.php" method="POST">
                <div class="field input">
                    <label for="email">Email</label>
                    <input type="text" name="username" id="email" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="passcode" id="password" autocomplete="off" required>
                </div>

                <div class="field">
                    
                    <button type="submit" class="btn" name="btnLogin" >Login</button>
                </div>
                <div class="links">
                    Don't have account? <a href="register.php">Register here</a>
                </div>
            </form>
        </div>
       
      </div>
</body>
</html>