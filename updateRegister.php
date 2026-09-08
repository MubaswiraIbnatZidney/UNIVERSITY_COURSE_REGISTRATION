<?php
include('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $reg_id = $_POST['reg_id'];
    $status = $_POST['status'];
    $grade = $_POST['grade'];
    $date = $_POST['date'];
    $Student_ID = $_POST['Student_ID'];
    $course_id = $_POST['course_id'];

    $sql = "UPDATE register SET status=?, grade=?, date=?, Student_ID=?, course_id=? WHERE reg_id=?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("sssisi", $status, $grade, $date, $Student_ID, $course_id, $reg_id);

        if ($stmt->execute()) {
            echo '<script>
                     window.location.href="registerData.php";
                     alert("Register Info Updated Successfully!!");
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
