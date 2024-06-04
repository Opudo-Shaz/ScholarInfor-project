<?php


require_once('includes/dbconnection.php');


$id = $_GET['id'];


$query = "DELETE FROM school WHERE id='$id'";


$result = mysqli_query($conn, $query);


if ($result == true) {

    header("location:school_list.php");

}


?>