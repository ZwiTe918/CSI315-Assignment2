<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
    <style>
        table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
        font-size: 50px;
        padding: 10px;
        }

        table.center {
        margin-left: auto; 
        margin-right: auto;
        }
        tr:nth-child(even) {
        background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <ul>
        <li><a href="course.html">Courses</a> </li>
        <li><a href="student.html">Student</a> </li>
        <li><a href="gradebook.html">GradeBook</a> </li>
        <li><a href="reports.html">Reports</a> </li>
    </ul>
        
    <!-- results for searching for a student-->
    <h1>results for searching for a student ok</h1>
    <?php 
        require 'db.php';
        $conn=$connection;
        $student = $_POST["search"];
        function searchStudent($student, $conn)
        {
                $found = false;
                $sql = "SELECT studentid FROM student";
                $result = mysqli_query($conn, $sql);
                
                if (mysqli_num_rows($result) > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    $found = true;
                }

                } 
                else {
                    echo $student." does not exist";
                }

                return $found;
        }
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            if((searchStudent($student, $conn)))
            {
                $sql = "SELECT * FROM student WHERE studentid=$student";
                $result = mysqli_query($conn, $sql);
                
                if (mysqli_num_rows($result) > 0) {
                // output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo "<h1>StudentID: ".$row['studentid']."</h1><br>";
                        echo "<h1>Student Name: ".$row['name']."</h1>";

                        $sqlc = "SELECT coursecode FROM gradebook WHERE studentid=$student";
                        $resultc = mysqli_query($conn, $sqlc);
                        $course="";
                        if (mysqli_num_rows($resultc) > 0) {
                        // output data of each row
                            while($rowc = $resultc->fetch_assoc()) {
                                //echo "<h1>CourseCode: ".$rowc['coursecode']."</h1>";

                                $course = $rowc['coursecode'];
                                $sqlt = "SELECT coursetitle FROM course WHERE coursecode='$course'";
                                $resultt = mysqli_query($conn, $sqlt);
                                
                                if (mysqli_num_rows($resultt) > 0) {
                                // output data of each row
                                    while($rowt = $resultt->fetch_assoc()) {
                                        //echo "<h1>CourseTitle: uu".$rowt['coursetitle']."</h1><br>";
                                        $course = $rowt['coursetitle'];
                                    }
                                }            
                            }
                        }
                        $sqlg = "SELECT * FROM gradebook WHERE studentid=$student";
                        $resultg = mysqli_query($conn, $sqlg);
                                        
                        if (mysqli_num_rows($resultg) > 0) {
                        // output data of each row
                        while($rowg = $resultg->fetch_assoc()) {
                            echo "<h1>CourseTitle: ".$rowg['coursecode']."</h1><br>";
                            echo "<h1>CourseTitle: ".$course."</h1><br>";
                            echo "<h1>Course Grade: ".$rowg['grade']."</h1><br>";
                            }
                        }
                    }
                }
            }
        } 
    ?>

    
</body>
</html>