<?php
include('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dept_ID = $_POST['dept_ID'];
    $name = $_POST['name'];
    $location = $_POST['location'];

    $sql = "UPDATE department SET name=?, location=? WHERE dept_ID=?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ssi", $name, $location, $dept_ID);

        if ($stmt->execute()) {
            echo '<script>
                     window.location.href="deptData.php";
                     alert("Dept. Info Updated Successfully!!");
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
