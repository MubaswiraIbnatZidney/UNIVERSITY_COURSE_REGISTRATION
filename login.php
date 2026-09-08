<?php
    session_start();
    if(isset($_SESSION['username'])){
        header("Location: Admin.php");
        exit();
    }
?>
<?php
    $login = false;
    include('connection.php');
    if (isset($_POST['submit'])) {
        $username = $_POST['user'];
        $password = $_POST['pass'];

        $sql = "SELECT * FROM admin WHERE username = ?";
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();

            if ($row) {
                if (password_verify($password, $row["password"]) || $password === $row["password"]) {
                    // Added fallback for plain text password since db might have plain text (like '1234') based on readme
                    $login=true;

                    $_SESSION['username']= $row['username'];
                    $_SESSION['loggedin'] = true;
                    header("Location: Admin.php");
                    exit();
                } else {
                    echo  '<script>
                                alert("Login failed. Invalid username or password!!")
                                window.location.href = "login.php";
                            </script>';
                }
            } else {
                echo  '<script>
                            alert("Login failed. Invalid username or password!!")
                            window.location.href = "login.php";
                        </script>';
            }
            $stmt->close();
        }
    }
?>
<?php
include("connection.php");
include("navbar.php");
?>

<html>
    <head>
        <title>Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" href="stylez.css">

    </head>
    <body>
        <br><br>
        <div id="form">
            <h1 id="heading">Admin Login Form</h1>
            <form name="form" action="login.php" method="POST" required>
                <label>Enter Username: </label>
                <input type="text" id="user" name="user"></br></br>
                <label>Password: </label>
                <input type="password" id="pass" name="pass" required></br></br>
                <input type="submit" id="btn" value="Login" name = "submit"/>
            </form>
            <div class="back">
   <a class="btn btn-outline-primary" type="submit" href="home.php">Back</a>
    </div>
        </div>
        <script>
            function isvalid(){
                var user = document.form.user.value;
                if(user.length==""){
                    alert(" Enter username !");
                    return false;
                }

            }
        </script>
    </body>
</html>
