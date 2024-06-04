<?php
session_start();
include_once "includes/dbconnection.php";
require_once 'model/Role.php';
require_once 'model/Permission.php';
require_once 'model/PrivilegedUser.php';

// Assuming you have previously stored user data in $_SESSION['userData']
$userData = $_SESSION['userData'];

// Extract user_id from the userData array
$user_id = $userData['id'];

$sql = "SELECT email FROM users WHERE id=?";
$stmt = mysqli_prepare($conn, $sql);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) > 0) {
        // If the user is found, fetch the email from the result
        $row = mysqli_fetch_assoc($result);
        $email = $row['email'];

        // Create a PrivilegedUser object using the getByEmail() method
        $u = PrivilegedUser::getByEmail($email);
        $_SESSION['userEmail'] = $u;
    } else {
        // User not found or no results
        echo 'User not found or no results.';
    }

    mysqli_stmt_close($stmt);
} else {
    // Error preparing the statement
    echo 'Error preparing statement: ' . mysqli_error($conn);
}
?>


<nav class="sidebar">
    <div class="sidebar-header">
        <a href="#" class="sidebar-brand" style="text-decoration: none">
            <span class="h4">
                <?php
                echo "$pageTitle" ?>
            </span>

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
                <a href="welcome.php" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Dashboard</span>
                </a>
            </li>
            </li>
            <li class="nav-item nav-category">Register Community</li>
            <?php if ($u->hasRole("Admin") || $u->hasRole("Editor") || $u->hasRole("Super_admin")) { ?>

            <li class="nav-item">
                <a class="nav-link" href="community.php" role="button">
                    <i class="link-icon" data-feather="home"></i>
                    <span class="link-title">Add Community</span>
                </a>
                <?php } ?>

            </li>
            <li class="nav-item">
                <a class="nav-link" href="community_list.php" role="button">
                    <i class="link-icon" data-feather="list"></i>
                    <span class="link-title">Community List</span>
                </a>
            </li>

            <li class="nav-item nav-category">Register School</li>
            <?php if ($u->hasRole("Admin") || $u->hasRole("Editor") || $u->hasRole("Super_admin")) { ?>

            <li class="nav-item">
                <a class="nav-link" href="school.php" role="button">
                    <i class="link-icon" data-feather="home"></i>
                    <span class="link-title">Add School</span>
                </a>
                <?php } ?>

            </li>
            <li class="nav-item">
                <a class="nav-link" href="school_list.php" role="button">
                    <i class="link-icon" data-feather="list"></i>
                    <span class="link-title">School List</span>
                </a>
            </li>
            <?php if ($u->hasRole("Admin") || $u->hasRole("Editor") || $u-> hasRole("User") || $u->hasRole("Super_admin")) { ?>
            <li class="nav-item nav-category">Register Students</li>
            
            <li class="nav-item">
                <a class="nav-link" href="student.php" role="button">
                    <i class="link-icon" data-feather="plus"></i>
                    <span class="link-title">Add Students</span>
                </a>
            </li>
            <?php } ?>
            <?php if ($u->hasRole("Admin") || $u->hasRole("Super_admin")) { ?>
            <li class="nav-item nav-category">Verify Student Details</li>
            
            <li class="nav-item">
                <a class="nav-link" href="verify_details.php" role="button">
                    <i class="link-icon" data-feather="plus"></i>
                    <span class="link-title">Verify Student</span>
                </a>
            </li>

<li class="nav-item">
<a class="nav-link" href="verified_details.php" role="button">
    <i class="link-icon" data-feather="list"></i>
    <span class="link-title">Verified Students</span>
</a>
</li>
<li class="nav-item">
<a class="nav-link" href="pending_details.php" role="button">
    <i class="link-icon" data-feather="list"></i>
    <span class="link-title">Pending Verification</span>
</a>

</li>
<li class="nav-item">
<a class="nav-link" href="declined_details.php" role="button">
    <i class="link-icon" data-feather="list"></i>
    <span class="link-title">Declined Students</span>
</a>
</li>

   <?php } ?>

   <?php if ($u->hasRole("Admin") || $u->hasRole("Super_admin")) { ?>
            <li class="nav-item nav-category">Update Student Details</li>
            
<li class="nav-item">
<a class="nav-link" href="update_student_records.php" role="button">
    <i class="link-icon" data-feather="list"></i>
    <span class="link-title">Update Student Details</span>
</a>
</li>



   <?php } ?>


            <li class="nav-item nav-category">Students Info</li>
           
            <li class="nav-item">
                <a class="nav-link" href="student_list.php" role="button">
                    <i class="link-icon" data-feather="list"></i>
                    <span class="link-title">Students List</span>
                </a>
                <?php if ($u->hasRole("Admin") || $u->hasRole("Editor") || $u->hasRole("Super_admin")) { ?>

                <li class="nav-item">
                <a class="nav-link" href="student_details.php" role="button">
                    <i class="link-icon" data-feather="list"></i>
                    <span class="link-title">Students Details</span>
                </a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="student_records1.php" role="button">
                    <i class="link-icon" data-feather="list"></i>
                    <span class="link-title">Students Records</span>
                </a>

            </li>
            <li class="nav-item">
                <a class="nav-link" href="dropout_details.php" role="button">
                    <i class="link-icon" data-feather="list"></i>
                    <span class="link-title">Dropped_Out Students</span>
                </a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="ongoing_details.php" role="button">
                    <i class="link-icon" data-feather="list"></i>
                    <span class="link-title">Ongoing Students</span>
                </a>

            </li>

            <?php } ?>

            <?php if ($u->hasRole("Admin") || $u->hasRole("Super_admin")) { ?>     
            <li class="nav-item nav-category">Sponsors</li>
            <li class="nav-item">
                <a class="nav-link" href="add_sponsor.php" role="button">
                    <i class="link-icon" data-feather="gift"></i>
                    <span class="link-title">Add Sponsors</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="assign_sponsor1.php" role="button">
                    <i class="link-icon" data-feather="edit-3"></i>
                    <span class="link-title">Assign Sponsors</span>
                </a>
            </li>

            <li class="nav-item nav-category">Sponsors Info</li>

            <li class="nav-item">
                <a class="nav-link" href="organisational_sponsors.php" role="button">
                    <i class="link-icon" data-feather="list"></i>
                    <span class="link-title">Organisational Sponsors</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="family_sponsors.php" role="button">
                    <i class="link-icon" data-feather="list"></i>
                    <span class="link-title">Family Sponsors</span>
                </a>
                <li class="nav-item">
                <a class="nav-link" href="individual_sponsors.php" role="button">
                    <i class="link-icon" data-feather="list"></i>
                    <span class="link-title">Individual Sponsors</span>
                </a>
                <?php } ?>

                <?php if ($u->hasRole("Admin") || $u->hasRole("Super_admin")) { ?>     
            <li class="nav-item nav-category">Mentors</li>
            <li class="nav-item">
                <a class="nav-link" href="add_mentor.php" role="button">
                    <i class="link-icon" data-feather="gift"></i>
                    <span class="link-title">Add Mentors</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="assign_mentor1.php" role="button">
                    <i class="link-icon" data-feather="edit-3"></i>
                    <span class="link-title">Assign Mentor</span>
                </a>
            </li>

            <li class="nav-item nav-category">Mentors Info</li>

            <li class="nav-item">
                <a class="nav-link" href="zuri_mentors.php" role="button">
                    <i class="link-icon" data-feather="list"></i>
                    <span class="link-title">Zuri Mentorship Members</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="saka_mentors.php" role="button">
                    <i class="link-icon" data-feather="list"></i>
                    <span class="link-title">Saka Mentorship Members</span>
                </a>
                <?php } ?>

            <?php if ($u->hasRole("Super_admin")) { ?>
                <li class="nav-item nav-category">User Account Controls</li>
                <li class="nav-item">
                    <a class="nav-link" href="users.php">
                        <i class="link-icon" data-feather="users"></i>
                        <span class="link-title">Users</span>
                    </a>
                </li>
            <?php } ?>
            <li class="nav-item nav-category">Pages</li>
            <li class="nav-item">
                <a class="nav-link" href="profile.php" role="button" aria-expanded="false"
                    aria-controls="general-pages">
                    <i class="link-icon" data-feather="book"></i>
                    <span class="link-title">Profile</span>
                </a>
            </li>
        </ul>
    </div>
</nav>