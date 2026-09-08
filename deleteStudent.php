<?php
include("connection.php");

if (isset($_GET['Student_ID']) && is_numeric($_GET['Student_ID'])) {
    $Student_ID = $_GET['Student_ID'];

    $sql = "DELETE FROM student WHERE Student_ID = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("i", $Student_ID);
        if ($stmt->execute()) {
            echo '<script>
            window.location.href="studentData.php";
            alert("Student Info Deleted Successfully!!");
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
