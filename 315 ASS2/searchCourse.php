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
        
    <!-- results for searching a course-->
    <h1>results for searching a course</h1>
    <table class="center">
        <tr>
            <th>CourseCode</th>
            <th>CourseTitle</th>
        </tr>
        <?php
            require 'db.php';
            $conn=$connection;
            $coursecode = $_POST["search"];
            function searchCourse($coursecode, $conn)
            {
                    $found = false;
                    $sql = "SELECT coursecode FROM course WHERE coursecode='$coursecode'";
                    $result = mysqli_query($conn, $sql);
                    
                    if (mysqli_num_rows($result) > 0) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                        $found = true;
                    }

                    } 
                    else {
                    echo $coursecode+" does not exist";
                    }

                    return $found;
            }
            if ($_SERVER["REQUEST_METHOD"] == "POST") {

                if((searchCourse($coursecode, $conn)))
                {
                    $sql = "SELECT * FROM course WHERE coursecode='$coursecode'";
                    $result = mysqli_query($conn, $sql);
                    
                    if (mysqli_num_rows($result) > 0) {
                    // output data of each row
                        while($row = $result->fetch_assoc()) {
                            $found = true;
                            ?>  
                                <tr>
                                    <td><?php echo $row['coursecode'] ?></td>
                                    <td><?php echo $row['coursetitle'] ?></td>
                                </tr>
                                
                                <?php
                        } ?>
                        </table><br>

                        <h1 class="searchval">Students taking <?php echo $coursecode?> course</h1>
                        <table class="center">
                        <tr>
                            <th>Student ID</th>
                            <th>Email Address</th>
                            <th>Full Name</th>
                            <th>Postal Address</th>
                        </tr>
                <?php
                        $sqlq = "SELECT * FROM gradebook WHERE coursecode='$coursecode'";
                        $resultq = mysqli_query($conn, $sqlq);
                        if (mysqli_num_rows($resultq) > 0) {
                            while($rowq = $resultq->fetch_assoc()) {
                                $stud = $rowq['studentid'];
                                $sqli = "SELECT * FROM student WHERE studentid=$stud";
                                $resulti = mysqli_query($conn, $sqli);
                                    while(($rowi = mysqli_fetch_array($resulti))) {
                                             echo "</tr><td>".$rowi['studentid']."</td>";
                                             echo "<td>".$rowi['emailaddress']."</td>";
                                             echo "<td>".$rowi['name']."</td>";
                                             echo "<td>".$rowi['postaladdress']."</td></tr>";
                                        
                                
                                 }
                         
                            }
                        }?>
                        </table><br> <?php

                    } 
                    else {
                    }
                }
        
                else
                {
                    echo("course doenst exist");
                }
                
        }
        
              ?>
    
    
</body>
</html>