<?php
include("connection.php");

if (isset($_GET['Instructor_ID']) && is_numeric($_GET['Instructor_ID'])) {
    $Instructor_ID = $_GET['Instructor_ID'];

    $sql = "DELETE FROM instructor WHERE Instructor_ID = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("i", $Instructor_ID);
        if ($stmt->execute()) {
            echo '<script>
            window.location.href="InstructorData.php";
            alert("Instructor Info Deleted Successfully!!");
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
