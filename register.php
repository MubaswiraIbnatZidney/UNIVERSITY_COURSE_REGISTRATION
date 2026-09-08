<?php
    include("connection.php");
    if(isset($_POST['sub'])){
        $status = $_POST['status'];
        $grade = $_POST['grade'];
        $Student_ID = $_POST['Student_ID'];
        $course_id = $_POST['course_id'];

        $sql = "SELECT * FROM register WHERE Student_ID=? AND course_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("is", $Student_ID, $course_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $count_user = $result->num_rows;
        $stmt->close();

        if($count_user == 0 ){
            $sql2 = "INSERT INTO register(status, grade, date, Student_ID, course_id) VALUES( ?, ?, CURRENT_TIMESTAMP(), ?, ?)";
            $stmt2 = $conn->prepare($sql2);
            $stmt2->bind_param("ssis", $status, $grade, $Student_ID, $course_id);

            if($stmt2->execute()){
                echo '<script>
                window.location.href="register.php";
                alert("Registration Successfull!!");
            </script>';
            }
            $stmt2->close();
        }
        else{
            if($count_user>0){
                echo '<script>
                    window.location.href="register.php";
                    alert("Student already registered in this course!!");
                </script>';
            }
        }
    }
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hogwarts University</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="stylez.css">
    <link rel="stylesheet" href="stylec.css">
</head>

<body>

<div class="header">
<?php include("navtrans.php");
 ?>
        <nav>
            <a href="Admin.php">
            <h1 style="color:azure;">HU</h1>
            <img src="images/hogwartslogo1.png" alt="logo"></a>
            <div class="nav-links">

                <ul>
                    <li><a href="course.php">COURSE</a></li>
                    <li><a href="department1.php">DEPERTMENT</a></li>
                    <li><a href="instructor.php">INSTRUCTOR</a></li>
                    <li><a href="register.php">REGISTER</a></li>
                    <li><a href="studentsignup.php">STUDENT</a></li>
                 </ul>
            </div>


        </nav>
  </div>

  <div class="view" style="text-align: center;">
  <a href="registerData.php" class="button-link-center big-prominent-button">View Register Info</a>
</div>

  <div id="rform">
        <h1 id="heading">REGISTER INFO</h1><br>
        <form name="form" action="register.php" method="POST">

            <label>Status: </label>
            <input type="text" id="status" name="status" required><br><br>
            <label>Grade: </label>
            <input type="text" id="grade" name="grade" required><br><br>
            <!--<label>Date: </label>
            <input type="text" id="date" name="date" required><br><br>-->
            <label>Student_ID: </label>
            <input type="number" id="Student_ID" name="Student_ID" required><br><br>
            <label>Course_id: </label>
            <input type="text" id="course_id" name="course_id" required><br><br>

            <!--Button-->
            <input type="submit" id="btn" value="SUBMIT" name = "sub"/>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

</body>
</html>
