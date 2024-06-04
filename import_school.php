<?php
require 'vendor/autoload.php';
require_once "includes/dbconnection.php"; // Include your database connection
use PhpOffice\PhpSpreadsheet\IOFactory;

$allowed_ext = ['xls', 'csv', 'xlsx'];

if (isset($_POST["school_sub"])) {
    $fileName = $_FILES['file']['name'];
    $file_tmp = $_FILES['file']['tmp_name'];
    $file_ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    if (in_array($file_ext, $allowed_ext)) {
        // Move the uploaded file to a directory on your server
        $uploadDirectory = 'upload/';
        $uploadedFilePath = $uploadDirectory . $fileName;
        move_uploaded_file($file_tmp, $uploadedFilePath);

        // Load the uploaded Excel file
        $spreadsheet = IOFactory::load($uploadedFilePath);
        $worksheet = $spreadsheet->getActiveSheet();

        // Define expected headers as an array (excluding the ID column)
        $expectedHeaders = [
            "school_name",
            "county",
            "constituency",
            "ward",
            "school_level"
        ];

        $actualHeaders = [];

        // Get actual header columns from the uploaded file
        $rowIterator = $worksheet->getRowIterator();
        foreach ($rowIterator as $row) {
            $cellIterator = $row->getCellIterator();
            $cellIterator->rewind(); // Move to the first cell

            // Skip the first cell (ID column)
            $cellIterator->next();

            while ($cellIterator->valid()) {
                $actualHeaders[] = $cellIterator->current()->getValue();
                $cellIterator->next();
            }

            break; // Only read the first row for headers
        }

        // Check if actual headers match expected headers
        if ($actualHeaders !== $expectedHeaders) {
            header("Location: school_list.php?error=InvalidHeaders");
            exit();
        }

        // Process and validate data rows starting from the second row
        $data = [];
        $isFirstRow = true; // Add this flag to track the first row
        foreach ($rowIterator as $row) {
            if ($isFirstRow) {
                $isFirstRow = false;
                continue; // Skip the first row (headers)
            }

            $rowData = [];
            $cellIterator = $row->getCellIterator();

            // Skip the first cell (ID column)
            $cellIterator->next();

            while ($cellIterator->valid()) {
                $rowData[] = $cellIterator->current()->getValue();
                $cellIterator->next();
            }
            $data[] = $rowData;
        }

        // Prepare and insert data into the database
        $insertQuery = "INSERT INTO school (
            school_name,
            county,
            constituency, 
            ward,	
            school_level, 
            created, 
            modified
        ) VALUES (?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($insertQuery);

        foreach ($data as $row) {
            $created = date("Y-m-d H:i:s");
            $modified = date("Y-m-d H:i:s");

            $stmt->bind_param(
                "sssssss",
                $row[0],        // school_name
                $row[1],        // county
                $row[2],        // constituency
                $row[3],        // ward
                $row[4],        // school_level
                $created,
                $modified
            );

            if (!$stmt->execute()) {
                echo "Error: " . $stmt->error;
            }
        }

        $stmt->close();
        $conn->close();

        // Redirect with success message
        header("Location: school_list.php?success=1");
        exit();
    }
}
?>
