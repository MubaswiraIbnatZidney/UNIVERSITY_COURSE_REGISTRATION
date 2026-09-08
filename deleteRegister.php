<?php
include("connection.php");

if (isset($_GET['reg_id']) && is_numeric($_GET['reg_id'])) {
    $reg_id = $_GET['reg_id'];

    $sql = "DELETE FROM register WHERE reg_id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("i", $reg_id);
        if ($stmt->execute()) {
            echo '<script>
            window.location.href="registerData.php";
            alert("Register Info Deleted Successfully!!");
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
