<?php require_once('includes/dbconnection.php');
session_start(); ?>

<!DOCTYPE html>

<html>

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script>
        function findAge() {
            var day = document.getElementById("dateOfBirth").value;
            var DOB = new Date(day);
            var today = new Date();
            var Age = today.getTime() - DOB.getTime();
            Age = Math.floor(Age / (1000 * 60 * 60 * 24 * 365.25));
            if (Age >= 100 || Age < 1) {
                document.getElementById("ageStudent").value = "";
            } else {
                document.getElementById("ageStudent").value = Age;
            }

        }

        function checkYear() {
            var year = document.getElementById("expectedCompDate").value;
            var chosenYear = new Date(year);
            var currentYear = new Date();
            var diff = currentYear.getTime() - chosenYear.getTime();
            if (diff > 0) {
                document.getElementById("expectedCompDate").value = "";
            } else {
                document.getElementById("expectedCompDate").value = year;
            }

        }
    </script>
</head>

<body>
    <?php


    require_once('includes/dbconnection.php');


    $id = $_GET['id'];



    $query = "SELECT * FROM student WHERE id='$id'";


    $result = mysqli_query($conn, $query);


    $row = mysqli_fetch_assoc($result);


    ?>
    <div class="container">

        <div class="card mt-4" id="form-body">

            <div class="card-header">

                Update Data

            </div>
            <div class="card-body">

                <form method="POST" action="update_data.php">

                    <div class="form-group">
                        <div class="row align-items-center justify-content-between ">
                            <h6>Student Details</h6>
                            <div class="col-sm-4">
                                <label for="firstName">First Name</label>
                                <input type="text" name="first_name" id="firstName" maxlength="50"
                                    value="<?php echo isset($row['first_name']) ? htmlspecialchars($row['first_name']) : ''; ?>"
                                    placeholder="First Name" class="form-control" required>
                            </div>

                            <div class="col-sm-4">
                                <label for="middleName">Middle Name</label>
                                <input type="text" name="middle_name" id="middleName" maxlength="50"
                                    value="<?php echo isset($row['middle_name']) ? htmlspecialchars($row['middle_name']) : ''; ?>"
                                    class="form-control" placeholder="Middle Name">

                            </div>
                            <div class="col-sm-4">
                                <label for="lastName">Last Name</label>
                                <input type="text" name="last_name" id="lastName" maxlength="50" class="form-control"
                                    value="<?php echo isset($row['last_name']) ? htmlspecialchars($row['last_name']) : ''; ?>"
                                    placeholder="Middle Name" required>
                            </div>
                        </div>
                        <fieldset class="mt-2">
                            <h6 class="h6">Gender</h6>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" id="maleRadio" name="gender" value="male"
                                    <?php echo (isset($row['gender']) && $row['gender'] === 'male') ? 'checked' : ''; ?> />
                                <label for="maleRadio" class="form-check-label"> Male </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" id="femaleRadio" name="gender"
                                    value="Female" <?php echo (isset($row['gender']) && $row['gender'] === 'Female') ? 'checked' : ''; ?> />
                                <label for="femaleRadio" class="form-check-label"> Female </label>
                            </div>
                        </fieldset>
                        <hr>
                        <div class="row mt-2 align-items-center justify-content-between">
                            <h6>Name of Parent/ Guardian</h6>
                            <div class="col-sm-4">
                                <label for="guardianFirstName">First Name</label>
                                <input type="text" name="guardian_first_name" id="guardianFirstName" maxlength="50"
                                    placeholder="First Name" class="form-control" required
                                    value="<?php echo isset($row['guardian_first_name']) ? htmlspecialchars($row['guardian_first_name']) : ''; ?>">
                            </div>

                            <div class="col-sm-4">
                                <label for="guardianMiddleName">Middle Name</label>
                                <input type="text" name="guardian_middle_name" id="guardianMiddleName" maxlength="50"
                                    placeholder="Middle Name" class="form-control" required
                                    value="<?php echo isset($row['guardian_middle_name']) ? htmlspecialchars($row['guardian_middle_name']) : ''; ?>">
                            </div>

                            <div class="col-sm-4">
                                <label for="guardianLastName">Last Name</label>
                                <input type="text" name="guardian_last_name" id="guardianLastName" maxlength="50"
                                    placeholder="Last Name" class="form-control" required
                                    value="<?php echo isset($row['guardian_last_name']) ? htmlspecialchars($row['guardian_last_name']) : ''; ?>">
                            </div>
                        </div>

                        <hr>
                        <div class="mt-3 row col-sm-2">
                            <label for="dateOfBirth" class="h6">Date Of Birth</label>
                            <input type="date" class="ms-4 mt-2" id="dateOfBirth" required name="date_of_birth"
                                onchange="findAge()"
                                value="<?php echo isset($row['date_of_birth']) ? htmlspecialchars($row['date_of_birth']) : ''; ?>">
                        </div>

                        <div class="mt-3 row col-sm-2">
                            <label for="ageStudent" class="h6">Age</label>
                            <input type="number" class="ms-4 mt-2" id="ageStudent" required readonly name="age" min="1"
                                max="100" id="age" placeholder="Age"
                                value="<?php echo isset($row['age']) ? htmlspecialchars($row['age']) : ''; ?>">
                        </div>


                        <div class="mt-3">
                            <label for="schoolName" class="h6">School Name</label>
                            <select class="form-select " name="school_name" id="schoolName">

                                <?php
                                require('includes/dbconnection.php');
                                $sql = "SELECT school_name FROM school";

                                $result = mysqli_query($conn, $sql);

                                if (mysqli_num_rows($result) > 0) {
                                    while ($row1 = mysqli_fetch_assoc($result)) {
                                        $selected = '';
                                        $selectedValue = $row['school_name'];

                                        $optionValue = htmlspecialchars($row1['school_name']);
                                        $selected = $optionValue === $selectedValue ? 'selected' : '';
                                        ?>
                                        <option <?php echo $selected; ?> value="<?php echo $optionValue; ?>">
                                            <?php echo $optionValue; ?>
                                        </option>
                                        <?php
                                    }

                                }
                                // Close connection
                                mysqli_close($conn);
                                ?>



                            </select>
                        </div>


                        <div class="mt-3 row">
                            <label for="expectedCompDate" class="h6">Expected Completion Date</label>
                            <input type="date" id="expectedCompDate" onmouseout="checkYear()" class="ms-4 mt-2 col-sm-2"
                                name="expected_completion_date"
                                value="<?php echo isset($row['expected_completion_date']) ? htmlspecialchars($row['expected_completion_date']) : ''; ?>">
                        </div>



                        <hr>

                        <fieldset class="mt-3">
                            <h6 class="h6">Student Status</h6>
                            <div class="form-check form-check-inline">

                                <input type="radio" class="form-check-input" name="student_status" id="ongoingRadio"
                                    value="ongoing" <?php echo (isset($row['student_status']) && $row['student_status'] === 'ongoing') ? 'checked' : ''; ?>>
                                <label for="ongoingRadio" class="form-check-label ">Ongoing</label>
                            </div>

                            <div class="form-check form-check-inline">

                                <input type="radio" class="form-check-input" name="student_status" id="dropoutRadio"
                                    value="dropout" <?php echo (isset($row['student_status']) && $row['student_status'] === 'dropout') ? 'checked' : ''; ?>>
                                <label for="dropoutRadio" class="form-check-label">Dropout</label>
                            </div>

                        </fieldset>
                        <div class="mt-3">
    <label for="dropoutReason" class="form-label h6">In case you dropped out, give a reason why?</label>
    <select id="dropoutReason" class="form-select mt-2" name="dropout_reason"
        <?php echo isset($row['student_status']) && 
        $row['student_status'] === 'dropout' ? '' : 'disabled'; ?>>
        <option value="" <?php echo empty($row['dropout_reason']) ? 'selected' : ''; ?> disabled>Select the reason</option>
        <?php
        $reason = array('Pregnancy', 'School Fees', 'Tough Curriculum', 'By Choice');

        foreach ($reason as $option) {
            $selected = isset($row['dropout_reason']) && $row['dropout_reason'] === $option ? 'selected' : '';
            ?>
            <option value="<?php echo htmlspecialchars($option); ?>" <?php echo $selected; ?>>
                <?php echo htmlspecialchars($option); ?>
            </option>
            <?php
        }
        ?>
    </select>
</div>



                        <h6 class="form-label mt-3">Other</h6>

                        <textarea class="form-control" id="otherDropoutReason" rows="3" name="other_dropout_reason"
                            cols="5" disabled
                            value="<?php echo isset($row['other_dropout_reason']) ? htmlspecialchars($row['other_dropout_reason']) : ''; ?>"></textarea>

                        <button type="submit" class="btn btn-primary mt-2" id="submit">Submit</button>

                </form>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
     $(function () {
            $("#ongoingRadio, #dropoutRadio").change(function () {
                $("#otherDropoutReason").val("").attr("disabled", true);
                $("#dropoutReason").val("").attr("disabled", true);
                if ($("#ongoingRadio").is(":checked")) {
                    $("#otherDropoutReason").focus();
                } else if ($("#dropoutRadio").is(":checked")) {
                    $("#dropoutReason").removeAttr("disabled");
                    $("#otherDropoutReason").removeAttr("disabled");
                    $("#dropoutReason").focus();
                }
            });
        });
</script>
</body>

</html>