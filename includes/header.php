<?php session_start();
include_once "dbconnection.php";
$userData = $_SESSION['userData'];
$id = $userData['id'];


$query = "SELECT * FROM users WHERE id='$id'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result); ?>
<nav class="navbar" style="position: fixed">
  <a href="#" class="sidebar-toggler">
    <i data-feather="menu"></i>
  </a>
  <div class="navbar-content">
    <ul class="navbar-nav">
      <?php
      if (!empty($userData)) { ?>
        <li class="nav-item toggler">
          <!-- Use Font Awesome icons for the toggler -->
          <label class="switch">
            <input type="checkbox" hidden id="modeToggle">
            <span class="slider"><i class="fas fa-circle"></i></span>
          </label>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            <img class="wd-30 ht-30 rounded-circle"
              src="<?php echo !empty($row['profile_image']) ? 'upload/' . $row['profile_image'] : './assets/images/profile_avatar.png'; ?>"
              alt="profile photo" />
          </a>
          <div class="dropdown-menu p-0" aria-labelledby="profileDropdown">

            <div class="d-flex flex-column align-items-center border-bottom px-5 py-3">

              <div class="mb-3">
                <img class="wd-80 ht-80 rounded-circle"
                  src="<?php echo !empty($row['profile_image']) ? 'upload/' . $row['profile_image'] : './assets/images/profile_avatar.png'; ?>"
                  alt="profile photo" />
              </div>
              <div class="text-center">

                <p class="tx-16 fw-bolder">
                  <?php echo $userData['first_name'] . ' ' . $userData['last_name']; ?>
                </p>
                <p class="tx-12 text-muted">
                  <?php echo $userData['email']; ?>
                </p>
              </div>
            </div>
            <ul class="list-unstyled p-1">
              <li class="dropdown-item py-2">
                <a href="profile.php" class="text-body ms-0">
                  <i class="me-2 icon-md" data-feather="edit"></i>
                  <span>Edit Profile</span>
                </a>
              </li>

              <li class="dropdown-item py-2">
                <a href="userAccount.php?logoutSubmit=1" class="text-body ms-0">
                  <i class="me-2 icon-md" data-feather="log-out"></i>
                  <span>Log Out</span>
                </a>
              </li>
            </ul>
          </div>
        <?php } else {
        header('location:logout.php');
        exit();
      }
      ?>



      </li>
    </ul>
  </div>
</nav>
<script>
  // Check if the user's preference is stored in local storage
  const storedPreference = localStorage.getItem("darkMode");
  const modeToggle = document.getElementById("modeToggle");
  const stylesheet = document.getElementById("stylesheet");

  // Set initial state based on stored preference
  if (storedPreference === "true") {
    modeToggle.checked = true;
    stylesheet.href = "assets/css/style.css";
  } else {
    modeToggle.checked = false;
    stylesheet.href = "assets/css/style-light.css";
  }

  modeToggle.addEventListener("change", () => {
    if (modeToggle.checked) {
      stylesheet.href = "assets/css/style.css";
      // Store preference in local storage
      localStorage.setItem("darkMode", "true");
    } else {
      stylesheet.href = "assets/css/style-light.css";
      // Remove preference from local storage
      localStorage.removeItem("darkMode");
    }
  });
</script>