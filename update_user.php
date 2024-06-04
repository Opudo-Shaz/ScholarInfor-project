<?php
require_once('includes/dbconnection.php');
session_start();
$pageTitle = "Update Role";
?>
<!DOCTYPE html>
<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <?php include "includes/head.php"; ?>
</head>

<body>
    <div class="main-wrapper">
        <!-- Sidebar -->
        <?php @include "includes/sidebar.php"; ?>
        <!-- Sidebar -->

        <div class="page-wrapper">
            <!-- Navbar -->
            <?php @include "includes/header.php"; ?>
            <!-- Navbar -->

            <div class="card mt-6" id="form-body">
                <div class="card-header h3">
                    Assign Role
                </div>
                <div class="card-body">
                    <form method="POST" action="insert_role.php">

                        <div class="form-group">
                            <!-- User Info Display -->
                            <div class="row align-items-center justify-content-between">
                                <div class="mb-3">
                                    <label class="form-label">User</label>
                                    <?php
                                    $id = $_GET['id'];
                                    $_SESSION['user_id_role'] = $id;
                                    $query = "SELECT * FROM users WHERE id='$id'";
                                    $result = mysqli_query($conn, $query);
                                    $row = mysqli_fetch_assoc($result);
                                    ?>
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td class="h5 text-capitalize">
                                                    <?php echo isset($row['first_name']) ? htmlspecialchars($row['first_name']) : ''; ?>
                                                </td>
                                                <td class="h5 text-capitalize">
                                                    <?php echo isset($row['last_name']) ? htmlspecialchars($row['last_name']) : ''; ?>
                                                </td>
                                                <td class="h5">
                                                    <?php echo isset($row['email']) ? htmlspecialchars($row['email']) : ''; ?>
                                                </td>

                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Current Role</label>

                                    <?php
                                    require_once 'model/Role.php';
                                    require_once 'model/Permission.php';
                                    require_once 'model/PrivilegedUser.php';

                                    $u = PrivilegedUser::getByEmail($row['email']);
                                    $sql = "SELECT role_id, role_name FROM roles";
                                    $result = mysqli_query($conn, $sql);

                                    if (mysqli_num_rows($result) > 0) {
                                        $options = mysqli_fetch_all($result, MYSQLI_ASSOC);
                                        echo '<table class="table">';
                                        echo '<tbody>';
                                        echo '<tr>'; // Start a single row
                                        foreach ($options as $option) {
                                            if ($u->hasRole($option['role_name'])) {
                                                $itsRole = $option['role_name'];
                                                echo '<td class="h5">';
                                                echo $option['role_name'] . "    ";
                                                echo '</td>';
                                            }
                                        }
                                        echo '</tr>'; // End the single row
                                        echo '</tbody>';
                                        echo '</table>';
                                    }
                                    ?>



                                </div>
                                <!-- Role Selection -->
                                <div class="mb-3">
                                    <label for="roleSelect" class="form-label">Assign Role</label>
                                    <select id="roleSelect" name="selected_role" class="form-select">
                                        <option selected disabled>Select role</option>
                                        <?php
                                        $sql = "SELECT role_id, role_name FROM roles";
                                        $result = mysqli_query($conn, $sql);

                                        if (mysqli_num_rows($result) > 0) {
                                            $options = mysqli_fetch_all($result, MYSQLI_ASSOC);
                                            foreach ($options as $option) {
                                                echo '<option value="' . $option['role_id'] . '">' . $option['role_name'] . '</option>';
                                            }
                                        } else {
                                            echo '<option disabled>No data found.</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <!-- Role and Permissions Display -->
                            <?php
                            echo '<table class="table table-bordered">';
                            echo '<thead class="thead-dark"><tr><th>Role Name</th><th>Permissions</th></tr></thead><tbody>';

                            foreach ($options as $option) {
                                $selectedRoleName = $option['role_name'];

                                // Construct the query
                                $sql = "SELECT r.role_name, GROUP_CONCAT(p.perm_desc) AS permissions
                                        FROM roles r
                                        INNER JOIN role_perm rp ON r.role_id = rp.role_id
                                        INNER JOIN permissions p ON rp.perm_id = p.perm_id
                                        WHERE r.role_name = ?
                                        GROUP BY r.role_id"; // Group permissions by role
                            
                                // Prepare the statement
                                $stmt = mysqli_prepare($conn, $sql);

                                if ($stmt) {
                                    // Bind the parameter
                                    mysqli_stmt_bind_param($stmt, "s", $selectedRoleName);

                                    // Execute the statement
                                    mysqli_stmt_execute($stmt);

                                    // Get the result
                                    $result = mysqli_stmt_get_result($stmt);

                                    if ($result) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo '<tr>';
                                            echo '<td>' . $row['role_name'] . '</td>';
                                            echo '<td>' . $row['permissions'] . '</td>';
                                            echo '</tr>';
                                        }
                                    } else {
                                        echo '<tr><td colspan="2" class="text-center">No permissions found for the selected role.</td></tr>';
                                    }

                                    // Close the statement
                                    mysqli_stmt_close($stmt);
                                } else {
                                    echo '<tr><td colspan="2" class="text-center">Error in preparing the query.</td></tr>';
                                }
                            }

                            echo '</tbody></table>';
                            // Close the connection after the loop
                            mysqli_close($conn);
                            ?>
                        </div>

                        <!-- Submit Button -->
                        <input type="submit" name="submit" value="Submit" class="btn btn-primary mt-2" id="submit">
                    </form>
                </div>
            </div>
        </div>

    </div>
    <!-- core:js -->
    <script src="assets/vendors/core/core.js"></script>
    <!-- endinject -->

    <!-- Plugin js for this page -->
    <script src="assets/vendors/flatpickr/flatpickr.min.js"></script>
    <script src="assets/vendors/apexcharts/apexcharts.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <!-- End plugin js for this page -->

    <!-- inject:js -->
    <script src="assets/vendors/feather-icons/feather.min.js"></script>
    <script src="assets/js/template.js"></script>
    <!-- endinject -->

    <!-- Custom js for this page -->
    <script src="assets/js/dashboard-dark.js"></script>
    <!-- End custom js for this page -->

</body>

</html>