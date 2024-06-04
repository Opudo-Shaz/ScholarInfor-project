<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Record Fee Payment</title>
    <link rel="stylesheet" type="text/css" href="your-styles.css">
</head>
<body>
    <div class="container">
        <h2>Record Fee Payment</h2>
        <form id="feeForm">
            <!-- Include a hidden input field to store the student ID from the URL -->
            <input type="hidden" name="student_id" id="student_id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>">

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
            <button type="submit" class="btn-primary">Record Payment</button>
        </form>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const feeForm = document.getElementById("feeForm");

            feeForm.addEventListener("submit", function (e) {
                e.preventDefault();

                const formData = new FormData(feeForm);

                // Send the form data to the server for processing (PHP script)
                fetch("save_fee_payment.php", {
                    method: "POST",
                    body: formData,
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert("Fee payment recorded successfully.");
                        feeForm.reset();
                    } else {
                        alert("Error: " + data.error);
                    }
                })
                .catch(error => {
                    alert("An error occurred while processing the fee payment.");
                    console.error(error);
                });
            });
        });
    </script>
</body>
</html>
