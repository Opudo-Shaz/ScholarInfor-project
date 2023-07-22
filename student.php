<?php
@include("includes/head.php");
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['sessData'] == 0)) {
  header('location:logout.php');
} else {

  ?>

  <body>
    <div class="main-wrapper">
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar">
        <div class="sidebar-header">
          <a href="#" class="sidebar-brand" style="text-decoration: none">
            <span class="p-3">STUDENT</span>
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
              <a class="nav-link" href="profile.html" role="button" aria-expanded="false" aria-controls="general-pages">
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
                <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown"
                  aria-haspopup="true" aria-expanded="false">
                  <img class="wd-30 ht-30 rounded-circle" src="./assets/images/profile_avatar.png" alt="profile photo" />
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
        <!-- partial -->>
        <div class="page-content">
          <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
            <h3 class="p-3">STUDENT DETAILS</h3>
            <form role="form" method="post" action="student_process.php">
              <div class="row align-items-center g-3">
                <h6>Full Name</h6>
                <div class="col-auto">
                  <label for="first_name">First Name</label>
                  <input type="text" name="first_name" maxlength="50" placeholder="First Name" class="form-control"
                    required>
                </div>
                <div class="col-auto">
                  <label for="middle_name">Middle Name</label><label for="middle_name">Middle Name</label>
                  <input type="text" name="middle_name" maxlength="50" class="form-control" placeholder="Middle Name">
                </div>
                <div class="col-auto">
                  <label for="last_name">Last Name</label>
                  <input type="text" name="last_name" maxlength="50" placeholder="Last Name" class="form-control"
                    required />
                </div>
                <fieldset>
                  <h6 class="form-label">Gender</h6>
                  <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="gender" value="male" />
                    Male
                  </label>
                  <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="gender" value="Female" />
                    Female
                  </label>

                </fieldset>






                <div class="row align-items-center g-3 mb-3">
                  <h6>Name of Parent/ Guardian</h6>
                  <div class="col-auto">
                    <label for="guardian_first_name">First Name</label>
                    <input type="text" name="guardian_first_name" maxlength="50" placeholder="First Name"
                      class="form-control" required />
                  </div>
                  <div class="col-auto">
                    <label for="middleNameParent">Middle Name</label>
                    <input type="text" name="guardian_middle_name" maxlength="50" class="form-control"
                      placeholder="Middle Name" />
                  </div>
                  <div class="col-auto">
                    <label for="lastNameParent">Last Name</label>
                    <input type="text" name="guardian_last_name" maxlength="50" placeholder="Last Name"
                      class="form-control" required />
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="date" class="col-sm-3 col-form-label">Date Of Birth</label>
                  <div class="col-md-4">
                    <input type="date" id="date_of_birth" required name="date_of_birth" onchange="findAge()" />
                  </div>
                </div>

                <div class="mb-3 col-sm-5">
                  <label for="age" class="form-label">Age</label>
                  <input type="number" required readonly class="form-control" name="age" min="0" max="100" id="age"
                    placeholder="Enter Date Of Birth First" />
                </div>

              </div>
              <div class="mb-3 col-sm-5">
                <label for="ageSelect" class="form-label">School</label>

                <select class="form-select" name="school_name" id="ageSelect">
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
              <div class="row mb-3">
                <label for="expectedComp" class="col-sm-3 col-form-label">Expected Completion Date</label>
                <div class="col-md-4">
                  <input type="date" name="expected_completion_date" />
                </div>
              </div>
              <div class="row mb-3">
                <label class="form-label">Student Status</label>
                <div class="mb-3 ps-4">
                  <div class="form-check form-check-inline">
                    <input type="radio" class="form-check-input" name="student_status" value="ongoing"
                      id="ongoingRadio" />
                    <label class="form-check-label" for=""> Ongoing </label>
                    <div class="form-check form-check-inline">
                      <input type="radio" class="form-check-input" name="student_status" value="dropout" id="dropRadio" />
                      <label class="form-check-label" for="gender2">
                        Dropped out
                      </label>
                    </div>
                  </div>
                </div>
              </div>

          </div>
          <div class="mb-3 col-sm-5">
            <label for="dropout_reason" class="form-label">In case you dropped out, Give a reason why? </label>
            <select class="form-select" name="dropout_reason">
              <option selected disabled>Select the reason</option>
              <option>Pregnancy</option>
              <option>School Fees</option>
              <option>Tough Curriculum</option>
              <option>By Choice</option>

            </select>
          </div>

          <h6 class="form-label">Other</h6>

          <textarea class="form-control" id="dropoutTextArea" rows="3" name="other_dropout_reason" cols="5"
            disabled></textarea>
        </div>
        <div class="row_bottom ms-5">
          <div>
            <input type="submit" class="btn btn-primary justify-content-start text-uppercase" value="submit"
              name="submit" />
          </div>
          <div>
            <input type="reset" class="btn btn-danger justify-content-end text-uppercase" name="reset" />
          </div>
        </div>
        </form>
      </div>
    </div>
    </div>
    </div>

    <script>
      function findAge() {
        var day = document.getElementById("date_of_birth").value;
        var DOB = new Date(day);
        var today = new Date();
        var Age = today.getTime() - DOB.getTime();
        Age = Math.floor(Age / (1000 * 60 * 60 * 24 * 365.25));
        document.getElementById("age").value = Age;
      } 
    </script>

    <?php @include("includes/footer.php") ?>
    <?php
} ?>