<?php
require_once('includes/dbconnection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize form data
    $studentId = $_POST['studentId'];
    $guardianFirstName = mysqli_real_escape_string($conn, $_POST['guardianFirstName']);
    $guardianLastName = mysqli_real_escape_string($conn, $_POST['guardianLastName']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $school = mysqli_real_escape_string($conn, $_POST['school']);
    $studentStatus = $_POST['studentStatus'];
    $dropoutReason = mysqli_real_escape_string($conn, $_POST['dropoutReason']);
    $otherDropoutReason = mysqli_real_escape_string($conn, $_POST['otherDropoutReason']);

    // Get the current values for auditing
    $selectSql = "SELECT guardian_first_name, guardian_last_name, phone, email, school_name, student_status, dropout_reason, other_dropout_reason FROM student WHERE id = ?";
    $stmtSelect = mysqli_prepare($conn, $selectSql);

    if ($stmtSelect) {
        mysqli_stmt_bind_param($stmtSelect, "i", $studentId);
        if (mysqli_stmt_execute($stmtSelect)) {
            $resultSelect = mysqli_stmt_get_result($stmtSelect);

            if ($rowSelect = mysqli_fetch_assoc($resultSelect)) {
                $oldGuardianFirstName = $rowSelect['guardian_first_name'];
                $oldGuardianLastName = $rowSelect['guardian_last_name'];
                $oldPhone = $rowSelect['phone'];
                $oldEmail = $rowSelect['email'];
                $oldSchool = $rowSelect['school_name'];
                $oldStatus = $rowSelect['student_status'];
                $oldDropoutReason = $rowSelect['dropout_reason'];
                $oldOtherDropoutReason = $rowSelect['other_dropout_reason'];

                // Check which fields are updated and prepare an update statement for the 'student' table
                $updateSql = "UPDATE student SET guardian_first_name = ?, guardian_last_name = ?, phone = ?, email = ?, school_name = ?, student_status = ?, dropout_reason = ?, other_dropout_reason = ? WHERE id = ?";
                $stmtUpdate = mysqli_prepare($conn, $updateSql);

                if ($stmtUpdate) {
                    mysqli_stmt_bind_param($stmtUpdate, "ssssssssi", $guardianFirstName, $guardianLastName, $phone, $email, $school, $studentStatus, $dropoutReason, $otherDropoutReason, $studentId);

                    if (mysqli_stmt_execute($stmtUpdate)) {
                        // Provide a response indicating which fields were updated
                        $updatedFields = [];

                        if ($guardianFirstName !== $oldGuardianFirstName) {
                            $updatedFields[] = 'Guardian First Name';
                        }
                        if ($guardianLastName !== $oldGuardianLastName) {
                            $updatedFields[] = 'Guardian Last Name';
                        }
                        if ($phone !== $oldPhone) {
                            $updatedFields[] = 'Phone';
                        }
                        if ($email !== $oldEmail) {
                            $updatedFields[] = 'Email';
                        }
                        if ($school !== $oldSchool) {
                            $updatedFields[] = 'School';
                        }
                        if ($studentStatus !== $oldStatus) {
                            $updatedFields[] = 'Student Status';
                        }
                        if ($dropoutReason !== $oldDropoutReason) {
                            $updatedFields[] = 'Dropout Reason';
                        }
                        if ($otherDropoutReason !== $oldOtherDropoutReason) {
                            $updatedFields[] = 'Other Dropout Reason';
                        }

                        if (!empty($updatedFields)) {
                            echo "Student information updated successfully. Updated fields: " . implode(', ', $updatedFields);
                        } else {
                            echo "No changes made.";
                        }
                    } else {
                        echo "Error updating student information: " . mysqli_error($conn);
                    }
                } else {
                    echo "Error preparing the update statement: " . mysqli_error($conn);
                }
            } else {
                echo "Student not found.";
            }
        } else {
            echo "Error executing select statement: " . mysqli_error($conn);
        }
    } else {
        echo "Error preparing the select statement: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request.";
}
?>
