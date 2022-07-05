<?php
// below line is the connection line of our crud 
$connection= mysqli_connect("localhost","root","root","student_db");

// Check connection
if($connection === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
