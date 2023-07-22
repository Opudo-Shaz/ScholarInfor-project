<?php @include('includes/dbconnection.php'); ?>

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

                    <form>

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
                                    <input type="text" name="middle_name" id="lastName" maxlength="50"
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
                                            <?php echo $option['school_name']; ?>
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

                                <input type="date" id="expectedCompDate" class="ms-4 mt-2 col-sm-2"
                                    name="expected_completion_date" />

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
                                <select id="dropoutReason" class="form-select mt-2" name="dropout_reason">
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

                <th>Fullname</th>
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
                            $school_name = mysqli_real_escape_string($conn, $school_name);

                            // Prepare the SQL statement with a parameter placeholder
                            $sql_county = "SELECT county FROM school WHERE school_name = ?";
                            while (mysqli_next_result($conn)) {
                                ;
                            }
                            // Prepare the statement
                            $stmt = mysqli_prepare($conn, $sql_county);

                            // Bind the parameter and execute the statement
                            mysqli_stmt_bind_param($stmt, "s", $school_name);
                            mysqli_stmt_execute($stmt);

                            // Bind the result
                            mysqli_stmt_bind_result($stmt, $county);

                            // Fetch data from the result
                            mysqli_stmt_fetch($stmt);
                            ?>

                            <?php echo $county;
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


                var firstName = $('#firstName').val();
                var middleName = $('#middleName').val();
                var lastName = $('#lastName').val();
                var gender = $("input[name='gender']:checked").val();
                var guardianFirstName = $('#guardianFirstName').val();
                var guardianMiddleName = $('#guardianMiddleName').val();
                var guardianLastName = $('#guardianLastName').val();
                var ageStudent = $('#ageStudent').val();
                var dateOfBirth = $('#dateOfBirth').val();
                var expectedCompDate = $('#expectedCompDate').val();
                var schoolName = $('#schoolName').val();
                var studentStatus = $("input[name='student_status']:checked").val();
                var dropoutReason = $('#dropoutReason').val();
                var otherDropoutReason = $('#otherDropoutReason').val();

                $.ajax({

                    url: "insertdata.php",

                    type: "POST",

                    data: {
                        firstName: firstName, middleName: middleName, lastName: lastName, gender: gender,
                        guardianFirstName: guardianFirstName, guardianMiddleName: guardianMiddleName, guardianLastName: guardianLastName,
                        ageStudent: ageStudent, dateOfBirth: dateOfBirth, expectedCompDate: expectedCompDate, schoolName: schoolName,
                        studentStatus: studentStatus, dropoutReason: dropoutReason, otherDropoutReason: otherDropoutReason
                    },

                    success: function (data) {

                        alert("Data Inserted Successfully");

                        $("#form-body").hide();

                        location.reload(true);

                    }

                });


            });


        });

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

    </script>


</body>

</html>