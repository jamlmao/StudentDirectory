<?php


 $pattern = '/^(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,12}$/'; // Regex pattern for password validation

 if (isset($_POST["btnSave"])) {
     require("dbconnect.php");
     $username = $_POST["username"];
     $passcode = $_POST["passcode"]; // Get the password before validation

     // Validate the password
     if (!preg_match($pattern, $passcode)) {
        $showAlert = true;
        $errorMsg = "Password must contain at least one uppercase letter, one number, one special character, and be between 8 to 12 characters long.";
     } else {
         $passcode = password_hash($passcode, PASSWORD_BCRYPT); // Hash the password if it passes validation
     }

     if (empty($username)) {
         $showAlert = true;
         $errorMsg = "Please enter a valid username!";
     } else if (!empty($errorMsg)) {
         $showAlert = true;
         $errorMsg = "Password must contain at least one uppercase letter, one number, one special character, and be between 8 to 12 characters long";
         
     } else {
         $sql = "INSERT INTO tbluser (username, passcode, accounttype) VALUES (:username, :passcode, :accounttype)";
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>
<body>
<div class="background-image-container">
    <div class="container">
        <form action="register.php" method="POST">
        <img src="image/isu.png" alt="Login Image" class="login-image">
            <h2><Center>Sign Up</Center></h2>
            
            <div class="line"></div>
            
        
            <label>Username:</label><br>
            <input type="text" name="username"><br><br>
        
            <label>Password:</label><br>
            <input type="password" name="passcode" id="passcode" required><br><br>
            <input type="checkbox" id="showPassword"> Show Password
        
            <button class="btn1" type="submit" name="btnSave">Sign Up</button>
            <p>Have already account? <a href="index.php"  style="color: #fbab60;">Login here</a></p>
        </form>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('showPassword').addEventListener('change', function() {
                var passwordField = document.getElementById('passcode');
                if (passwordField) { // Check if the password field exists
                    if (this.checked) {
                        passwordField.type = 'text';
                    } else {
                        passwordField.type = 'password';
                    }
                } else {
                    console.error('Password field not found');
                }
            });
        });
</script>
</body>

<script>
    <?php if ($showAlert) { ?>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: '<?php echo $errorMsg; ?>',
        });
        <?php } ?>
        
</script>

</html>



<style>
        body {
            background-color: #ffe4cd;
            background-image: url(Style/Images/bg.jpg);
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        form {
            width: 330px;
            padding: 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            border: 1px solid #ccc;
        }

        .background-image-container {
            background-image: url('image/ccsict.png'); /* Replace 'path/to/background/image.jpg' with the actual path to your background image */
            background-size: 650px;
            background-repeat: no-repeat;
            background-position-x: 400px;
            height: 120vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .login-image {
            display: block;
            margin: 0 auto; /* Center the image horizontally */
            margin-top: -10px;
            margin-bottom: 30px; /* Adjust the top margin as needed */
            width: 100px; /* Set the width of the image */
            height: auto; /* Maintain aspect ratio */
        }

        .form1 {/*form2*/
            width: 300px;
            padding: 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            border: 1px solid #ccc;
        }

        h2,
        label {
            margin-top: -12px;
            font-family: arial, sans-serif;
        }

        .line {
            border-bottom: 1px solid #ccc;
            margin: 15px 0;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            height: 30px;
            border-radius: 5px;
            border: 2px solid #ccc;
        }

        .btn1 {
            background: #fbab60;
            width: 337px;
            height: 30px;
            border-radius: 5px;
            border: none;
            color: white;
        }

        .btn2 {
            background: #fbab60;
            width: 308px;
            height: 30px;
            border-radius: 5px;
            border: none;
            color: white;
    
        p {
            font-family: arial, sans-serif;
        }

        /* Popup styles */
        .login-popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding-top: 50px;
            padding-bottom: 50px;
            border-radius: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            z-index: 999;
        }

        /* Overlay styles */
        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 998;
        }
    </style>

    