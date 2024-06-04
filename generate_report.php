<?php
require 'vendor/autoload.php';
require 'MyReport.php';



// Set up KoolReport based on selected fields
$report = new MyReport();
$report->setup($_GET['fields']);


$report->run();

?>