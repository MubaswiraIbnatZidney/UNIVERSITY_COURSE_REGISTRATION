<?php
// Establishing a connection to the database
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'db';

// Creating a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Checking the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $reg_id = $_POST['reg_id'];
    $status = $_POST['status'];
    $grade = $_POST['grade'];
    $date = $_POST['date'];
    $Student_ID = $_POST['Student_ID'];
    $course_id = $_POST['course_id'];
   

    $sql = "UPDATE register SET status='$status', grade='$grade', date='$date', Student_ID='$Student_ID', course_id='$course_id' WHERE reg_id=$reg_id";

    if ($conn->query($sql) === TRUE) {
        //  echo "Record updated successfully";
        echo '<script>
                 window.location.href="registerData.php";
                 alert("Register Info Updated Successfully!!");
             </script>';
    }
} else {
    echo "Error updating record: " . $conn->error;
}



$conn->close();
?>