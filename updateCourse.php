<?php
include('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $course_id = $_POST['course_id'];
    $title = $_POST['title'];
    $credit = $_POST['credit'];
    $department = $_POST['department'];
    $no_of_seats = $_POST['no_of_seats'];
    $CheckIn = $_POST['CheckIn'];
    $CheckOut = $_POST['CheckOut'];

    $sql = "UPDATE course SET title=?, credit=?, department=?, no_of_seats=?, CheckIn=?, CheckOut=? WHERE course_id=?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("sisissi", $title, $credit, $department, $no_of_seats, $CheckIn, $CheckOut, $course_id);

        if ($stmt->execute()) {
            echo '<script>
                     window.location.href="courseData.php";
                     alert("Course Updated Successfully!!");
                 </script>';
        } else {
            echo "Error updating record: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
}
?>
