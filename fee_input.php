<?php
require_once('includes/dbconnection.php');
session_start();
$userData = $_SESSION['userData'];
require_once 'model/Role.php';
require_once 'model/Permission.php';
require_once 'model/PrivilegedUser.php';
$u = PrivilegedUser::getByEmail($userData['email']);

if (empty($userData) || !($u->hasRole("Admin") || $u->hasRole("Editor")|| (!$u->hasRole("Super_admin")))) {
    // If $userData is empty or the user doesn't have the specified roles, you can redirect to a login page or take appropriate action.
    header('Location: userAccount.php?logoutSubmit=1');
    exit();
}

if (empty($_SESSION['sessData'])) {
    header('location: logout.php');
    exit();
}

$studentId = isset($_GET['id']) && is_numeric($_GET['id']) ? $_GET['id'] : null;

// Fetch student details based on the provided student ID
$studentData = null;

if ($studentId !== null) {
    $sql = "SELECT s.id as student_id, s.first_name, s.last_name, s.school_name, sf.student_id as sf_student_id
            FROM student AS s
            LEFT JOIN school_fees AS sf ON s.id = sf.student_id
            WHERE s.id = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $studentId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        $studentData = mysqli_fetch_assoc($result);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Fee Input</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.css" />
            <link rel="stylesheet" type="text/css" href="assets/css/sweetalert.min.css">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
                crossorigin="anonymous">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
            <style type="text/css">
    body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
}

.container {
    max-width: 400px;
    margin: 0 auto;
    padding: 20px;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    border-radius: 5px;
    margin-top: 20px;
}

h2 {
    text-align: center;
}

form {
    margin-top: 20px;
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
</style>
</head>
<body>
    <div class="container">
        <h2>Student Information</h2>
        <table class="table table-bordered">
            <tr>
                <th>Student ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>School</th>
            </tr>
            <?php if ($studentData !== null) : ?>
                <tr>
                    <td><?php echo $studentData['student_id']; ?></td>
                    <td><?php echo $studentData['first_name']; ?></td>
                    <td><?php echo $studentData['last_name']; ?></td>
                    <td><?php echo $studentData['school_name']; ?></td>
                </tr>
            <?php else : ?>
                <tr>
                    <td colspan="4">Student not found</td>
                </tr>
            <?php endif; ?>
        </table>


        <h2>Student Fee Input Form</h2>
        <form id="feeForm">
            <input type="hidden" name="id" value="<?php echo $studentId; ?>">
            <div class="form-group">
                <label for="academic_year">Academic Year:</label>
                <input type="text" name="academic_year" id="academic_year" required>
            </div>
            <div class="form-group">
                <label for="term">Term:</label>
                <select name="term" id="term" required>
                    <option value="Term 1">Term 1</option>
                    <option value="Term 2">Term 2</option>
                    <option value="Term 3">Term 3</option>
                </select>
            </div>
            <div class="form-group">
                <label for="fee_amount">Fee Amount:</label>
                <input type="text" name="fee_amount" id="fee_amount" required>
            </div>
            <div class="form-group">
                <label for="fee_status">Fee Status:</label>
                <select name="fee_status" id="fee_status" required>
                    <option value="Paid">Paid</option>
                    <option value="Pending">Pending</option>
                    <option value="Overdue">Overdue</option>
                </select>
            </div>
            <button type="submit" class="btn-primary">Submit Fee</button>
        </form>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const feeForm = document.getElementById("feeForm");

            feeForm.addEventListener("submit", function (e) {
                e.preventDefault();

                const formData = new FormData(feeForm);

                fetch("save_fee.php", {
                    method: "POST",
                    body: formData,
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert("Fee details saved successfully.");
                        feeForm.reset();
                    } else {
                        alert("Error: " + data.error);
                    }
                })
                .catch(error => {
                    alert("An error occurred while saving fee details.");
                    console.error(error);
                });
            });
        });
    </script>
</body>
</html>