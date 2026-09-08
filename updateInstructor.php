<?php
include('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Instructor_ID = $_POST['Instructor_ID'];
    $Instructor_Code = $_POST['Instructor_Code'];
    $FirstName = $_POST['FirstName'];
    $LastName = $_POST['LastName'];
    $Department = $_POST['Department'];

    $sql = "UPDATE instructor SET Instructor_Code=?, FirstName=?, LastName=?, Department=? WHERE Instructor_ID=?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ssssi", $Instructor_Code, $FirstName, $LastName, $Department, $Instructor_ID);

        if ($stmt->execute()) {
            echo '<script>
                     window.location.href="InstructorData.php";
                     alert("Instructor Info Updated Successfully!!");
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
