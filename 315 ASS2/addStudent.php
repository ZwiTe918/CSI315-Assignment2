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
function checkemail($str) {
    return (!preg_match("/"."^([20]{2}[0-9][0-9][0][0-9]{4})*@([ub]+\.)+([ac]+\.)[bw]{2}$/ix", $str)) ? FALSE : TRUE;
    }

if ($_SERVER["REQUEST_METHOD"] == "POST") {


        $studentid = sanitize($_POST["stud"]);
        $emailaddress = sanitize($_POST["email"]);
        $name = sanitize($_POST["fname"]);
        $postaladdress = sanitize($_POST["paddr"]);
        // Insert into db using Prepared Statements.

        if(!checkEmail($emailaddress))
        {
            echo "<h1>Error incorrect email format: </h1>";
            
        }
        else
        {
            $stmt = $conn->prepare("INSERT INTO student(studentid , emailaddress, name, postaladdress) VALUES(?,?,?,?)");

            $stmt->bind_param("ssss", $studentid, $emailaddress, $name, $postaladdress);
            

            //$stmt->execute(); will be enough to just insert the record, but to also get feedback on whether it was successful or not, use as 
            //part of an if statement as below.
            if($stmt->execute())
            {
                echo("record inserted into student");
                header("Location: student.html");
            }
            else {
                echo "Error inserting record: " . $stmt->error;  //print any error messages      
            }

            $stmt->close();
           
        }


}



?>