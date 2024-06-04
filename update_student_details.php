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

    // Fetch student details based on the provided student ID and verification_status
    $sql = "SELECT id, school_name, guardian_first_name, guardian_last_name, gender, phone, email, date_of_birth, expected_completion_date, student_status, dropout_reason, other_dropout_reason
            FROM student
            WHERE id = ? AND verification_status = 'verified'"; // Add the WHERE clause for verification_status

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
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Verification</title>
    <style>
        /* Add your CSS styles here */
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background-color: #f5f5f5;
            width: 100%;
        }

        h1 {
            color: #333;
        }

        form {
            background-color: #fff;
            display: inline-block;
            padding: 100px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-top: 10px;
        }

        input {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
        }

        button {
            background-color: #007BFF;
            color: #fff;
            border: none;
            padding: 10px 20px;
            margin-top: 20px;
            cursor: pointer;
        }

        #result {
            color: #007BFF;
            font-weight: bold;
            margin-top: 10px;
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
    </style>
        <?php
        @include "includes/head.php"
    ?>

</head>
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
    <h1>Student Details</h1>
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
            <th>Guardian First Name</th>
            <td><?php echo $guardianFirstName; ?></td>
        </tr>
        <tr>
            <th>Guardian Last Name</th>
            <td><?php echo $guardianLastName; ?></td>
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
    <h1>Update Student Information</h1>
<form id="studentForm">
<input type="hidden" id="studentId" name="studentId" value="<?php echo $studentId; ?>"> <!-- Add this hidden input field to include studentId -->
    <label for="guardianFirstName">Guardian First Name:</label>
    <input type="text" id="guardianFirstName" name="guardianFirstName" value="<?php echo $guardianFirstName; ?>"><br>


    <label for="guardianLastName">Guardian Last Name:</label>
    <input type="text" id="guardianLastName" name="guardianLastName" value="<?php echo $guardianLastName; ?>"><br>

    <label for="phone">Phone:</label>
    <input type="text" id="phone" name="phone" maxlength="10" value="<?php echo $phone; ?>"><br>

    <label for="email">Email:</label>
    <input type="text" id="email" name="email" value="<?php echo $email; ?>"><br>

    <label for="school">School:</label>
    <input type="text" id="school" name="school" value="<?php echo $schoolName; ?>"><br>

    <label for="studentStatus">Student Status:</label>
<select id="studentStatus" name="studentStatus" onchange="handleStatusChange()">
    <option value="" disabled selected>Select Status</option>
    <option value="ongoing">Ongoing</option>
    <option value="dropout">Dropout</option>
</select><br>

<label for="dropoutReason">Dropout Reason:</label>
<input type="text" id="dropoutReason" name="dropoutReason" value="<?php echo $dropoutReason; ?>" disabled><br>

<label for="otherDropoutReason">Other Dropout Reason:</label>
<input type="text" id="otherDropoutReason" name="otherDropoutReason" value="<?php echo $otherDropoutReason; ?>" disabled><br>

    <button type="button" onclick="updateStudent()">Update</button>
</form>

<div id="result"></div>
</div>
<script>
function handleStatusChange() {
    var studentStatus = document.getElementById("studentStatus").value;
    var dropoutReasonInput = document.getElementById("dropoutReason");
    var otherDropoutReasonInput = document.getElementById("otherDropoutReason");

    if (studentStatus === "ongoing") {
        dropoutReasonInput.disabled = true;
        otherDropoutReasonInput.disabled = true;
    } else {
        dropoutReasonInput.disabled = false;
        otherDropoutReasonInput.disabled = false;
    }
}

function updateStudent() {
    var studentId = document.getElementById("studentId").value;
    var guardianFirstName = document.getElementById("guardianFirstName").value;
    var guardianLastName = document.getElementById("guardianLastName").value;
    var phone = document.getElementById("phone").value;
    var email = document.getElementById("email").value;
    var school = document.getElementById("school").value;
    var studentStatus = document.getElementById("studentStatus").value;
    var dropoutReason = document.getElementById("dropoutReason").value;
    var otherDropoutReason = document.getElementById("otherDropoutReason").value;

    var formData = new FormData();
    formData.append('studentId', studentId);
    formData.append('guardianFirstName', guardianFirstName);
    formData.append('guardianLastName', guardianLastName);
    formData.append('phone', phone);
    formData.append('email', email);
    formData.append('school', school);
    formData.append('studentStatus', studentStatus);
    formData.append('dropoutReason', dropoutReason);
    formData.append('otherDropoutReason', otherDropoutReason);

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'update_student.php', true);

    xhr.onload = function () {
        if (xhr.status === 200) {
            document.getElementById("result").innerHTML = xhr.responseText;
        }
    };

    xhr.send(formData);
    }</script>
</body>
</html>
