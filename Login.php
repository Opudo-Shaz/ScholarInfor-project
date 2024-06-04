<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login</title>
<!-- CSS styles -->
<style>
    /* Styling */
    #popup-form-container {
        display: none;
        position: fixed;
        z-index: 9999;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.5);
    }

    /* Styling for popup form */
    .popup-form {
        background-color: #fefefe;
        margin: 20% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
    }

    /* Overlay style */
    #overlay {
        display: none;
        position: fixed;
        z-index: 9998;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
    }
</style>
</head>
<body>

<!-- Popup form container -->
<div id="popup-form-container">
    <!-- Popup form content -->
    <div class="popup-form">
        <h2>Enter Verification Code</h2>
        <form id="verification-form" action="includes/2faAuth.php" method="post">
            <input type="text" id="verification-code" name="verification_code" placeholder="Verification Code" required>
            <input type="submit" value="Verify & login">
        </form>
    </div>
</div>

<!-- Overlay to darken the background -->
<div id="overlay"></div>

<!-- Your login form -->
<div id="login-form">
    <h2>Login</h2>
    <!-- Error message -->
    <?php if(isset($_GET['error']) && $_GET['error'] === 'incorrect'): ?>
    <div class="error-message">Incorrect username or password. Please try again.</div>
    <?php endif; ?>
    <!-- Your login form fields -->
    <form action="LoginController.php" method="post" onsubmit="return validateLogin()">
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <input type="submit" value="Login">
    </form>
</div>


<!-- Script to conditionally display popup form -->
<script>
    // Get the popup form container
    var popupFormContainer = document.getElementById('popup-form-container');

    // Get the overlay
    var overlay = document.getElementById('overlay');

    // Function to open the popup form conditionally based on login success
    function openPopupForm() {
        var urlParams = new URLSearchParams(window.location.search);
        var success = urlParams.get('success');

        if (success === 'true') {
            popupFormContainer.style.display = 'block'; // Display the popup form container
            overlay.style.display = 'block'; // Display the overlay
        }
    }

    // Open the popup form when the page loads
    window.onload = openPopupForm;

    // Function to validate login form
    function validateLogin() {
       // Function to validate login form
function validateLogin() {

    var usernameInput = document.getElementsByName("username")[0];
    var passwordInput = document.getElementsByName("password")[0];

    // Get the error message element
    var errorMessage = document.getElementById("error-message");

    // Check if username and password are empty
    if (usernameInput.value.trim() === "" || passwordInput.value.trim() === "") {
        errorMessage.textContent = "Username and password are required.";
        return false; // Prevent form submission
    }

    // Check if username is at least 3 characters long
    if (usernameInput.value.length < 3) {
        errorMessage.textContent = "Username must be at least 3 characters long.";
        return false; // Prevent form submission
    }

    // If all validation passes, return true to allow form submission
    return true;
}

        return true;
    }
</script>

</body>
</html>
