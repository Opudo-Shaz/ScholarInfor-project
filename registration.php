<?php
// Start session 
session_start();
@include("includes/head.php");

// Get data from session 
$sessData = !empty($_SESSION['sessData']) ? $_SESSION['sessData'] : '';

// Get status from session 
if (!empty($sessData['status']['msg'])) {
  $statusMsg = $sessData['status']['msg'];
  $status = $sessData['status']['type'];
  unset($_SESSION['sessData']['status']);
}

$postData = array();
if (!empty($sessData['postData'])) {
  $postData = $sessData['postData'];
  unset($_SESSION['postData']);
}


?>

<body>


  <div class="main-wrapper">
    <div class="page-wrapper full-page">
      <div class="page-content d-flex align-items-center justify-content-center">
        <div class="row w-100 mx-0 auth-page">
          <div class="col-md-8 col-xl-6 mx-auto">
            <div class="card">
              <div class="row">
                <div class="col-md-4 pe-md-0">
                  <div class="auth-side-wrapper" style="background-image: url(assets/images/login-bg.jpg) !important;">
                  </div>
                </div>
                <div class="col-md-8 ps-md-0">
                  <div class="auth-form-wrapper px-4 py-5">
                    <a href="#" class="noble-ui-logo logo-light d-block mb-2">ScholarInfo<span class="p-4">Register</span></a>
                    <h5 class="text-muted fw-normal mb-4">
                      Create a new account.
                    </h5>
                    <!-- Status message -->
                    <?php if (!empty($statusMsg)) { ?>
                      <div style="color: red" class="status-msg alert alert-danger">
                        <p style=" text-transform: uppercase;">
                          <?php echo $status; ?>
                        </p>
                        <?php echo $statusMsg; ?>
                      </div>
                    <?php } ?>

                    <head>
                      <style>
                        .password-container {
                          position: relative;
                        }

                        .password-icon {
                          position: absolute;
                          top: 64%;
                          right: 40px;
                          transform: translateY(-50%);
                          cursor: pointer;
                        }
                      </style>
                    </head>

                    <form action="userAccount.php" method="post" id="regForm" class="forms-sample">
                      <div class="mb-3 form-field">
                        <label for="first_name" class="form-label">First Name </label>
                        <input type="text" class="form-control" name="first_name" placeholder="First Name"
                          value="<?php echo !empty($postData['first_name']) ? $postData['first_name'] : ''; ?>" />
                        <small class="text-danger"></small>
                      </div>
                      <div class="mb-3 form-field">
                        <label for="lastname" class="form-label">Last Name </label>
                        <input type="text" class="form-control" name="last_name" placeholder="Last Name"
                          value="<?php echo !empty($postData['last_name']) ? $postData['last_name'] : ''; ?>" />
                        <small class="text-danger"></small>
                      </div>
                      <div class="mb-3 form-field">
                        <label for="userEmail" class="form-label">Email address </label>
                        <input type="email" class="form-control" name="email" id="email" autocomplete="off"
                          placeholder="Email"
                          value="<?php echo !empty($postData['email']) ? $postData['email'] : ''; ?>" />
                        <small class="text-danger"></small>
                      </div>
                      <div class="mb-3 form-field password-container">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password"
                          autocomplete="current-password" placeholder="Password" required>
                        <!-- Use the Font Awesome icon for show/hide password -->
                        <i class="password-icon" id="password-icon"><i class="fas fa-eye"></i></i>
                        <small class="text-danger"></small>
                      </div>
                      <div class="mb-3 form-field password-container">
                        <label for="confirm_password">Confirm Password</label>
                        <input type="password" class="form-control" name="confirm_password" id="confirm-password"
                          autocomplete="current-password" placeholder="Confirm Password">
                        <!-- Use the Font Awesome icon for show/hide password -->
                        <i class="password-icon" id="confirm-password-icon"><i class="fas fa-eye"></i></i>
                        <small class="text-danger"></small>
                      </div>

                      <div class="form-field">
                        <input type="submit" value="Register" id="submitbtn" name="signupSubmit"
                          class="btn btn-outline-primary btn-icon-text mb-2 mb-md-0 text-uppercase" />
                      </div>
                      <a href="index.php" class="d-block mt-3">
                        Already Registered?
                        <span class="text-muted text-danger p-3">Login</span></a>
                    </form>
                  </div>
                </div>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
                <script>
                  document.addEventListener('DOMContentLoaded', function () {
                    const passwordInput = document.getElementById('password');
                    const passwordConInput = document.getElementById('confirm-password');
                    const passwordIcon = document.getElementById('password-icon');
                    const confirmPasswordIcon = document.getElementById('confirm-password-icon');

                    passwordIcon.addEventListener('click', function () {
                      if (passwordInput.type === 'password') {
                        passwordInput.type = 'text';
                        passwordIcon.innerHTML = '<i class="fas fa-eye-slash"></i>';
                      } else {
                        passwordInput.type = 'password';
                        passwordIcon.innerHTML = '<i class="fas fa-eye"></i>';
                      }
                    });

                    confirmPasswordIcon.addEventListener('click', function () {
                      if (passwordConInput.type === 'password') {
                        passwordConInput.type = 'text';
                        confirmPasswordIcon.innerHTML = '<i class="fas fa-eye-slash"></i>';
                      } else {
                        passwordConInput.type = 'password';
                        confirmPasswordIcon.innerHTML = '<i class="fas fa-eye"></i>';
                      }
                    });
                  });
                </script>
                <script src="assets/js/appRegister.js"></script>

                <?php @include("footer.php") ?>
</body>