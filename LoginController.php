<?php 
ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);
?>

<?php
  $dbHost     = "localhost"; 
  $dbUsername = "root"; 
  $dbPassword = "aris0007"; 
  $dbName     = "sbank_db"; 

// Establish database connection.
$conn = new mysqli($dbHost, $dbUsername,$dbPassword, $dbName); 
            
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
 }

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate form data
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Perform basic validation
    if (empty($username) || empty($password)) {
        // Handle empty fields
        header("Location: login.php?error=empty");
        exit();
    }

    // Prepare and bind parameters
    $stmt = $conn->prepare("SELECT * FROM user WHERE username = ?");
    $stmt->bind_param("s", $username);

    // Execute query
    $stmt->execute();

    // Get result
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // User found, verify password
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            // Password is correct, login successful
            $_SESSION['username'] = $username;
            header("Location: Login.php?success=true");
            exit();
        } else {
            // Incorrect password
            header("Location: Login.php?error=incorrect");
            exit();
        }
    } else {
        // User not found
        header("Location: Login.php?error=not_found");
        exit();
    }

    $stmt->close();
    $conn->close();
}
?>
