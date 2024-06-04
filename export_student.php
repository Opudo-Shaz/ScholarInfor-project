<?php
require 'vendor/autoload.php';
require_once "includes/dbconnection.php";
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Query to fetch data
$query = "SELECT * FROM student";
$result = $conn->query($query);

$data = array();
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

// Create a new Spreadsheet object
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Set headers
$columns = array_keys($data[0]);
array_shift($columns); // Remove the first column name
$sheet->setCellValueByColumnAndRow(1, 1, 'ID'); // Add a new column for auto numbers
$columnIndex = 2;
foreach ($columns as $column) {
    $sheet->setCellValueByColumnAndRow($columnIndex, 1, $column);
    $columnIndex++;
}

// Set data
$rowIndex = 2;
$id = 1; // Initialize auto-incremented number
foreach ($data as $row) {
    $sheet->setCellValueByColumnAndRow(1, $rowIndex, $id); // Set auto number
    $id++; // Increment the auto number
    $columnIndex = 2;
    foreach ($row as $columnName => $value) {
        if ($columnName !== 'id') { // Skip the original ID column
            $sheet->setCellValueByColumnAndRow($columnIndex, $rowIndex, $value);
            $columnIndex++;
        }
    }
    $rowIndex++;
}

// Create Excel writer
$writer = new Xlsx($spreadsheet);

// Set appropriate headers for download
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="student_details_export.xlsx"');
$writer->save('php://output');


?>