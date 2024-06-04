<?php


require_once('includes/dbconnection.php');


$id = $_GET['id'];


$query = "DELETE FROM student WHERE id='$id'";


$result = mysqli_query($conn, $query);


if ($result == true) {

    header("location:student_list.php");


}


?>