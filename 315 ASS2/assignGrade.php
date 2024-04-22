<?php
require 'db.php';

$conn=$connection;

// Function for proper sanitization of data. Trims. strips. protects.

function sanitize($data){

    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;

}
$coursecode = sanitize($_POST["ccode"]);
$studentid = sanitize((int)$_POST["stud"]);
$grade = sanitize($_POST["grade"]);
//method for searching courses
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
        //echo $coursecode+" does not exist";
        }

        return $found;
}

function searchStudent($studentid, $conn)
{
        $found = false;
        $sql = "SELECT studentid FROM student WHERE studentid=$studentid";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $found = true;
            echo $found;
        }

        } 
        else {
        //echo $studentid." does not exist";
        }

        return $found;
}
if( $grade > 100)
{
    echo "grade is less than a 100%";
}
else if($grade < 0)
{
    echo "grade is not allowed to be in the negatives";
}
else if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if((searchStudent($studentid, $conn) == True) && (searchCourse($coursecode, $conn)))
        {
            echo("method works")."<br>";
            echo $studentid." ".$coursecode;
            $stmt = $conn->prepare("INSERT INTO gradebook(coursecode, studentid , grade) VALUES(?,?,?)");
            // b)set parameters and execute. Here we are assigning the values extracted from form. 
            $stmt->bind_param("sid", $coursecode, $studentid, $grade );
            
            //$stmt->execute(); will be enough to just insert the record, but to also get feedback on whether it was successful or not, use as 
            //part of an if statement as below.
            if($stmt->execute())
            {
                echo("record inserted into gradeBook");
                //header("Location: ../gradebook.html");
            }
            else {
                echo "Error inserting record: " . $stmt->error;  //print any error messages    
                //header("Location: gradebook.html");  
            }

            $stmt->close();
            }

            else
            {
                //echo("verify search method");
                header("Location: gradebook.html");
                //echo '<div class="messagesbox">Mail was sent</div>';
            }
        
}

?>