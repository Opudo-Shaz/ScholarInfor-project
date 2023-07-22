<?php

session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (strlen($_SESSION['sessData'] == 0)) {
    header('location:logout.php');
} else {

    ?>

    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <meta name="description" content="Forum For African Women Educationalists" />
        <meta name="author" content="OSLABS" />
        <meta name="keywords" content="FAWE, Forum For African Women Educationalists, FAWE Kenya" />
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap"
            rel="stylesheet" />
        <!-- End fonts -->

        <!-- core:css -->
        <link rel="stylesheet" href="./assets/vendors/core/core.css" />
        <!-- endinject -->

        <!-- Plugin css for this page -->
        <link rel="stylesheet" href="./assets/vendors/flatpickr/flatpickr.min.css" />
        <!-- End plugin css for this page -->

        <!-- inject:css -->
        <link rel="stylesheet" href="./assets/fonts/feather-font/css/iconfont.css" />

        <!-- endinject -->

        <!-- Layout styles -->
        <link rel="stylesheet" href="./assets/css/style.css" />

        <link rel="stylesheet" href="./assets/css/custom.css" />
        <!-- End layout styles -->

        <link rel="shortcut icon" href="./assets/images/favicon.jpg" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    </head>

    <body>
        <div class="main-wrapper">
            <!-- partial:partials/_sidebar.html -->
            <nav class="sidebar">
                <div class="sidebar-header">
                    <a href="#" class="sidebar-brand" style="text-decoration: none">
                        <span>LIST</span>
                    </a>
                    <div class="sidebar-toggler not-active">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </div>
                <div class="sidebar-body">
                    <ul class="nav">
                        <li class="nav-item nav-category">Main</li>
                        <li class="nav-item">
                            <a href="dashboard.html" class="nav-link">
                                <i class="link-icon" data-feather="box"></i>
                                <span class="link-title">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item nav-category">Register Students</li>
                        <li class="nav-item">
                            <a class="nav-link" href="student.html" role="button">
                                <i class="link-icon" data-feather="plus"></i>
                                <span class="link-title">Add Students</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="student_list.html" role="button">
                                <i class="link-icon" data-feather="list"></i>
                                <span class="link-title">Students List</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="school.html" class="nav-link">
                                <i class="link-icon" data-feather="home"></i>
                                <span class="link-title">School</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="apps/calendar.html" class="nav-link">
                                <i class="link-icon" data-feather="calendar"></i>
                                <span class="link-title">Calendar</span>
                            </a>
                        </li>
                        <li class="nav-item nav-category">User Account Controls</li>
                        <li class="nav-item">
                            <a class="nav-link" href="users.html">
                                <i class="link-icon" data-feather="users"></i>
                                <span class="link-title">Users</span>
                            </a>
                        </li>
                        <li class="nav-item nav-category">Pages</li>
                        <li class="nav-item">
                            <a class="nav-link" href="profile.html" role="button" aria-expanded="false"
                                aria-controls="general-pages">
                                <i class="link-icon" data-feather="book"></i>
                                <span class="link-title">Profile</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
            <!-- partial -->

            <div class="page-wrapper">
                <!-- partial:partials/_navbar.html -->
                <nav class="navbar" style="position: fixed">
                    <a href="#" class="sidebar-toggler">
                        <i data-feather="menu"></i>
                    </a>
                    <div class="navbar-content">
                        <ul class="navbar-nav">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img class="wd-30 ht-30 rounded-circle" src="./assets/images/profile_avatar.png"
                                        alt="profile photo" />
                                </a>
                                <div class="dropdown-menu p-0" aria-labelledby="profileDropdown">
                                    <div class="d-flex flex-column align-items-center border-bottom px-5 py-3">
                                        <div class="mb-3">
                                            <img class="wd-80 ht-80 rounded-circle" src="./assets/images/profile_avatar.png"
                                                alt="profile photo" />
                                        </div>
                                        <div class="text-center">
                                            <p class="tx-16 fw-bolder">Amiah Burton</p>
                                            <p class="tx-12 text-muted">amiahburton@gmail.com</p>
                                        </div>
                                    </div>
                                    <ul class="list-unstyled p-1">
                                        <li class="dropdown-item py-2">
                                            <a href="profile.html" class="text-body ms-0">
                                                <i class="me-2 icon-md" data-feather="edit"></i>
                                                <span>Edit Profile</span>
                                            </a>
                                        </li>

                                        <li class="dropdown-item py-2">
                                            <a href="javascript:;" class="text-body ms-0">
                                                <i class="me-2 icon-md" data-feather="log-out"></i>
                                                <span>Log Out</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
                <!-- partial -->

                <div class="page-content p-3 bg-light">
                    <h3 class="text-danger">Student List</h3>
                    <div class="text-end mb-3">
                        <a class="btn btn-primary" href="javascript:void(0);" onclick="addData()">
                            <i class="link-icon" data-feather="plus"></i>
                            Add New Student
                        </a>
                    </div>
                    <table id="studentList" class="table table-bordered table-striped" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Gender</th>
                                <th>School</th>
                                <th>County</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Gender</th>
                                <th>School</th>
                                <th>County</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>

                    </table>
                </div>
                <div class="modal fade bd-example-modal-lg" id="userDataModal" tabindex="-1"
                    aria-labelledby="userAddEditModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="studentModalLabel">Add New Student</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <div class="modal-body">
                                <div class="frm-status"></div>
                                <div class="mb-3">
                                    <label for="firstName">First Name</label>
                                    <input type="text" name="first_name" id="firstName" maxlength="50"
                                        placeholder="First Name" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label for="middleName">Middle Name</label>
                                    <input type="text" name="middle_name" id="middleName" maxlength="50"
                                        class="form-control" placeholder="Middle Name">
                                </div>
                                <div class="mb-3">
                                    <label for="lastName">Last Name</label>
                                    <input type="text" name="middle_name" id="lastName" maxlength="50" class="form-control"
                                        placeholder="Middle Name" required>
                                </div>

                                <div class="form-radio">
                                    <label>Gender:</label>
                                    <input type="radio" name="gender" id="userGender_1" value="Male"> Male
                                    &nbsp;&nbsp;
                                    <input type="radio" name="gender" id="userGender_2" value="Female"> Female
                                </div>
                                <h6>Name of Parent/ Guardian</h6>
                                <div class="mb-3">
                                    <label for="guardianFirstName">First Name</label>
                                    <input type="text" name="guardian_first_name" id="guardianFirstName" maxlength="50"
                                        placeholder="First Name" class="form-control" required />
                                </div>

                                <div class="mb-3">
                                    <label for="guardianMiddleName">Middle Name</label>
                                    <input type="text" name="guardian_middle_name" id="guardianMiddleName" maxlength="50"
                                        placeholder="Middle Name" class="form-control" required />
                                </div>

                                <div class="mb-3">
                                    <label for="guardianLastName">Last Name</label>
                                    <input type="text" name="guardian_last_name" id="guardianLastName" maxlength="50"
                                        placeholder="Last Name" class="form-control" required />
                                </div>
                                <div class="mb-3">
                                    <label for="dateOfBirth" class="form-label">Date Of Birth</label>
                                    <input type="date" class="ms-3" id="dateOfBirth" required name="date_of_birth"
                                        onchange="findAge()" />
                                </div>


                                <div class="mb-3">
                                    <label for="ageStudent" class="form-label">Age</label>
                                    <input type="number" class="ms-3" id="ageStudent" required readonly name="age" min="1"
                                        max="100" id="age" placeholder="Age" />
                                </div>

                                <div class="mb-3">
                                    <label for="schoolName">School</label>
                                    <select class="form-select" name="school_name" id="schoolName">
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
                                        ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="expectedCompDate">Expected Completion
                                        Date</label>

                                    <input type="date" id="expectedCompDate" class="ms-3" name="expected_completion_date" />

                                </div>



                                <div class="form-radio">
                                    <label for="studentStatus">Student Status</label><br>
                                    <input type="radio" name="student_status" id="studentStatus_1" value="ongoing">Ongoing
                                    &nbsp;&nbsp;
                                    <input type="radio" name="student_status" id="studentStatus_2" value="Female">Dropout
                                </div>

                                <div class="mb-3">
                                    <label for="dropout_reason" class="form-label">In case you dropped out, Give a reason
                                        why?
                                    </label>
                                    <select class="form-select" name="dropout_reason">
                                        <option selected disabled>Select the reason</option>
                                        <option>Pregnancy</option>
                                        <option>School Fees</option>
                                        <option>Tough Curriculum</option>
                                        <option>By Choice</option>

                                    </select>
                                </div>

                                <h6 class="form-label">Other</h6>

                                <textarea class="form-control" id="dropoutTextArea" rows="3" name="other_dropout_reason"
                                    cols="5" disabled></textarea>

                                <div class="modal-footer">
                                    <input type="hidden" id="userID" value="0">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary" onclick="submitUserData()">Submit</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>


        <!-- core:js -->
        <script src="./assets/vendors/core/core.js"></script>
        <!-- endinject -->

        <!-- inject:js -->
        <script src="./assets/vendors/feather-icons/feather.min.js"></script>
        <script src="./assets/js/template.js"></script>
        <!-- endinject -->

        <!-- Custom js for this page -->
        <script src="./assets/js/dashboard-dark.js"></script>
        <!-- End custom js for this page -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

        <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.js"></script>
        <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

        <script>
            var table = $('#studentList').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "fetchData.php",
                "columnDefs": [
                    { "orderable": false, "targets": 7 }
                ]
            });

            $(document).ready(function () {
                // Draw the table
                table.draw();
            });

            function addData() {
                $('.frm-status').html('');
                $('#studentModalLabel').html('Add New Student');
                $('#userGender_1').prop('checked', true);
                $('#userGender_2').prop('checked', false);
                $('#userStatus_1').prop('checked', true);
                $('#userStatus_2').prop('checked', false);
                $('#firstName').val('');
                $('#userLastName').val('');
                $('#userEmail').val('');
                $('#userCountry').val('');
                $('#userID').val(0);
                $('#userDataModal').modal('show');
            }

            function editData(user_data) {
                $('.frm-status').html('');
                $('#userModalLabel').html('Edit User #' + user_data.id);

                if (user_data.gender == 'Female') {
                    $('#userGender_1').prop('checked', false);
                    $('#userGender_2').prop('checked', true);
                } else {
                    $('#userGender_2').prop('checked', false);
                    $('#userGender_1').prop('checked', true);
                }

                if (user_data.status == 1) {
                    $('#userStatus_2').prop('checked', false);
                    $('#userStatus_1').prop('checked', true);
                } else {
                    $('#userStatus_1').prop('checked', false);
                    $('#userStatus_2').prop('checked', true);
                }

                $('#firstName').val(user_data.first_name);
                $('#userLastName').val(user_data.last_name);
                $('#userEmail').val(user_data.email);
                $('#userCountry').val(user_data.country);
                $('#userID').val(user_data.id);
                $('#userDataModal').modal('show');
            }

            function submitUserData() {
                $('.frm-status').html('');
                let input_data_arr = [
                    document.getElementById('firstName').value,
                    document.getElementById('userLastName').value,
                    document.getElementById('userEmail').value,
                    document.querySelector('input[name="userGender"]:checked').value,
                    document.getElementById('userCountry').value,
                    document.querySelector('input[name="userStatus"]:checked').value,
                    document.getElementById('userID').value,
                ];

                fetch("eventHandler.php", {
                    method: "POST",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify({ request_type: 'addEditUser', user_data: input_data_arr }),
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status == 1) {
                            Swal.fire({
                                title: data.msg,
                                icon: 'success',
                            }).then((result) => {
                                // Redraw the table
                                table.draw();

                                $('#userDataModal').modal('hide');
                                $("#userDataFrm")[0].reset();
                            });
                        } else {
                            $('.frm-status').html('<div class="alert alert-danger" role="alert">' + data.error + '</div>');
                        }
                    })
                    .catch(console.error);
            }

            function deleteData(user_id) {
                Swal.fire({
                    title: 'Are you sure to Delete?',
                    text: 'You won\'t be able to revert this!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Delete event
                        fetch("eventHandler.php", {
                            method: "POST",
                            headers: { "Content-Type": "application/json" },
                            body: JSON.stringify({ request_type: 'deleteUser', user_id: user_id }),
                        })
                            .then(response => response.json())
                            .then(data => {
                                if (data.status == 1) {
                                    Swal.fire({
                                        title: data.msg,
                                        icon: 'success',
                                    }).then((result) => {
                                        table.draw();
                                    });
                                } else {
                                    Swal.fire(data.error, '', 'error');
                                }
                            })
                            .catch(console.error);
                    } else {
                        Swal.close();
                    }
                });
            }

            function findAge() {
                var day = document.getElementById("dateOfBirth").value;
                var DOB = new Date(day);
                var today = new Date();
                var Age = today.getTime() - DOB.getTime();
                Age = Math.floor(Age / (1000 * 60 * 60 * 24 * 365.25));
                document.getElementById("ageStudent").value = Age;
            }

        </script>
    </body>

    </html>

<?php } ?>