<?php
require_once('includes/dbconnection.php');
session_start();
$pageTitle = "Student Verification";
$userData = $_SESSION['userData'];
require_once 'model/Role.php';
require_once 'model/Permission.php';
require_once 'model/PrivilegedUser.php';
$u = PrivilegedUser::getByEmail($userData['email']);

if (empty($userData) || !($u->hasRole("Admin") || $u->hasRole("Editor") || (!$u->hasRole("Super_admin")))) {
    // If $userData is empty or the user doesn't have any of the specified roles, log out the user
    header('Location: userAccount.php?logoutSubmit=1');
    exit();
} else if (empty($_SESSION['sessData'])) {
    header('location: logout.php');
    exit();
}

// Check if 'id' parameter is set in the URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    // Get the student ID from the URL
    $studentId = $_GET['id'];

    // Fetch student details based on the provided student ID
    $sql = "SELECT id, school_name, guardian_first_name, guardian_last_name, gender, phone, email, date_of_birth, expected_completion_date, student_status, dropout_reason, other_dropout_reason FROM student WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $studentId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($result)) {
            $studentId = $row['id'];
            $schoolName = $row['school_name'];
            $guardianFirstName = $row['guardian_first_name'];
            $guardianLastName = $row['guardian_last_name'];
            $gender = $row['gender'];
            $phone = $row['phone'];
            $email = $row['email'];
            $dateOfBirth = $row['date_of_birth'];
            $expectedCompletionDate = $row['expected_completion_date'];
            $studentStatus = $row['student_status'];
            $dropoutReason = $row['dropout_reason'];
            $otherDropoutReason = $row['other_dropout_reason'];
        }
    } else {
        // Student not found
        $studentId = "N/A";
        $schoolName = "N/A";
        $guardianFirstName = "N/A";
        $guardianLastName = "N/A";
        $gender = "N/A";
        $phone = "N/A";
        $email = "N/A";
        $dateOfBirth = "N/A";
        $expectedCompletionDate = "N/A";
        $studentStatus = "N/A";
        $dropoutReason = "N/A";
        $otherDropoutReason = "N/A";
    }
} else {
    // If 'id' parameter is not set or not a valid number
    $studentId = "N/A";
    $schoolName = "N/A";
    $guardianFirstName = "N/A";
    $guardianLastName = "N/A";
    $gender = "N/A";
    $phone = "N/A";
    $email = "N/A";
    $dateOfBirth = "N/A";
    $expectedCompletionDate = "N/A";
    $studentStatus = "N/A";
    $dropoutReason = "N/A";
    $otherDropoutReason = "N/A";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Verification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 700px;
            margin: 0 auto;
            padding: 50px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            margin-top: 20px;
        }

        h2 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ccc;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .btn-primary {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }
        .success-message {
    background-color: #4CAF50; /* Green background color */
    color: white; /* Text color for success message */
    padding: 10px;
    margin-bottom: 10px;
    border-radius: 5px;
}

.error-message {
    background-color: #FF5733; /* Red background color */
    color: white; /* Text color for error message */
    padding: 10px;
    margin-bottom: 10px;
    border-radius: 5px;
}

        
    </style>
                <?php
            @include "includes/head.php"
                ?>
<script>
        document.addEventListener("DOMContentLoaded", function () {
            const urlParams = new URLSearchParams(window.location.search);
            const resultParam = urlParams.get("result");
            const studentId = urlParams.get("id"); // Get student ID from URL

            if (resultParam === "success") {
                displayMessage("Verification successful for Student ID: " + studentId, "success");
            } else if (resultParam === "error") {
                displayMessage("Error during verification for Student ID: " + studentId, "error");
            }

            function displayMessage(message, messageType) {
                const messageContainer = document.createElement("div");
                messageContainer.className = messageType === "success" ? "success-message" : "error-message";
                messageContainer.innerText = message;

                const container = document.querySelector(".container");
                container.insertBefore(messageContainer, container.firstChild);

                setTimeout(function () {
                    container.removeChild(messageContainer);
                }, 5000);
            }
        });
    </script>    </head>
<body>
    
<div class="main-wrapper">
                <!-- partial:partials/_sidebar.html -->
            <?php @include "includes/sidebar.php" ?>
                <!-- partial -->

                <div class="page-wrapper">
                    <!-- partial:partials/_navbar.html -->
                <?php @include "includes/header.php" ?>
                    <!-- partial -->

    <div class="container">
        <h2>Student Verification Form</h2>
        <!-- Display student details in a table -->
        <table>
            <tr>
                <th>Student ID</th>
                <td><?php echo $studentId; ?></td>
            </tr>
            <tr>
                <th>School Name</th>
                <td><?php echo $schoolName; ?></td>
            </tr>
            <tr>
                <th>Guardian Name</th>
                <td><?php echo $guardianFirstName . ' ' . $guardianLastName; ?></td>
            </tr>
            <tr>
                <th>Gender</th>
                <td><?php echo $gender; ?></td>
            </tr>
            <tr>
                <th>Phone</th>
                <td><?php echo $phone; ?></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><?php echo $email; ?></td>
            </tr>
            <tr>
                <th>Date of Birth</th>
                <td><?php echo $dateOfBirth; ?></td>
            </tr>
            <tr>
                <th>Expected Completion Date</th>
                <td><?php echo $expectedCompletionDate; ?></td>
            </tr>
            <tr>
                <th>Student Status</th>
                <td><?php echo $studentStatus; ?></td>
            </tr>
            <tr>
                <th>Dropout Reason</th>
                <td><?php echo $dropoutReason; ?></td>
            </tr>
            <tr>
                <th>Other Dropout Reason</th>
                <td><?php echo $otherDropoutReason; ?></td>
            </tr>
        </table>
        <form action="verify.php" method="post">
            <input type="hidden" name="student_id" value="<?php echo $studentId; ?>">
            <div class="form-group">
                <label for="verification_status">Verification Status:</label>
                <select name="verification_status" id="verification_status" required>
                    <option value="verified">Verified</option>
                    <option value="declined">Pending</option>
                    <option value="declined">Declined</option>
                </select>
            </div>
            <div class="form-group">
                <label for="remarks">Remarks:</label>
                <textarea name="remarks" id="remarks" rows="4"></textarea>
            </div>
            <button type="submit" class="btn-primary">Submit Verification</button>
        </form>
    </div>
</body>
</html>
