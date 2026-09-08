<?php
include('connection.php');

if (isset($_GET['course_id']) && is_numeric($_GET['course_id'])) {
    $course_id = $_GET['course_id'];

    $sql = "DELETE FROM course WHERE course_id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("i", $course_id);
        if ($stmt->execute()) {
            echo '<script>
            window.location.href="courseData.php";
            alert("Course Deleted Successfully!!");
            </script>';
        } else {
            echo "Error deleting record: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
} else {
    echo "Invalid request";
}
?>
