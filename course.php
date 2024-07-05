<?php
include("connection.php");

class CourseManager {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function handleCourseSubmission() {
        if (isset($_POST['sub'])) {
            $courseData = $this->sanitizeInputData($_POST);
            if ($this->isCourseExist($courseData['title'])) {
                $this->redirectWithMessage("Course Already Exists!!");
            } else {
                $this->addCourse($courseData);
                $this->redirectWithMessage("Course Added Successfully!!");
            }
        }
    }

    private function sanitizeInputData($data) {
        return [
            'title' => mysqli_real_escape_string($this->conn, $data['title']),
            'credit' => mysqli_real_escape_string($this->conn, $data['credit']),
            'department' => mysqli_real_escape_string($this->conn, $data['department']),
            'no_of_seats' => mysqli_real_escape_string($this->conn, $data['no_of_seats']),
            'CheckIn' => mysqli_real_escape_string($this->conn, $data['CheckIn']),
            'CheckOut' => mysqli_real_escape_string($this->conn, $data['CheckOut']),
            'dept_ID' => mysqli_real_escape_string($this->conn, $data['dept_ID']),
            'Instructor_ID' => mysqli_real_escape_string($this->conn, $data['Instructor_ID']),
            'semester' => mysqli_real_escape_string($this->conn, $data['semester'])
        ];
    }

    private function isCourseExist($title) {
        $sql = "SELECT * FROM course WHERE title = ?";
        $stmt = mysqli_prepare($this->conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $title);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return mysqli_num_rows($result) > 0;
    }

    private function addCourse($courseData) {
        $sql = "INSERT INTO course (title, credit, department, semester, no_of_seats, CheckIn, CheckOut, dept_ID, Instructor_ID) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($this->conn, $sql);
        mysqli_stmt_bind_param(
            $stmt, "sssssssss", 
            $courseData['title'], 
            $courseData['credit'], 
            $courseData['department'], 
            $courseData['semester'], 
            $courseData['no_of_seats'], 
            $courseData['CheckIn'], 
            $courseData['CheckOut'], 
            $courseData['dept_ID'], 
            $courseData['Instructor_ID']
        );
        mysqli_stmt_execute($stmt);
    }

    private function redirectWithMessage($message) {
        echo '<script>
                window.location.href="course.php";
                alert("' . $message . '");
              </script>';
        exit;
    }
}

$courseManager = new CourseManager($conn);
$courseManager->handleCourseSubmission();
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
  <a href="courseData.php" class="button-link-center big-prominent-button">View Course Info</a>
</div>


  <div id="sform">
        <h1 id="heading">ADD COURSE INFO</h1><br>
        <form name="form" action="course.php" method="POST">

            <label>Course Title: </label>
            <input type="text" id="title" name="title" required><br><br>
            <label>Course Credit: </label>
            <input type="text" id="credit" name="credit" required><br><br>
            <label>Department: </label>
            <input type="text" id="department" name="department" required><br><br>
            <label>Semester: </label>
            <input type="number" id="semester" name="semester" required><br><br>
            <label>No. of seats: </label>
            <input type="text" id="no_of_seats" name="no_of_seats" required><br><br>
            <label>CheckIn time: </label>
            <input type="time" id="CheckIn" name="CheckIn" required><br><br>
            <label>CheckOut time: </label>
            <input type="time" id="CheckOut" name="CheckOut" required><br><br>
            <label>Department ID: </label>
            <input type="number" id="dept_ID" name="dept_ID" required><br><br>
            <label>Instructor ID:  </label>
            <input type="number" id="Instructor_ID" name="Instructor_ID" required><br><br>

            <!--Button-->
            <input type="submit" id="btn" value="SUBMIT" name = "sub"/>
        </form>
        
    </div>
      
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    
    
    
</body>
</html>
