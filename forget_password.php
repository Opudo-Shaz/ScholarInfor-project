<?php
session_start();

?>
<!DOCTYPE html>
<html>

<head>
    <title>Forgot Password</title>
    <style>
        /* Add some basic CSS styles to the form */
    </style>
    <?php include "includes/head.php" ?>
</head>

<body>
    <div class="container d-flex flex-column">

        <div class="row align-items-center justify-content-center min-vh-100">
            <div class="col-12 col-md-8 col-lg-4">
                <div class="card shadow-sm">
                    <div class="card-body">

                        <div class="mb-4">
                            <h5>Forgot Password?</h5>
                            <p class="mb-2">
                                Enter your registered email to reset the password
                            </p>
                        </div>
                        <form method="POST" action="forgot_password.php">
                            <?php


                            if (!empty($_SESSION["forgotPassSuccess"])) {

                                // Echo the success message
                                echo '<div class = "alert alert-success alert-dismissible fade show" role="alert">
<i data-feather="alert-circle"></i>';
                                echo $_SESSION["forgotPassSuccess"];
                                echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"></button>
</div>';
                                if (isset($_SESSION['forgotPassSuccess'])) {
                                    unset($_SESSION['forgotPassSuccess']);
                                }
                            } else if (!empty($_SESSION['forgotPassError'])) {

                                // Echo the error message
                                echo '<div class = "alert alert-danger alert-dismissible fade show" role="alert">
<i data-feather="alert-circle"></i>';
                                echo $_SESSION["forgotPassError"];
                                echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"></button>

</div>';
                                if (isset($_SESSION['forgotPassError'])) {
                                    unset($_SESSION['forgotPassError']);
                                }
                            }


                            ?>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" id="email" class="form-control" name="email"
                                    placeholder="Enter Your Email" required="" />
                            </div>
                            <div class="mb-3 d-grid">
                                <button type="submit" name="submit" class="btn btn-primary">
                                    Reset Password
                                </button>
                            </div>
                            <span>Don't have an account?
                                <a href="registration.php">Sign Up</a></span>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- core:js -->
    <script src="assets/vendors/core/core.js"></script>
    <!-- endinject -->

    <!-- Plugin js for this page -->
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <!-- End plugin js for this page -->

    <!-- inject:js -->
    <script src="assets/vendors/feather-icons/feather.min.js"></script>
    <script src="assets/js/template.js"></script>
    <!-- endinject -->


</body>

</html>