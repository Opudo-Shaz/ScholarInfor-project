<?php
// Include the database connection file
require_once "includes/dbconnection.php";

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Get the form data
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $email = $_POST["email"];

    // Validate the data (you can add more validation as needed)

    // Handle the uploaded profile picture
    $targetDir = "uploads/"; // Specify the directory to store uploaded files
    $profilePicture = basename($_FILES["profile_picture"]["name"]);
    $targetFilePath = $targetDir . $profilePicture;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

    // Check if the uploaded file is an image
    $check = getimagesize($_FILES["profile_picture"]["tmp_name"]);
    if ($check === false) {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check if the file already exists (you may choose to rename the file if it already exists)
    if (file_exists($targetFilePath)) {
        echo "Sorry, the file already exists.";
        $uploadOk = 0;
    }

    // Allow only specific file formats (you can add more formats if needed)
    $allowedFormats = array("jpg", "jpeg", "png", "gif");
    if (!in_array($imageFileType, $allowedFormats)) {
        echo "Sorry, only JPG, JPEG, PNG, and GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if the file was uploaded successfully
    if ($uploadOk === 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $targetFilePath)) {
            echo "The file " . htmlspecialchars($profilePicture) . " has been uploaded successfully.";

            // Use prepared statements to prevent SQL injection
            $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, email, profile_picture) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $first_name, $last_name, $email, $targetFilePath);

            if ($stmt->execute()) {
                echo "Profile created successfully.";
                header("Location: profile.php", true, 301);
                exit();
            } else {
                echo "Error: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>