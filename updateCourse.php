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
    $course_id = $_POST['course_id'];
    $title = $_POST['title'];
    $credit = $_POST['credit'];
    $department = $_POST['department'];
    $no_of_seats = $_POST['no_of_seats'];
    $CheckIn = $_POST['CheckIn'];
    $CheckOut = $_POST['CheckOut'];

    $sql = "UPDATE course SET title='$title', credit=$credit, department='$department',no_of_seats='$no_of_seats',CheckIn='$CheckIn',CheckOut='$CheckOut' WHERE course_id=$course_id";

    if ($conn->query($sql) === TRUE) {
        //  echo "Record updated successfully";
        echo '<script>
                 window.location.href="courseData.php";
                 alert("Course Updated Successfully!!");
             </script>';
    }
} else {
    echo "Error updating record: " . $conn->error;
}



$conn->close();
?>