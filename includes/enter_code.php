
<?php 
// Start session 
session_start(); 
@include("head.php"); 

 
// Get data from session 
$sessData = !empty($_SESSION['sessData'])?$_SESSION['sessData']:'';

$statusMsg = "";
$status = "";

// Get status from session 
if(!empty($sessData['status']['msg'])){ 
    $statusMsg = $sessData['status']['msg']; 
    $status = $sessData['status']['type']; 
    unset($_SESSION['sessData']['status']); 
} 
 
$postData = array(); 
if(!empty($sessData['postData'])){ 
    $postData = $sessData['postData']; 
    unset($_SESSION['postData']); 
} 
 
// If the user already logged in 
if(!empty($sessData['userLoggedIn']) && !empty($sessData['userID'])){ 
    include_once 'User.class.php'; 
    $user = new User(); 
    $conditions['where'] = array( 
        'id' => $sessData['userID'] 
    ); 
    $conditions['return_type'] = 'single'; 
    $userData = $user->getRows($conditions); 
    if(!empty($_POST["remember"])) {
      //COOKIES for username
      setcookie ("user_login",$_POST["username"],time()+ (10 * 365 * 24 * 60 * 60));
      //COOKIES for password
      setcookie ("userpassword",$_POST["password"],time()+ (10 * 365 * 24 * 60 * 60));
    } else {
      if(isset($_COOKIE["user_login"])) {
        setcookie ("user_login","");
        if(isset($_COOKIE["userpassword"])) {
          setcookie ("userpassword","");
        }
      }
    }
    if(!empty($_POST["remember"])) {
      //COOKIES for username
      setcookie ("user_login",$_POST["username"],time()+ (10 * 365 * 24 * 60 * 60));
      //COOKIES for password
      setcookie ("userpassword",$_POST["password"],time()+ (10 * 365 * 24 * 60 * 60));
      } else {
      if(isset($_COOKIE["user_login"])) {
      setcookie ("user_login","");
      if(isset($_COOKIE["userpassword"])) {
      setcookie ("userpassword","");
              }
}
 } }
?>
<body>
<?php if(!empty($userData)){
   $_SESSION['userData'] = $userData;
  header("Location: welcome.php", true, 301);  
  exit();  
  ?>
<?php }else{ ?>
  <head> <style>
    .password-container {
      position: relative;
    }

    .password-icon {
      position: absolute;
      top: 70%;
      right: 10px;
      transform: translateY(-50%);
      cursor: pointer;
    }
  </style></head>
    <div class="main-wrapper">
      <div class="page-wrapper full-page">
        <div
          class="page-content d-flex align-items-center justify-content-center"
        >
          <div class="row w-100 mx-0 auth-page">
            <div class="col-md-8 col-xl-6 mx-auto">
              <div class="card">
                <div class="row">
                  <div class="col-md-4 pe-md-0">
                    <div class="auth-side-wrapper" style="background-image: url(../assets/images/login-bg.jpg)"></div>
                  </div>
                  <div class="col-md-8 ps-md-0">
                    <div class="auth-form-wrapper px-4 py-5">
                      <a href="#" class="noble-ui-logo logo-light d-block mb-2"
                        >ScholarInfo<span class="p-4"></span></a
                      >
                      <h5 class="text-muted fw-normal mb-4">
                        We sent an OTP to your Email Address. Please check and confirm below!
                      </h5>

    <!-- Status message -->
    <?php if(!empty($statusMsg) && $status =="success"){ ?>
        <div style="color: green" class="alert alert-success status-msg"> <p style=" text-transform: uppercase;"><?php echo $status; ?> </p> <?php echo $statusMsg; ?></div>
    <?php } else if(!empty($statusMsg) && $status =="error")  { ?>
      <div style="color: red" class="alert alert-danger status-msg"> <p style=" text-transform: uppercase;"><?php echo $status; ?> </p><?php echo $statusMsg; ?></div>
    <?php }
     ?>
   
        <form action="2faAuth.php" class="forms-sample" id="otpForm" method="post">
        <div class="mb-3 form-field">
            <input name="userID" type="text" value="<?= $_GET['userID'] ?>" hidden/>
                          <label for="otp" class="form-label"
                            >Enter OTP</label
                          >
                          <input
                            type="text"
                            class="form-control"
                            name="otp"
                            value=""
                            id="otp"
                            placeholder="OTP"
                            required
                          />
                          <small class="text-danger"></small>
                        </div>
                        

                        <div class="form-field">
                          <input
                            type="submit"
                            value="Verify OTP"
                            name="OTPSubmit"
                            class="btn btn-outline-primary btn-icon-text mb-2 mb-md-0 text-uppercase"
                          >
                        </div>

                        
                    
        </form>
    </div>     
    </div>
    <script src="assets/js/appLogin.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const passwordInput = document.getElementById('password');
    const passwordIcon = document.getElementById('password-icon');

    passwordIcon.addEventListener('click', function () {
      if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        passwordIcon.innerHTML = '<i class="fas fa-eye-slash"></i>';
      } else {
        passwordInput.type = 'password';
        passwordIcon.innerHTML = '<i class="fas fa-eye"></i>';
      }
    });
  });
</script>

    </body>
<?php } ?>
<?php @include("footer.php") ?>
  