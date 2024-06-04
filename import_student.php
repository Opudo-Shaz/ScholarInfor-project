<?php
require 'vendor/autoload.php';
require_once "includes/dbconnection.php"; // Include your database connection
use PhpOffice\PhpSpreadsheet\IOFactory;

$allowed_ext = ['xls', 'csv', 'xlsx'];

if (isset($_POST["student_sub"])) {
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

        // Define expected headers as an array
        $expectedHeaders = [
            "first_name",
            "middle_name",
            "last_name",
            "gender",
            "guardian_first_name",
            "guardian_middle_name",
            "guardian_last_name",
            "age",
            "date_of_birth",
            "school_name",
            "expected_completion_date",
            "student_status",
            "dropout_reason",
            "other_dropout_reason"
        ];

        $actualHeaders = [];

        // Get actual header columns from the uploaded file
        $rowIterator = $worksheet->getRowIterator();
        foreach ($rowIterator as $row) {
            foreach ($row->getCellIterator() as $cell) {
                $actualHeaders[] = $cell->getValue();
            }
            break; // Only read the first row for headers
        }

        // Check if actual headers match expected headers
        if ($actualHeaders !== $expectedHeaders) {
            header("Location: student_list.php?error=InvalidHeaders");
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
          foreach ($cellIterator as $cell) {
              $rowData[] = $cell->getValue();
          }
          $data[] = $rowData;
      }

        // Prepare and insert data into the database
        $insertQuery = "INSERT INTO student (
            first_name,
            middle_name,
            last_name,
            gender,
            guardian_first_name,
            guardian_middle_name,
            guardian_last_name,
            age,
            date_of_birth,
            school_name,
            expected_completion_date,
            student_status,
            dropout_reason,
            other_dropout_reason,
            created,
            modified
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($insertQuery);

       
            foreach ($data as $row) {
                $firstName = mysqli_real_escape_string($conn, $row[0]);
                $middleName = mysqli_real_escape_string($conn, $row[1]); // Assuming middle name is at index 2
                $lastName = mysqli_real_escape_string($conn, $row[2]);
                $gender = mysqli_real_escape_string($conn, $row[3]); // Assuming gender is at index 4
                $guardianFirstName = mysqli_real_escape_string($conn, $row[4]); // Assuming guardian first name is at index 5
                $guardianMiddleName = mysqli_real_escape_string($conn, $row[5]); // Assuming guardian middle name is at index 6
                $guardianLastName = mysqli_real_escape_string($conn, $row[6]); // Assuming guardian last name is at index 7
                $age = mysqli_real_escape_string($conn, $row[7]);
                $dateOfBirth = mysqli_real_escape_string($conn, $row[8]); // Assuming date of birth is at index 9
                $schoolName = mysqli_real_escape_string($conn, $row[9]); // Assuming school name is at index 10
                $expectedCompletionDate = mysqli_real_escape_string($conn, $row[10]); // Assuming expected completion date is at index 11
                $studentStatus = mysqli_real_escape_string($conn, $row[11]); // Assuming student status is at index 12
                $dropoutReason = mysqli_real_escape_string($conn, $row[12]); // Assuming dropout reason is at index 13
                $otherDropoutReason = mysqli_real_escape_string($conn, $row[13]); // Assuming other dropout reason is at index 1
                $created = date("Y-m-d H:i:s");
                $modified = date("Y-m-d H:i:s");
                // Prepare and insert data into the database
                $insertQuery = "INSERT INTO student (
                    first_name,
                    middle_name,
                    last_name,
                    gender,
                    guardian_first_name,
                    guardian_middle_name,
                    guardian_last_name,
                    age,
                    date_of_birth,
                    school_name,
                    expected_completion_date,
                    student_status,
                    dropout_reason,
                    other_dropout_reason, created, modified
                ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?,? ,?)";
    
                $stmt = $conn->prepare($insertQuery);
                $stmt->bind_param(
                    "sssssssissssssss",
                    $firstName,
                    $middleName,
                    $lastName,
                    $gender,
                    $guardianFirstName,
                    $guardianMiddleName,
                    $guardianLastName,
                    $age,
                    $dateOfBirth,
                    $schoolName,
                    $expectedCompletionDate,
                    $studentStatus,
                    $dropoutReason,
                    $otherDropoutReason,
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
        header("Location: student_list.php?success=1");
        exit();
    }
}
?>