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

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Getting data & storing into variables.
    $course_code = sanitize($_POST["ccode"]);
    $course_title = sanitize($_POST["ctitle"]);

    if (empty($course_title)) {
        $nameErr = "course_title is required";
        } 
        else {
            // check if course_title only contains letters and whitespace
            if (!preg_match("/"."^[a-zA-Z ]*$/",$course_title)) {
                $nameErr = "Only letters and white space allowed";
            }
            else{
                $stmt = $conn->prepare("INSERT INTO course(coursecode , coursetitle) VALUES(?,?)");
        
                $stmt->bind_param("ss", $course_code, $course_title);
                

                //$stmt->execute(); will be enough to just insert the record, but to also get feedback on whether it was successful or not, use as 
                //part of an if statement as below.
                if($stmt->execute())
                {
                    echo("record inserted into course");
                    header("Location: course.html");
                }
                else {
                    echo "Error inserting record: " . $stmt->error;  //print any error messages      
                }

                $stmt->close();
            }
        }


}



?>