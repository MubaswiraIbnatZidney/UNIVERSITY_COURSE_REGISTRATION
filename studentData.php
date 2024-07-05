<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Data</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styleedit.css">
</head>
<body>
<?php include("navtrans.php");
 ?>

<div class="container mt-5">
<h1 class="text-light">Student Data</h1>
    <table class="table table-dark">
        <thead class="thead-dark">
            <tr>
                <th>Student_ID</th>
                <th>FirstName</th>
                <th>LastName</th>
                <th>Address</th>
                <th>Email</th>
                <th>Department</th>
                <th>Semester</th>
                <th>CGPA</th>
                <th colspan="2">Actions</th>  
                
                
            </tr>
        </thead>
        <tbody>
            <?php
             include("connection.php");

            // Fetching data from the database
            $sql = "SELECT Student_ID,FirstName,LastName,Address,Email,department,semester,cgpa FROM student";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Outputting data of each row
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["Student_ID"] . "</td>";
                    echo "<td>" . $row["FirstName"] . "</td>";
                    echo "<td>" . $row["LastName"] . "</td>";
                    echo "<td>" . $row["Address"] . "</td>";
                    echo "<td>" . $row["Email"] . "</td>";
                    echo "<td>" . $row["department"] . "</td>";
                    echo "<td>" . $row["semester"] . "</td>";
                    echo "<td>" . $row["cgpa"] . "</td>";
                    

                    echo "<td><a href='editStudent.php?Student_ID=" . $row["Student_ID"] . "' class='btn btn-primary'>Edit</a></td>";
                    echo "<td><a href='deleteStudent.php?Student_ID=" . $row["Student_ID"] . "' class='btn btn-danger mr-2'>Delete</a>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No records found</td></tr>";
            }
            $conn->close();
            ?>
        </tbody>
    </table>
</div>



<div class="bottom-navbar">
        <a href="studentsignup.php" class="button-link-left">Add New</a>
       
    </div>


</body>
</html>
