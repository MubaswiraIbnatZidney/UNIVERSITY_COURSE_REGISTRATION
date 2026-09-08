<?php
include('connection.php');

if (isset($_GET['dept_ID']) && is_numeric($_GET['dept_ID'])) {
    $dept_ID = $_GET['dept_ID'];

    $sql = "DELETE FROM department WHERE dept_ID = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("i", $dept_ID);
        if ($stmt->execute()) {
            echo '<script>
            window.location.href="deptData.php";
            alert("Dept. Info Deleted Successfully!!");
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
