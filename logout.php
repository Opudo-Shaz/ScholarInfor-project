<?php
session_start();
include("includes/dbconnection.php");
date_default_timezone_set('Africa/Kampala');
$ldate=date( 'd-m-Y h:i:s A', time () );
$email=$_SESSION['email'];

$_SESSION['errmsg']="You have successfully logout";
unset($_SESSION['cpmsaid']);
session_destroy(); // destroy session
header("location:index.php"); 
?>