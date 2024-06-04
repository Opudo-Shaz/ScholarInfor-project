<?php
require 'vendor/autoload.php'; // Path to autoload.php from Composer

use PhpOffice\PhpSpreadsheet\IOFactory;

$excelFile = 'path_to_excel_file.xlsx'; // Replace with your Excel file path

// MySQL database connection parameters
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'faweall';

try {
    // Load the Excel file
    $spreadsheet = IOFactory::load($excelFile);
    $worksheet = $spreadsheet->getActiveSheet();
    
    // Database connection
    $conn = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    
    // Iterate through each row in the Excel file
    foreach ($worksheet->getRowIterator() as $row) {
        $cellIterator = $row->getCellIterator();
        $cellIterator->setIterateOnlyExistingCells(FALSE);
        
        $data = [];
        foreach ($cellIterator as $cell) {
            $data[] = $cell->getValue();
        }
        
        // Insert the data into the MySQL table (assuming you have a table named 'student')
        $sql = "INSERT INTO student (first_name, middle_name, last_name, gender, guardian_first_name, guardian_middle_name, guardian_last_name, age, date_of_birth, school_name, expected_completion_date, student_status, dropout_reason, other_dropout_reason) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $conn->prepare($sql);
        $stmt->execute($data);
    }
    
    echo "Data imported successfully.";
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
?>
