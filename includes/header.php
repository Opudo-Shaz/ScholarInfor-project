<nav class="navbar" style="position: fixed">
          <a href="#" class="sidebar-toggler">
            <i data-feather="menu"></i>
          </a>
          <div class="navbar-content">
            <ul class="navbar-nav">
              <li class="nav-item dropdown">
                <a
                  class="nav-link dropdown-toggle"
                  href="#"
                  id="profileDropdown"
                  role="button"
                  data-bs-toggle="dropdown"
                  aria-haspopup="true"
                  aria-expanded="false"
                >
                  <img
                    class="wd-30 ht-30 rounded-circle"
                    src="./assets/images/profile_avatar.png"
                    alt="profile photo"
                  />
                </a>
                <div
                  class="dropdown-menu p-0"
                  aria-labelledby="profileDropdown"
                >
                  <div
                    class="d-flex flex-column align-items-center border-bottom px-5 py-3"
                  >
                    <div class="mb-3">
                      <img
                        class="wd-80 ht-80 rounded-circle"
                        src="./assets/images/profile_avatar.png"
                        alt="profile photo"
                      />
                    </div>
                    <div class="text-center">
                     <p class="tx-16 fw-bolder"><?php echo $userData['first_name'].' '.$userData['last_name']; ?></p>
                      <p class="tx-12 text-muted"><?php echo $userData['email']; ?></p>
                    </div>
                  </div>
                  <ul class="list-unstyled p-1">
                    <li class="dropdown-item py-2">
                      <a href="profile.html" class="text-body ms-0">
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
              </li>
            </ul>
          </div>
        </nav>