<?php
// Establishing a connection to the database
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'db';

// Creating a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Checking the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dept_ID = $_POST['dept_ID'];
    $name = $_POST['name'];
    $location = $_POST['location'];
    

    $sql = "UPDATE department SET name ='$name ', location='$location' WHERE dept_ID=$dept_ID";

    if ($conn->query($sql) === TRUE) {
        //  echo "Record updated successfully";
        echo '<script>
                 window.location.href="deptData.php";
                 alert("Dept. Info Updated Successfully!!");
             </script>';
    }
} else {
    echo "Error updating record: " . $conn->error;
}



$conn->close();
?>