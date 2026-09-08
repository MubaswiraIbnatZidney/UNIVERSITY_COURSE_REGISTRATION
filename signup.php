<?php
    include("connection.php");

    function isStrongPassword($password) {
        $strongRegex = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*]).{8,}$/";
        $mediumRegex = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{6,}$/";

        if (preg_match($strongRegex, $password)) {
            return "Strong";
        } elseif (preg_match($mediumRegex, $password)) {
            return "Medium";
        } else {
            return "Weak";
        }
    }

    if(isset($_POST['submit'])){
        $username = $_POST['user'];
        $password = $_POST['pass'];
        $cpassword = $_POST['cpass'];

        $sql = "SELECT * FROM admin WHERE username=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $count_user = $result->num_rows;
        $stmt->close();

        if($count_user == 0){
            if($password == $cpassword){
                // Check if the password is strong
                $passwordStrength = isStrongPassword($password);

                if($passwordStrength === "Strong" || $passwordStrength === "Medium"){
                    $hash = password_hash($password, PASSWORD_DEFAULT);
                    $sql2 = "INSERT INTO admin(username, password) VALUES(?, ?)";
                    $stmt2 = $conn->prepare($sql2);
                    $stmt2->bind_param("ss", $username, $hash);

                    if($stmt2->execute()){
                        header("Location: login.php");
                        die();
                    } else {
                        echo '<script>
                            alert("Error: Unable to register. Please try again later.");
                            window.location.href = "signup.php";
                        </script>';
                    }
                    $stmt2->close();
                } else {
                    echo '<script>
                        alert("Password is too weak. Please use a stronger password.");
                        window.location.href = "signup.php";
                    </script>';
                }
            } else {
                echo '<script>
                    alert("Passwords do not match");
                    window.location.href = "signup.php";
                </script>';
            }
        } else {
            echo '<script>
                alert("Username already exists");
                window.location.href = "signup.php";
            </script>';
        }
    }
?>
<?php include("navbar.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hogwarts University - Admin SignUp</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="stylez.css">
    <style>
        .strength-indicator {
            font-size: 0.8em;
        }
        .weak {
            color: red;
        }
        .strong {
            color: green;
        }
    </style>
</head>
<body>
    <div id="form" class="container">
        <h1 id="heading">Admin SignUp Form</h1><br>
        <form name="form" action="signup.php" method="POST">
            <label for="user">Enter Username: </label>
            <input type="text" id="user" name="user" required><br><br>

            <label for="pass">Create Password: </label>
            <input type="password" id="pass" name="pass" required onkeyup="checkPasswordStrength()"><br>
            <span id="password-strength" class="strength-indicator"></span><br><br>

            <label for="cpass">Retype Password: </label>
            <input type="password" id="cpass" name="cpass" required><br><br>

            <input type="submit" id="btn" value="SignUp" name="submit"/>
        </form>
        <div class="back">
            <a class="btn btn-outline-primary" type="submit" href="home.php">Back</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function checkPasswordStrength() {
            var password = document.getElementById("pass").value;
            var strengthIndicator = document.getElementById("password-strength");

            var strongRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*]).{8,}$/;
            var mediumRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{6,}$/;

            if (strongRegex.test(password)) {
                strengthIndicator.innerHTML = "Strong";
                strengthIndicator.className = "strength-indicator strong";
            } else if (mediumRegex.test(password)) {
                strengthIndicator.innerHTML = "Medium";
                strengthIndicator.className = "strength-indicator";
            } else {
                strengthIndicator.innerHTML = "Weak";
                strengthIndicator.className = "strength-indicator weak";
            }
        }
    </script>
</body>
</html>
