<?php
session_start();
@include("includes/head.php"); 
$userData = $_SESSION['userData'];

?>
<body>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta
      name="description"
      content="Forum For African Women Educationalists"
    />
    <meta name="author" content="OSLABS" />
    <meta
      name="keywords"
      content="FAWE, Forum For African Women Educationalists, FAWE Kenya"
    />

    <title>FAWE -Dashboard</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap"
      rel="stylesheet"
    />
    <!-- End fonts -->

    <!-- core:css -->
    <link rel="stylesheet" href="assets/vendors/core/core.css" />
    <!-- endinject -->

    <!-- Plugin css for this page -->
    <link
      rel="stylesheet"
      href="assets/vendors/flatpickr/flatpickr.min.css"
    />
    <!-- End plugin css for this page -->

    <!-- inject:css -->
    <link
      rel="stylesheet"
      href="assets/fonts/feather-font/css/iconfont.css"
    />

    <!-- endinject -->

    <!-- Layout styles -->
    <link rel="stylesheet" href="assets/css/style.css" />
    <!-- End layout styles -->

    <link rel="shortcut icon" href="assets/images/favicon.jpg" />
  </head>
  <body>
    <div class="main-wrapper">
      <!-- partial:partials/_sidebar.html -->
      <?php @include "includes/sidebar.php" ?>
      <!-- partial -->

      <div class="page-wrapper">
        <!-- partial:partials/_navbar.html -->
       <?php @include "includes/header.php" ?>
        <!-- partial -->

        <div class="page-content">
          <div
            class="d-flex justify-content-between align-items-center flex-wrap grid-margin"
          >
            <div>
              <h4 class="mb-3 mb-md-0">Welcome to Dashboard</h4>
            </div>
            <div class="d-flex align-items-center flex-wrap text-nowrap">
              <div
                class="input-group flatpickr wd-200 me-2 mb-2 mb-md-0"
                id="dashboardDate"
              >
                <span
                  class="input-group-text input-group-addon bg-transparent border-primary"
                  data-toggle
                  ><i data-feather="calendar" class="text-primary"></i
                ></span>
                <input
                  type="text"
                  class="form-control bg-transparent border-primary"
                  placeholder="Select date"
                  data-input
                />
              </div>
              <button
                type="button"
                class="btn btn-outline-primary btn-icon-text me-2 mb-2 mb-md-0"
              >
                <i class="btn-icon-prepend" data-feather="printer"></i>
                Print
              </button>
              <button
                type="button"
                class="btn btn-primary btn-icon-text mb-2 mb-md-0"
              >
                <i class="btn-icon-prepend" data-feather="download-cloud"></i>
                Download Report
              </button>
            </div>
          </div>

          <div class="row">
            <div class="col-12 col-xl-12 stretch-card">
              <div class="row flex-grow-1">
                <div class="col-md-4 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <div
                        class="d-flex justify-content-between align-items-baseline"
                      >
                        <h6 class="card-title mb-0">New Students</h6>
                        <div class="dropdown mb-2">
                          <a
                            type="button"
                            id="dropdownMenuButton"
                            data-bs-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false"
                          >
                            <i
                              class="icon-lg text-muted pb-3px"
                              data-feather="more-horizontal"
                            ></i>
                          </a>
                          <div
                            class="dropdown-menu"
                            aria-labelledby="dropdownMenuButton"
                          >
                            <a
                              class="dropdown-item d-flex align-items-center"
                              href="javascript:;"
                              ><i data-feather="eye" class="icon-sm me-2"></i>
                              <span class="">View</span></a
                            >
                            <a
                              class="dropdown-item d-flex align-items-center"
                              href="javascript:;"
                              ><i
                                data-feather="edit-2"
                                class="icon-sm me-2"
                              ></i>
                              <span class="">Edit</span></a
                            >
                            <a
                              class="dropdown-item d-flex align-items-center"
                              href="javascript:;"
                              ><i data-feather="trash" class="icon-sm me-2"></i>
                              <span class="">Delete</span></a
                            >
                            <a
                              class="dropdown-item d-flex align-items-center"
                              href="javascript:;"
                              ><i
                                data-feather="printer"
                                class="icon-sm me-2"
                              ></i>
                              <span class="">Print</span></a
                            >
                            <a
                              class="dropdown-item d-flex align-items-center"
                              href="javascript:;"
                              ><i
                                data-feather="download"
                                class="icon-sm me-2"
                              ></i>
                              <span class="">Download</span></a
                            >
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-6 col-md-12 col-xl-5">
                          <h3 class="mb-2">3,897</h3>
                          <div class="d-flex align-items-baseline">
                            <p class="text-success">
                              <span>+3.3%</span>
                              <i
                                data-feather="arrow-up"
                                class="icon-sm mb-1"
                              ></i>
                            </p>
                          </div>
                        </div>
                        <div class="col-6 col-md-12 col-xl-7">
                          <div
                            id="customersChart"
                            class="mt-md-3 mt-xl-0"
                          ></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-4 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <div
                        class="d-flex justify-content-between align-items-baseline"
                      >
                        <h6 class="card-title mb-0">Schools</h6>
                        <div class="dropdown mb-2">
                          <a
                            type="button"
                            id="dropdownMenuButton1"
                            data-bs-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false"
                          >
                            <i
                              class="icon-lg text-muted pb-3px"
                              data-feather="more-horizontal"
                            ></i>
                          </a>
                          <div
                            class="dropdown-menu"
                            aria-labelledby="dropdownMenuButton1"
                          >
                            <a
                              class="dropdown-item d-flex align-items-center"
                              href="javascript:;"
                              ><i data-feather="eye" class="icon-sm me-2"></i>
                              <span class="">View</span></a
                            >
                            <a
                              class="dropdown-item d-flex align-items-center"
                              href="javascript:;"
                              ><i
                                data-feather="edit-2"
                                class="icon-sm me-2"
                              ></i>
                              <span class="">Edit</span></a
                            >
                            <a
                              class="dropdown-item d-flex align-items-center"
                              href="javascript:;"
                              ><i data-feather="trash" class="icon-sm me-2"></i>
                              <span class="">Delete</span></a
                            >
                            <a
                              class="dropdown-item d-flex align-items-center"
                              href="javascript:;"
                              ><i
                                data-feather="printer"
                                class="icon-sm me-2"
                              ></i>
                              <span class="">Print</span></a
                            >
                            <a
                              class="dropdown-item d-flex align-items-center"
                              href="javascript:;"
                              ><i
                                data-feather="download"
                                class="icon-sm me-2"
                              ></i>
                              <span class="">Download</span></a
                            >
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-6 col-md-12 col-xl-5">
                          <h3 class="mb-2">35,084</h3>
                          <div class="d-flex align-items-baseline">
                            <p class="text-danger">
                              <span>-2.8%</span>
                              <i
                                data-feather="arrow-down"
                                class="icon-sm mb-1"
                              ></i>
                            </p>
                          </div>
                        </div>
                        <div class="col-6 col-md-12 col-xl-7">
                          <div id="ordersChart" class="mt-md-3 mt-xl-0"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-4 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <div
                        class="d-flex justify-content-between align-items-baseline"
                      >
                        <h6 class="card-title mb-0">Growth</h6>
                        <div class="dropdown mb-2">
                          <a
                            type="button"
                            id="dropdownMenuButton2"
                            data-bs-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false"
                          >
                            <i
                              class="icon-lg text-muted pb-3px"
                              data-feather="more-horizontal"
                            ></i>
                          </a>
                          <div
                            class="dropdown-menu"
                            aria-labelledby="dropdownMenuButton2"
                          >
                            <a
                              class="dropdown-item d-flex align-items-center"
                              href="javascript:;"
                              ><i data-feather="eye" class="icon-sm me-2"></i>
                              <span class="">View</span></a
                            >
                            <a
                              class="dropdown-item d-flex align-items-center"
                              href="javascript:;"
                              ><i
                                data-feather="edit-2"
                                class="icon-sm me-2"
                              ></i>
                              <span class="">Edit</span></a
                            >
                            <a
                              class="dropdown-item d-flex align-items-center"
                              href="javascript:;"
                              ><i data-feather="trash" class="icon-sm me-2"></i>
                              <span class="">Delete</span></a
                            >
                            <a
                              class="dropdown-item d-flex align-items-center"
                              href="javascript:;"
                              ><i
                                data-feather="printer"
                                class="icon-sm me-2"
                              ></i>
                              <span class="">Print</span></a
                            >
                            <a
                              class="dropdown-item d-flex align-items-center"
                              href="javascript:;"
                              ><i
                                data-feather="download"
                                class="icon-sm me-2"
                              ></i>
                              <span class="">Download</span></a
                            >
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-6 col-md-12 col-xl-5">
                          <h3 class="mb-2">89.87%</h3>
                          <div class="d-flex align-items-baseline">
                            <p class="text-success">
                              <span>+2.8%</span>
                              <i
                                data-feather="arrow-up"
                                class="icon-sm mb-1"
                              ></i>
                            </p>
                          </div>
                        </div>
                        <div class="col-6 col-md-12 col-xl-7">
                          <div id="growthChart" class="mt-md-3 mt-xl-0"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- row -->

          <div class="row">
            <div class="col-12 col-xl-12 grid-margin stretch-card">
              <div class="card overflow-hidden">
                <div class="card-body">
                  <div
                    class="d-flex justify-content-between align-items-baseline mb-4 mb-md-3"
                  >
                    <h6 class="card-title mb-0">Revenue</h6>
                    <div class="dropdown">
                      <a
                        type="button"
                        id="dropdownMenuButton3"
                        data-bs-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                      >
                        <i
                          class="icon-lg text-muted pb-3px"
                          data-feather="more-horizontal"
                        ></i>
                      </a>
                      <div
                        class="dropdown-menu"
                        aria-labelledby="dropdownMenuButton3"
                      >
                        <a
                          class="dropdown-item d-flex align-items-center"
                          href="javascript:;"
                          ><i data-feather="eye" class="icon-sm me-2"></i>
                          <span class="">View</span></a
                        >
                        <a
                          class="dropdown-item d-flex align-items-center"
                          href="javascript:;"
                          ><i data-feather="edit-2" class="icon-sm me-2"></i>
                          <span class="">Edit</span></a
                        >
                        <a
                          class="dropdown-item d-flex align-items-center"
                          href="javascript:;"
                          ><i data-feather="trash" class="icon-sm me-2"></i>
                          <span class="">Delete</span></a
                        >
                        <a
                          class="dropdown-item d-flex align-items-center"
                          href="javascript:;"
                          ><i data-feather="printer" class="icon-sm me-2"></i>
                          <span class="">Print</span></a
                        >
                        <a
                          class="dropdown-item d-flex align-items-center"
                          href="javascript:;"
                          ><i data-feather="download" class="icon-sm me-2"></i>
                          <span class="">Download</span></a
                        >
                      </div>
                    </div>
                  </div>
                  <div class="row align-items-start">
                    <div class="col-md-7">
                      <p class="text-muted tx-13 mb-3 mb-md-0">
                        Revenue is the income that a business has from its
                        normal business activities, usually from the sale of
                        goods and services to customers.
                      </p>
                    </div>
                    <div class="col-md-5 d-flex justify-content-md-end">
                      <div
                        class="btn-group mb-3 mb-md-0"
                        role="group"
                        aria-label="Basic example"
                      >
                        <button type="button" class="btn btn-outline-primary">
                          Today
                        </button>
                        <button
                          type="button"
                          class="btn btn-outline-primary d-none d-md-block"
                        >
                          Week
                        </button>
                        <button type="button" class="btn btn-primary">
                          Month
                        </button>
                        <button type="button" class="btn btn-outline-primary">
                          Year
                        </button>
                      </div>
                    </div>
                  </div>
                  <div id="revenueChart"></div>
                </div>
              </div>
            </div>
          </div>
          <!-- row -->

          <div class="row justify-content-center">
            <div class="col-lg-7 col-xl-8 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div
                    class="d-flex justify-content-between align-items-baseline mb-2"
                  >
                    <h6 class="card-title mb-0">Monthly sales</h6>
                    <div class="dropdown mb-2">
                      <a
                        type="button"
                        id="dropdownMenuButton4"
                        data-bs-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                      >
                        <i
                          class="icon-lg text-muted pb-3px"
                          data-feather="more-horizontal"
                        ></i>
                      </a>
                      <div
                        class="dropdown-menu"
                        aria-labelledby="dropdownMenuButton4"
                      >
                        <a
                          class="dropdown-item d-flex align-items-center"
                          href="javascript:;"
                          ><i data-feather="eye" class="icon-sm me-2"></i>
                          <span class="">View</span></a
                        >
                        <a
                          class="dropdown-item d-flex align-items-center"
                          href="javascript:;"
                          ><i data-feather="edit-2" class="icon-sm me-2"></i>
                          <span class="">Edit</span></a
                        >
                        <a
                          class="dropdown-item d-flex align-items-center"
                          href="javascript:;"
                          ><i data-feather="trash" class="icon-sm me-2"></i>
                          <span class="">Delete</span></a
                        >
                        <a
                          class="dropdown-item d-flex align-items-center"
                          href="javascript:;"
                          ><i data-feather="printer" class="icon-sm me-2"></i>
                          <span class="">Print</span></a
                        >
                        <a
                          class="dropdown-item d-flex align-items-center"
                          href="javascript:;"
                          ><i data-feather="download" class="icon-sm me-2"></i>
                          <span class="">Download</span></a
                        >
                      </div>
                    </div>
                  </div>
                  <p class="text-muted">
                    Sales are activities related to selling or the number of
                    goods or services sold in a given time period.
                  </p>
                  <div id="monthlySalesChart"></div>
                </div>
              </div>
            </div>
            <div class="row justify-content-center">
              <div class="col-lg-7 col-xl-8 stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div
                      class="d-flex justify-content-between align-items-baseline mb-2"
                    >
                      <h6 class="card-title mb-0">Projects</h6>
                      <div class="dropdown mb-2">
                        <a
                          type="button"
                          id="dropdownMenuButton7"
                          data-bs-toggle="dropdown"
                          aria-haspopup="true"
                          aria-expanded="false"
                        >
                          <i
                            class="icon-lg text-muted pb-3px"
                            data-feather="more-horizontal"
                          ></i>
                        </a>
                        <div
                          class="dropdown-menu"
                          aria-labelledby="dropdownMenuButton7"
                        >
                          <a
                            class="dropdown-item d-flex align-items-center"
                            href="javascript:;"
                            ><i data-feather="eye" class="icon-sm me-2"></i>
                            <span class="">View</span></a
                          >
                          <a
                            class="dropdown-item d-flex align-items-center"
                            href="javascript:;"
                            ><i data-feather="edit-2" class="icon-sm me-2"></i>
                            <span class="">Edit</span></a
                          >
                          <a
                            class="dropdown-item d-flex align-items-center"
                            href="javascript:;"
                            ><i data-feather="trash" class="icon-sm me-2"></i>
                            <span class="">Delete</span></a
                          >
                          <a
                            class="dropdown-item d-flex align-items-center"
                            href="javascript:;"
                            ><i data-feather="printer" class="icon-sm me-2"></i>
                            <span class="">Print</span></a
                          >
                          <a
                            class="dropdown-item d-flex align-items-center"
                            href="javascript:;"
                            ><i
                              data-feather="download"
                              class="icon-sm me-2"
                            ></i>
                            <span class="">Download</span></a
                          >
                        </div>
                      </div>
                    </div>
                    <div class="table-responsive">
                      <table class="table table-hover mb-0">
                        <thead>
                          <tr>
                            <th class="pt-0">#</th>
                            <th class="pt-0">Project Name</th>
                            <th class="pt-0">Start Date</th>
                            <th class="pt-0">Due Date</th>
                            <th class="pt-0">Status</th>
                            <th class="pt-0">Assign</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>1</td>
                            <td>NobleUI jQuery</td>
                            <td>01/01/2022</td>
                            <td>26/04/2022</td>
                            <td>
                              <span class="badge bg-danger">Released</span>
                            </td>
                            <td>Leonardo Payne</td>
                          </tr>
                          <tr>
                            <td>2</td>
                            <td>NobleUI Angular</td>
                            <td>01/01/2022</td>
                            <td>26/04/2022</td>
                            <td>
                              <span class="badge bg-success">Review</span>
                            </td>
                            <td>Carl Henson</td>
                          </tr>
                          <tr>
                            <td>3</td>
                            <td>NobleUI ReactJs</td>
                            <td>01/05/2022</td>
                            <td>10/09/2022</td>
                            <td><span class="badge bg-info">Pending</span></td>
                            <td>Jensen Combs</td>
                          </tr>
                          <tr>
                            <td>4</td>
                            <td>NobleUI VueJs</td>
                            <td>01/01/2022</td>
                            <td>31/11/2022</td>
                            <td>
                              <span class="badge bg-warning"
                                >Work in Progress</span
                              >
                            </td>
                            <td>Amiah Burton</td>
                          </tr>
                          <tr>
                            <td>5</td>
                            <td>NobleUI Laravel</td>
                            <td>01/01/2022</td>
                            <td>31/12/2022</td>
                            <td>
                              <span class="badge bg-danger">Coming soon</span>
                            </td>
                            <td>Yaretzi Mayo</td>
                          </tr>
                          <tr>
                            <td>6</td>
                            <td>NobleUI NodeJs</td>
                            <td>01/01/2022</td>
                            <td>31/12/2022</td>
                            <td>
                              <span class="badge bg-primary">Coming soon</span>
                            </td>
                            <td>Carl Henson</td>
                          </tr>
                          <tr>
                            <td class="border-bottom">3</td>
                            <td class="border-bottom">NobleUI EmberJs</td>
                            <td class="border-bottom">01/05/2022</td>
                            <td class="border-bottom">10/11/2022</td>
                            <td class="border-bottom">
                              <span class="badge bg-info">Pending</span>
                            </td>
                            <td class="border-bottom">Jensen Combs</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- row -->
          </div>

          <!-- partial:partials/_footer.html -->
          <footer
            class="footer d-flex flex-column flex-md-row align-items-center justify-content-between px-4 py-3 border-top small"
          >
            <p>
              Copyright ©
              <script>
                document.write(new Date().getFullYear());
              </script>
              <a href="https://fawe.or.ke/" target="_blank">FAWE</a>
            </p>
            <p class="text-muted">
              Handcrafted With
              <i
                class="mb-1 text-primary ms-1 icon-sm"
                data-feather="heart"
              ></i>
            </p>
          </footer>
          <!-- partial -->
        </div>
      </div>
    </div>

    <!-- core:js -->
    <script src="assets/vendors/core/core.js"></script>
    <!-- endinject -->

    <!-- Plugin js for this page -->
    <script src="assets/vendors/flatpickr/flatpickr.min.js"></script>
    <script src="assets/vendors/apexcharts/apexcharts.min.js"></script>
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


        <?php @include("includes/footer.php") ?>
</body>