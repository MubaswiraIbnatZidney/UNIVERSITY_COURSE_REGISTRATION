<?php
include('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Student_ID = $_POST['Student_ID'];
    $FirstName= $_POST['FirstName'];
    $LastName = $_POST['LastName'];
    $Address = $_POST['Address'];
    $Email = $_POST['Email'];
    $department = $_POST['department'];
    $semester = $_POST['semester'];
    $cgpa = $_POST['cgpa'];

    $sql = "UPDATE student SET FirstName=?, LastName=?, Address=?, Email=?, department=?, semester=?, cgpa=? WHERE Student_ID=?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ssssssdi", $FirstName, $LastName, $Address, $Email, $department, $semester, $cgpa, $Student_ID);

        if ($stmt->execute()) {
            echo '<script>
                     window.location.href="studentData.php";
                     alert("Student info Updated Successfully!!");
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
