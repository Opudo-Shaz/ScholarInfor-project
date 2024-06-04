<?php session_start();
$pageTitle = "Profile";
$userData = $_SESSION['userData'];

include_once "includes/dbConnection.php";

function getUserById($id, $db)
{
    $sql = "SELECT * FROM users WHERE id = ?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        return $user;
    } else {
        return 0;
    }
}

$user = getUserById($userData["id"], $conn);
$id = $userData['id'];


$query = "SELECT * FROM users WHERE id='$id'";


$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

if (isset($_SESSION['userData'])) { ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>

        <title>Profile --ScholarInfo</title>
        <?php
        @include("includes/head.php"); ?>
    </head>

    <body>

        <body>
            <div class="main-wrapper">
                <!-- partial:partials/_sidebar.html -->
                <?php @include "includes/sidebar.php" ?>
                <!-- partial -->

                <div class="page-wrapper" style="background-color: rgb(255, 255, 255); color: black">
                    <!-- partial:partials/_navbar.html -->
                    <?php @include "includes/header.php" ?>
                    <!-- partial -->
                    <?php
                    if ($user) {
                        ?>

                        <div class="container mt-4 py-4">
                            <div class="d-flex justify-content-center align-items-center vh-100">
                                <form class="shadow w-450 p-3 form-horizontal col-md-8 col-lg-6" role="form"
                                    action="profile/profile_process.php" method="post" enctype="multipart/form-data">
                                    <h4 class="display-4 mb-2 fs-3">Edit Profile</h4>
                                    <!-- error -->
                                    <?php if (isset($_GET['error'])) { ?>
                                        <div class="alert alert-danger" role="alert">
                                            <?php echo $_GET['error'];
                                            ?>
                                        </div>
                                    <?php } ?>
                                    <!-- success -->
                                    <?php if (isset($_GET['success'])) { ?>
                                        <div class="alert alert-success" role="alert">
                                            <?php echo $_GET['success']; ?>
                                        </div>
                                    <?php } ?>
                                    <div class="mb-3">
                                        <label for="firstname" class="col control-label">First name:</label>
                                        <div class="col">
                                            <input type="text" class="form-control" id="firstname"
                                                placeholder="Enter your first name" name="first_name"
                                                value="<?php echo isset($row['first_name']) ? htmlspecialchars($row['first_name']) : ''; ?>">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="lastname" class="col-lg-3 control-label">Last name:</label>
                                        <div class="col">
                                            <input type="text" class="form-control" id="lastname"
                                                placeholder="Enter your last name" name="last_name"
                                                value="<?php echo isset($row['last_name']) ? htmlspecialchars($row['last_name']) : ''; ?>">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="col-lg-3 control-label">Email:</label>
                                        <div class="col">
                                            <input type="email" class="form-control" id="email"
                                                placeholder="Enter your email address" name="email"
                                                value="<?php echo isset($row['email']) ? htmlspecialchars($row['email']) : ''; ?>">
                                        </div>
                                    </div>
                                    <!-- Image Upload Section -->

                                    <div class="mb-3">

                                        <label for="profile_image" class="col control-label">Profile Picture</label>
                                        <div class="col">
                                            <img src="<?php echo !empty($row['profile_image']) ? 'upload/' . $row['profile_image'] : './assets/images/profile_avatar.png'; ?>"
                                                alt="profile photo" alt="Profile Picture"
                                                class="img-fluid ms-3 mb-3  img-circle img-thumbnail rounded-circle"
                                                alt="avatar" name="profile_image" id="profile_image"
                                                style="width: 100px; height: 70px">
                                            <h6>Upload a different photo...</h6>
                                            <input type="file" name="profile_image" class="form-control" />
                                            <input type="text" hidden="hidden" name="old_profile_picture"
                                                value="<?php echo isset($row['profile_image']) ? htmlspecialchars($row['profile_image']) : ''; ?>">
                                        </div>

                                    </div>
                                    <div class="pt-2 d-flex justify-content-between">
                                        <input type="submit" value="update" name="submit"
                                            class="btn btn-primary col btn-lg w-50 text-uppercase">

                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
                </div>
                <!-- partial:partials/_footer.html -->
                <footer
                    class="footer d-flex flex-column flex-md-row align-items-center justify-content-end px-4 py-3 border-top small">
                    Copyright ©
                    <script>
                        document.write(new Date().getFullYear());
                    </script>
                    <a href="https://ScholarInfo.or.ke/" target="_blank"><span style="margin-left: 0.5rem">FScholarInfo</span></a>

                    <p class="text-muted px-5">
                        Handcrafted With
                        <i class="mb-1 text-primary ms-1 icon-sm" data-feather="heart"></i>
                    </p>
                </footer>
                <!-- partial -->

                <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
                <script src="http://code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
                <script src="./assets/js/custom.js"></script>
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
            <?php } else {
                        header("Location: welcome.php");
                        exit;
                    } ?>
        </body>

    </html>
<?php } else {
    header("Location: index.php");
    exit;
} ?>