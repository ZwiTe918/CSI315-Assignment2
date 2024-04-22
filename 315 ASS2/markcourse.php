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
                            <th>Course ID</th>
                            <th>Student ID</th>
                            <th>Grade</th>
                            <th>Pass Mark</th>
                        </tr>
        <?php
            require 'db.php';
            $conn=$connection;
            $sql = "SELECT * FROM gradebook";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "</tr><td>".$row['coursecode']."</td>";
                                echo "<td>".$row['studentid']."</td>";
                                $gr = $row['grade'];
                                echo "<td>".$gr."</td>";
                                if($gr < 50)
                                {
                                    echo "<td>"."Fail"."</td></tr>";
                                }
                                else
                                {
                                    echo "<td>"."Pass"."</td></tr>";
                                }
                         
                            }
                        }?>
                        </table><br>
    
    
</body>
</html>