<?php require_once('includes/dbconnection.php');
session_start(); ?>

<!DOCTYPE html>

<html>

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title></title>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.css" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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

    <div class="container-fluid" style="margin-top:30px !important;">

        <div class="container">

            <div class="row mb-2">

                <div class="col-md-9">

                    <h1>Nicesnippets Datataable</h1>

                </div>

                <div class="col-md-3">

                    <button type="button" id="insert-btn" class="btn btn-primary" style="float: right;">

                        <i class="fa fa-plus" aria-hidden="true"></i>

                    </button>

                </div>

            </div>

            <div class="card mb-3" id="form-body">

                <div class="card-header">

                    Insert Data

                </div>

                <div class="card-body">

                    <form method="POST">

                        <div class="form-group">
                            <div class="row align-items-center justify-content-between ">
                                <h6>Student Details</h6>
                                <div class="col-sm-4">
                                    <label for="firstName">First Name</label>
                                    <input type="text" name="first_name" id="firstName" maxlength="50"
                                        placeholder="First Name" class="form-control" required>
                                </div>

                                <div class="col-sm-4">
                                    <label for="middleName">Middle Name</label>
                                    <input type="text" name="middle_name" id="middleName" maxlength="50"
                                        class="form-control" placeholder="Middle Name">

                                </div>
                                <div class="col-sm-4">
                                    <label for="lastName">Last Name</label>
                                    <input type="text" name="last_name" id="lastName" maxlength="50"
                                        class="form-control" placeholder="Middle Name" required>
                                </div>
                            </div>
                            <fieldset class="mt-2">
                                <h6 class="h6">Gender</h6>
                                <div class="form-check form-check-inline">

                                    <input type="radio" class="form-check-input" id="maleRadio" name="gender"
                                        value="male" />

                                    <label for="maleRadio" class="form-check-label"> Male
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">

                                    <input type="radio" class="form-check-input" id="femaleRadio" name="gender"
                                        value="Female" />
                                    <label for="femaleRadio" class="form-check-label"> Female
                                    </label>
                                </div>
                            </fieldset>
                            <hr>
                            <div class="row mt-2 align-items-center justify-content-between">
                                <h6>Name of Parent/ Guardian</h6>
                                <div class="col-sm-4">
                                    <label for="guardianFirstName">First Name</label>
                                    <input type="text" name="guardian_first_name" id="guardianFirstName" maxlength="50"
                                        placeholder="First Name" class="form-control" required />
                                </div>

                                <div class="col-sm-4">
                                    <label for="guardianMiddleName">Middle Name</label>
                                    <input type="text" name="guardian_middle_name" id="guardianMiddleName"
                                        maxlength="50" placeholder="Middle Name" class="form-control" required />
                                </div>

                                <div class="col-sm-4">
                                    <label for="guardianLastName">Last Name</label>
                                    <input type="text" name="guardian_last_name" id="guardianLastName" maxlength="50"
                                        placeholder="Last Name" class="form-control" required />
                                </div>
                            </div>
                            <hr>
                            <div class="mt-3 row col-sm-2">
                                <label for="dateOfBirth" class="h6">Date Of Birth</label>
                                <input type="date" class="ms-4  mt-2" id="dateOfBirth" required name="date_of_birth"
                                    onchange="findAge()" />
                            </div>


                            <div class="mt-3 row col-sm-2">
                                <label for="ageStudent" class="h6">Age</label>
                                <input type="number" class="ms-4 mt-2" id="ageStudent" required readonly name="age"
                                    min="1" max="100" id="age" placeholder="Age" />
                            </div>

                            <div class="mt-3">
                                <label for="schoolName" class="h6">School Name</label>
                                <select class="form-select " name="school_name" id="schoolName">
                                    <option selected disabled>Select your school</option>
                                    <?php
                                    $sql = "SELECT school_name FROM school";

                                    $result = mysqli_query($conn, $sql);

                                    if (mysqli_num_rows($result) > 0) {
                                        $options = mysqli_fetch_all($result, MYSQLI_ASSOC);
                                    } else {
                                        echo "No data found.";
                                    }


                                    foreach ($options as $option) {
                                        ?>
                                        <option>
                                            <?php echo $option['school_name'];
                                            ?>
                                        </option>
                                        <?php
                                    }


                                    // Close connection
                                    mysqli_close($conn);
                                    ?>
                                </select>
                            </div>
                            <div class="mt-3 row">
                                <label for="expectedCompDate" class="h6">Expected Completion
                                    Date</label>

                                <input type="date" id="expectedCompDate" onmouseout="checkYear()"
                                    class="ms-4 mt-2 col-sm-2" name="expected_completion_date" />

                            </div>

                            <hr>

                            <fieldset class="mt-3">
                                <h6 class="h6">Student Status</h6>
                                <div class="form-check form-check-inline">

                                    <input type="radio" class="form-check-input" name="student_status" id="ongoingRadio"
                                        value="ongoing">
                                    <label for="ongoingRadio" class="form-check-label ">Ongoing</label>
                                </div>

                                <div class="form-check form-check-inline">

                                    <input type="radio" class="form-check-input" name="student_status" id="dropoutRadio"
                                        value="dropout">
                                    <label for="dropoutRadio" class="form-check-label">Dropout</label>
                                </div>

                            </fieldset>
                            <div class="mt-3">
                                <label for="dropoutReason" class="form-label h6">In case you dropped out, Give a reason
                                    why?
                                </label>
                                <select id="dropoutReason" class="form-select mt-2" name="dropout_reason" disabled>
                                    <option selected disabled>Select the reason</option>
                                    <option>Pregnancy</option>
                                    <option>School Fees</option>
                                    <option>Tough Curriculum</option>
                                    <option>By Choice</option>

                                </select>
                            </div>

                            <h6 class="form-label mt-3">Other</h6>

                            <textarea class="form-control" id="otherDropoutReason" rows="3" name="other_dropout_reason"
                                cols="5" disabled></textarea>

                            <button type="submit" class="btn btn-primary mt-2" id="submit">Submit</button>

                    </form>

                </div>

            </div>
        </div>



        <?php

        require('includes/dbconnection.php');
        $key = 0;

        $sql = "SELECT * FROM student";

        $result = mysqli_query($conn, $sql);

        ?>


        <table id="tblStudent">

            <thead>

                <th>ID</th>

                <th>Name</th>
                <th>Gender</th>

                <th>School</th>
                <th>County</th>

                <th>Action</th>

            </thead>

            <tbody>

                <?php while ($user = mysqli_fetch_assoc($result)) { ?>

                    <tr>

                        <td>
                            <?php

                            echo ++$key; ?>
                        </td>

                        <td>
                            <?php echo $user['first_name'] . " " . $user['last_name']; ?>
                        </td>

                        <td>
                            <?php echo $user['gender']; ?>
                        </td>


                        <td>
                            <?php echo $user['school_name']; ?>
                        </td>
                        <td>
                            <?php
                            $school_name = isset($user['school_name']) ? $user['school_name'] : '';

                            // Prepare the SQL statement with a parameter placeholder
                            $sql_county = "SELECT county FROM school WHERE school_name = ?";

                            $stmt = mysqli_prepare($conn, $sql_county);

                            if ($stmt) {
                                // Bind the parameter and execute the statement
                                mysqli_stmt_bind_param($stmt, "s", $school_name);
                                mysqli_stmt_execute($stmt);

                                // Bind the result
                                mysqli_stmt_bind_result($stmt, $county);

                                if (mysqli_stmt_fetch($stmt)) {
                                    // Output the fetched county
                                    echo htmlspecialchars($county);
                                } else {
                                    // County not found or no result returned
                                    echo 'County not found.';
                                }

                                // Close the statement after fetching the data
                                mysqli_stmt_close($stmt);
                            } else {
                                // Error preparing the statement
                                echo 'Error preparing statement: ' . mysqli_error($conn);
                            }
                            ?>


                        </td>
                        <td>

                            <a href="update_data_form.php?id=<?php echo $user['id']; ?>" class="btn btn-primary btn-sm"><i
                                    class="fa fa-pencil-square-o"></i></a>

                            <a href="delete_data.php?id=<?php echo $user['id']; ?>" class="btn btn-danger btn-sm"><i
                                    class="fa fa-trash"></i></a>

                        </td>

                    </tr>

                <?php } ?>

            </tbody>

        </table>

    </div>

    </div>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.js"></script>

    <script>

        jQuery(document).ready(function ($) {

            $('#tblStudent').DataTable();

            $("#form-body").hide();


            $("#insert-btn").on('click', function () {

                $("#form-body").toggle(500);

            });


            $("#submit").on('click', function (e) {

                e.preventDefault();


                var firstName = $("input[name='first_name']").val();
                var middleName = $("input[name='middle_name']").val();
                var lastName = $("input[name='last_name']").val();
                var gender = $("input[name='gender']:checked").val();
                var guardianFirstName = $("input[name='guardian_first_name']").val();
                var guardianMiddleName = $("input[name='guardian_middle_name']").val();
                var guardianLastName = $("input[name='guardian_last_name']").val();
                var ageStudent = $("input[name='age']").val();
                var dateOfBirth = $("input[name='date_of_birth']").val();
                var expectedCompDate = $("input[name='expected_completion_date']").val();
                var schoolName = $("#schoolName").val();
                var studentStatus = $("input[name='student_status']:checked").val();
                var dropoutReason = $("#dropoutReason").val();
                var otherDropoutReason = $("input[name='other_dropout_reason']").val();


                $.ajax({

                    url: "insert_data.php",

                    type: "POST",

                    data: {
                        first_name: firstName,
                        middle_name: middleName,
                        last_name: lastName,
                        gender: gender,
                        guardian_first_name: guardianFirstName,
                        guardian_middle_name: guardianMiddleName,
                        guardian_last_name: guardianLastName,
                        age: ageStudent,
                        date_of_birth: dateOfBirth,
                        expected_completion_date: expectedCompDate,
                        school_name: schoolName,
                        student_status: studentStatus,
                        dropout_reason: dropoutReason,
                        other_dropout_reason: otherDropoutReason
                    },

                    success: function (data) {

                        alert("Data Inserted Successfully");

                        $("#form-body").hide();

                        location.reload();

                    },
                    error: function (xhr, status, error) {
                        // Handle any errors that occurred during the AJAX request
                        alert('Error: ' + error);
                    }

                });


            });


        });

        $(function () {
            $("#ongoingRadio, #dropoutRadio").change(function () {
                $("#otherDropoutReason").val("").attr("disabled", true);
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