<?php
session_start();


$pageTitle = "Dashboard";
?>

<body>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <meta name="description" content="Forum For African Women Educationalists" />
        <meta name="author" content="OSLABS" />
        <meta name="keywords" content="FAWE, Forum For African Women Educationalists, FAWE Kenya" />

        <title>FAWE -Dashboard</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap"
            rel="stylesheet" />
        <!-- End fonts -->

        <!-- core:css -->
        <link rel="stylesheet" href="assets/vendors/core/core.css" />
        <!-- endinject -->

        <!-- Plugin css for this page -->
        <link rel="stylesheet" href="assets/vendors/flatpickr/flatpickr.min.css" />
        <!-- End plugin css for this page -->

        <!-- inject:css -->
        <link rel="stylesheet" href="assets/fonts/feather-font/css/iconfont.css" />

        <!-- endinject -->

        <!-- Layout styles -->
        <link rel="stylesheet" href="assets/css/style.css" />
        <!-- End layout styles -->

        <link rel="shortcut icon" href="assets/images/favicon.jpg" />

        <!-- ... Existing HTML code ... -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css"
            integrity="sha256-mmgLkCYLUQbXn0B1SRqzHar6dCnv9oZFPEC1g1cwlkk=" crossorigin="anonymous" />
        <style type="text/css">
            /* Your styles for the toggle switch */
            .switch {
                position: relative;
                display: inline-block;
                width: 50px;
                height: 34px;
            }

            .slider {
                position: absolute;
                cursor: pointer;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background-color: #ccc;
                transition: 0.4s;
                border-radius: 34px;
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding: 2px;
            }

            /* Style for the moon icon */
            .slider i:nth-child(2) {
                color: #f1c40f;
            }

            /* Style for the sun icon */
            .slider i:nth-child(1) {
                color: #f39c12;
                transform: translateX(0);
                transition: transform 0.4s;

            }

            /* Move the sun icon to the right for dark mode */
            #modeToggle:checked+.slider i:nth-child(1) {
                transform: translateX(26px);
            }
        </style>
        <style type="text/css">
            .card {
                background-color: #fff;
                border-radius: 10px;
                border: none;
                position: relative;
                margin-bottom: 30px;
                box-shadow: 0 0.46875rem 2.1875rem rgba(90, 97, 105, 0.1), 0 0.9375rem 1.40625rem rgba(90, 97, 105, 0.1), 0 0.25rem 0.53125rem rgba(90, 97, 105, 0.12), 0 0.125rem 0.1875rem rgba(90, 97, 105, 0.1);
            }

            .l-bg-cherry {
                background: linear-gradient(to right, #493240, #f09) !important;
                color: #fff;
            }

            .l-bg-blue-dark {
                background: linear-gradient(to right, #373b44, #4286f4) !important;
                color: #fff;
            }

            .l-bg-green-dark {
                background: linear-gradient(to right, #0a504a, #38ef7d) !important;
                color: #fff;
            }

            .l-bg-orange-dark {
                background: linear-gradient(to right, #a86008, #ffba56) !important;
                color: #fff;
            }

            .card .card-statistic-3 .card-icon-large .fas,
            .card .card-statistic-3 .card-icon-large .far,
            .card .card-statistic-3 .card-icon-large .fab,
            .card .card-statistic-3 .card-icon-large .fal {
                font-size: 110px;
            }

            .card .card-statistic-3 .card-icon {
                text-align: center;
                line-height: 50px;
                margin-left: 15px;
                color: #000;
                position: absolute;
                right: -5px;
                top: 20px;
                opacity: 0.1;
            }

            .l-bg-cyan {
                background: linear-gradient(135deg, #289cf5, #84c0ec) !important;
                color: #fff;
            }

            .l-bg-green {
                background: linear-gradient(135deg, #23bdb8 0%, #43e794 100%) !important;
                color: #fff;
            }

            .l-bg-orange {
                background: linear-gradient(to right, #f9900e, #ffba56) !important;
                color: #fff;
            }

            .l-bg-cyan {
                background: linear-gradient(135deg, #289cf5, #84c0ec) !important;
                color: #fff;
            }

            body {
                font-family: Arial, sans-serif;
                background-color: #f9f9f9;
            }

            h1 {
                text-align: center;
                margin: 20px 0;
            }

            .dashboard {
                display: grid;
                grid-template-rows: repeat(1, 1fr);
                gap: 20px;
                padding: 50px;
            }

            .chart-container {
                padding: 1rem;
                border: 2px solid #ccc;
                border-radius: 20px;
                background-color: #f9f9f9;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            }
        </style>
        <?php
        @include("includes/head.php"); ?>

    </head>

    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3 col-lg-3 col-xl-3">

                    <!-- partial:partials/_sidebar.html -->
                    <?php @include "includes/sidebar.php" ?>
                    <!-- partial -->
                </div>
                <div class="col-md-9 col-lg-9 col-xl-9">
                    <div class="page-wrapper">
                        <!-- partial:partials/_navbar.html -->
                        <?php @include "includes/header.php" ?>
                        <!-- partial -->
                        <?php
                        include_once "includes/dbconnection.php";

                        // Function to fetch data from the database
                        function fetchDataFromDatabase($conn, $query)
                        {
                            $result = mysqli_query($conn, $query);
                            $data = mysqli_fetch_assoc($result);
                            return $data;
                        }

                        // Example: Fetch data for Ongoing Students card
                        $querystudentOngoing = "SELECT COUNT(*) AS id_count FROM student WHERE student_status = 'ongoing'";
                        $studentDataOngoing = fetchDataFromDatabase($conn, $querystudentOngoing);

                        // Example: Fetch data for Schools card
                        $queryschool = "SELECT COUNT(*) AS school_name_count FROM school WHERE school_level ='Secondary'";
                        $schoolData = fetchDataFromDatabase($conn, $queryschool);

                        // Example: Fetch data for Number of Students card
                        $querystudentAll = "SELECT COUNT(*) AS id_count FROM student";
                        $studentDataAll = fetchDataFromDatabase($conn, $querystudentAll);

                        $querystudentdropout = "SELECT COUNT(*) AS id_count FROM student WHERE student_status = 'dropout'";
                        $studentDataDropout = fetchDataFromDatabase($conn, $querystudentdropout);


                        ?>
                        <div class="page-content ">
                            <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
                                <div>
                                    <h4 class="mb-3 mb-md-0">Welcome to Dashboard</h4>
                                </div>
                            </div>

                            <div class="col-md-10">
                                <div class="row d-flex justify-content-between mt-5">
                                    <!-- Ongoing Students card -->
                                    <div class="col-xl-3 col-lg-6">
                                        <div class="card l-bg-cherry">
                                            <div class="card-statistic-3 p-4">
                                                <div class="card-icon card-icon-large"><i
                                                        class="fas fa-user-graduate"></i></div>
                                                <div class="mb-4">
                                                    <h5 class="card-title mb-0">Ongoing Students</h5>
                                                </div>


                                                <div class="row align-items-center mb-2 d-flex">
                                                    <div class="col-8">
                                                        <h2 class="d-flex align-items-center mb-0">
                                                            <?php echo $studentDataOngoing['id_count']; ?>
                                                        </h2>
                                                    </div>
                                                </div>


                                            </div>

                                        </div>

                                    </div>

                                    <!-- End Ongoing Students card -->

                                    <!-- Schools card -->
                                    <div class="col-xl-3 col-lg-6">
                                        <div class="card l-bg-blue-dark">
                                            <div class="card-statistic-3 p-4">
                                                <div class="card-icon card-icon-large"><i class="fas fa-school"></i>
                                                </div>
                                                <div class="mb-4">
                                                    <h5 class="card-title mb-0">Number of Schools</h5>
                                                </div>
                                                <div class="row align-items-center mb-2 d-flex">
                                                    <div class="col-8">
                                                        <h2 class="d-flex align-items-center mb-0">
                                                            <?php echo $schoolData['school_name_count']; ?>
                                                        </h2>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="mt-3 p-2 justify-content-center d-flex"
                                                style="background: wheat; opacity: 0.8; ">
                                                <a href="school.php" class="small-box-footer" style="color: #000">More
                                                    info <i class=" ms-2 fas fa-arrow-circle-right"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Schools card -->

                                    <!-- Number of Students card -->
                                    <div class="col-xl-3 col-lg-6">
                                        <div class="card l-bg-green-dark">
                                            <div class="card-statistic-3 p-4">
                                                <div class="card-icon card-icon-large"><i class="fas fa-graduation-cap"
                                                        aria-hidden="true"></i></div>
                                                <div class="mb-4">
                                                    <h5 class="card-title mb-0">Number of students</h5>
                                                </div>
                                                <div class="row align-items-center mb-2 d-flex">
                                                    <div class="col-8">
                                                        <h2 class="d-flex align-items-center mb-0">
                                                            <?php echo $studentDataAll['id_count']; ?>
                                                        </h2>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="mt-3 p-2 justify-content-center d-flex"
                                                style="background: wheat; opacity: 0.8; ">
                                                <a href="student_list.php" class="small-box-footer"
                                                    style="color: #000">More info <i
                                                        class=" ms-2 fas fa-arrow-circle-right"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Number of Students card -->

                                    <div class="col-xl-3 col-lg-6">
                                        <div class="card l-bg-orange">
                                            <div class="card-statistic-3 p-4">
                                                <div class="card-icon card-icon-large"><i
                                                        class="fas fa-user-graduate"></i>
                                                </div>
                                                <div class="mb-4">
                                                    <h5 class="card-title mb-0">Dropout Students</h5>
                                                </div>
                                                <div class="row align-items-center mb-2 d-flex">
                                                    <div class="col-8">
                                                        <h2 class="d-flex align-items-center mb-0">
                                                            <?php echo $studentDataDropout['id_count']; ?>
                                                        </h2>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                    </div>

                                    <div class="dashboard">
                                        <!-- Bar graph for the number of students per school -->
                                        <div class="chart-container col-xl-auto col-lg-6">
                                            <canvas id="studentChart"></canvas>
                                            <p class="h4 text-center mt-3" style="color: #000">Total Number of Students
                                                per School</p>
                                        </div>

                                        <!-- Bar graph for the number of dropouts per school -->
                                        <div class="chart-container col-xl-auto col-lg-6">
                                            <canvas id="dropoutChart"></canvas>
                                            <p class="h4 text-center mt-3" style="color: #000">Number of Dropouts per
                                                School</p>
                                        </div>

                                        <!-- Bar graph for the number of schools in a sub-county -->
                                        <div class="chart-container col-xl-auto col-lg-6">
                                            <canvas id="schoolChart"></canvas>
                                            <p class="h4 text-center mt-3" style="color: #000">Number of Students in a
                                                School per
                                                Subcounty</p>
                                        </div>

                                        <!-- Bar graph for the number of ongoing students per school -->
                                        <div class="chart-container col-xl-auto col-lg-6">
                                            <canvas id="ongoingChart"></canvas>
                                            <p class="h4 text-center mt-3" style="color: #000">Ongoing Students per
                                                School</p>
                                        </div>

                                        <!-- Pie chart for the percentage of dropouts and ongoing students per school -->
                                        <div class="chart-container col-xl-auto col-lg-6">
                                            <canvas id="percentageChart"></canvas>
                                            <p class="h4 text-center mt-3" style="color: #000">Percentage of Dropout and
                                                Ongoing Students per School</p>
                                        </div>
                                    </div>

                                    <style>
                                        .dashboard {
                                            width: 100%;
                                            margin: 0 auto;
                                        }


                                        .chart-container {
                                            width: 100%;
                                            margin: 0 auto;
                                        }

                                        @media (max-width: 768px) {
                                            .dashboard {
                                                width: 90%;
                                            }

                                            .chart-container {
                                                width: 100%;
                                                max-width: 500px;
                                                min-height: 200px;
                                            }
                                        }
                                    </style>



                                    <?php

                                    // Query to get the count of students for each school
                                    $queryStudents = "SELECT school_name, COUNT(*) as student_count FROM student GROUP BY school_name";
                                    $resultStudents = $conn->query($queryStudents);

                                    // Prepare data for the bar graph (Number of Students per School)
                                    $dataStudents = [];
                                    while ($row = $resultStudents->fetch_assoc()) {
                                        $dataStudents[$row["school_name"]] = $row["student_count"];
                                    }

                                    // Query to get the count of dropouts per school
                                    $queryDropouts = "SELECT school_name, COUNT(*) as dropout_count FROM student WHERE student_status = 'dropout' GROUP BY school_name";
                                    $resultDropouts = $conn->query($queryDropouts);

                                    // Prepare data for the bar graph (Number of Dropouts per School)
                                    $dataDropouts = [];
                                    while ($row = $resultDropouts->fetch_assoc()) {


                                        $dataDropouts[$row["school_name"]] = $row["dropout_count"];

                                    }
                                    // Query to get the count of ongoing students per school
                                    $queryOngoing = "SELECT school_name, COUNT(*) as ongoing_count FROM student WHERE student_status = 'ongoing' GROUP BY school_name";
                                    $resultOngoing = $conn->query($queryOngoing);

                                    $dataOngoing = [];
                                    while ($row2 = $resultOngoing->fetch_assoc()) {
                                        $dataOngoing[$row2["school_name"]] = $row2["ongoing_count"];
                                    }


                                    $querySchoolsSubCounty = "SELECT sc.county, sc.sub_county, COUNT(DISTINCT sc.school_name) as school_count FROM school as sc JOIN student as s ON sc.school_name = s.school_name GROUP BY sc.county, sc.sub_county;";
                                    $resultSchoolsSubCounty = $conn->query($querySchoolsSubCounty);
                                    $dataSchoolsSubCounty = [];

                                    while ($row = $resultSchoolsSubCounty->fetch_assoc()) {
                                        $subCountyKey = $row["county"] . ' - ' . $row["sub_county"];
                                        $dataSchoolsSubCounty[$subCountyKey] = $row["school_count"];
                                    }


                                    // Calculate the total number of students for each school
                                    $totalCounts = [];
                                    foreach ($dataOngoing as $school => $ongoingCount) {
                                        $dropoutCount = isset($dataDropouts[$school]) ? $dataDropouts[$school] : 0;
                                        $totalCounts[$school] = $dropoutCount + $ongoingCount;
                                    }
                                    foreach ($dataDropouts as $school => $dropoutCount) {
                                        $ongoingCount = isset($dataOngoing[$school]) ? $dataOngoing[$school] : 0;
                                        $totalCounts[$school] = $dropoutCount + $ongoingCount;
                                    }

                                    // Calculate the percentage of ongoing students and dropouts for each school
                                    $percentageData = [];
                                    foreach ($totalCounts as $school => $totalCount) {
                                        // Check if the school exists in both $dataDropouts and $dataOngoing arrays
                                        if (isset($dataOngoing[$school]) && isset($dataDropouts[$school])) {
                                            $dropoutPercentage = ($dataDropouts[$school] / $totalCount) * 100;
                                            $ongoingPercentage = ($dataOngoing[$school] / $totalCount) * 100;

                                            $percentageData[$school] = [
                                                'dropout_percentage' => $dropoutPercentage,
                                                'ongoing_percentage' => $ongoingPercentage
                                            ];
                                        } elseif (isset($dataOngoing[$school])) {
                                            // Handle the case where the school exists in $dataOngoing but not in $dataDropouts
                                            // You might want to set a default value or skip the calculation
                                            $dataDropouts[$school] = 0;
                                            $dropoutPercentage = ($dataDropouts[$school] / $totalCount) * 100;
                                            $ongoingPercentage = ($dataOngoing[$school] / $totalCount) * 100;

                                            if ($totalCount == 0) {
                                                $dropoutPercentage = 100;
                                                $ongoingPercentage = 0;
                                            }

                                            $percentageData[$school] = [
                                                'dropout_percentage' => $dropoutPercentage,
                                                'ongoing_percentage' => $ongoingPercentage
                                            ];
                                        } elseif (isset($dataDropouts[$school])) {
                                            // Handle the case where the school doesn't exist in either $dataOngoing or $dataDropouts
                                            // You might want to set a default value or skip the calculation
                                            $dataOngoing[$school] = 0;

                                            $dropoutPercentage = ($dataDropouts[$school] / $totalCount) * 100;
                                            $ongoingPercentage = ($dataOngoing[$school] / $totalCount) * 100;

                                            if ($totalCount == 0) {
                                                $dropoutPercentage = 100;
                                                $ongoingPercentage = 0;
                                            }

                                            $percentageData[$school] = [
                                                'dropout_percentage' => $dropoutPercentage,
                                                'ongoing_percentage' => $ongoingPercentage
                                            ];
                                        } else {
                                            // Handle the case where the school doesn't exist in either $dataOngoing or $dataDropouts
                                            // You might want to set a default value or skip the calculation
                                            $dataOngoing[$school] = 0;
                                            $dataDropouts[$school] = 0;
                                            $dropoutPercentage = ($dataDropouts[$school] / $totalCount) * 100;
                                            $ongoingPercentage = ($dataOngoing[$school] / $totalCount) * 100;

                                            if ($totalCount == 0) {
                                                $dropoutPercentage = 100;
                                                $ongoingPercentage = 0;
                                            }

                                            $percentageData[$school] = [
                                                'dropout_percentage' => $dropoutPercentage,
                                                'ongoing_percentage' => $ongoingPercentage
                                            ];
                                        }

                                    }
                                    foreach ($percentageData as $school => $percentages) {
                                        $dropoutPercentage = $percentages['dropout_percentage'];
                                        $ongoingPercentage = $percentages['ongoing_percentage'];

                                        echo "School: $school <br>";
                                        echo "Dropout Percentage: $dropoutPercentage% <br>";
                                        echo "Ongoing Percentage: $ongoingPercentage% <br>";
                                        echo "<br>"; // Add appropriate HTML structure based on your use case
                                    }
                                    // Close the connection
                                    $conn->close();

                                    ?>



                                </div>

                            </div>
                        </div>
                        <!-- row -->


                        <!-- partial:partials/_footer.html -->
                        <footer
                            class="footer d-flex flex-column flex-md-row align-items-center justify-content-between px-4 py-3 border-top small">
                            <p>
                                Copyright ©
                                <script>
                                    document.write(new Date().getFullYear());
                                </script>
                                <a href="https://fawe.or.ke/" target="_blank">FAWE</a>
                            </p>
                            <p class="text-muted">
                                Handcrafted With
                                <i class="mb-1 text-primary ms-1 icon-sm" data-feather="heart"></i>
                            </p>
                        </footer>
                        <!-- partial -->
                    </div>
                </div>
            </div>
        </div>
        <script>
            // JavaScript for the charts
            // Get data from PHP and convert it to JavaScript object
            var dataFromPHP = <?php echo json_encode($dataStudents); ?>;
            var dataDropoutsFromPHP = <?php echo json_encode($dataDropouts); ?>;
            var dataOngoingFromPHP = <?php echo json_encode($dataOngoing); ?>;
            var dataSchoolsSubCountyFromPHP = <?php echo json_encode($dataSchoolsSubCounty); ?>;
            var percentageDataFromPHP = <?php echo json_encode($percentageData); ?>;

            // Extract school names and student counts from the data
            var schoolNames = Object.keys(dataFromPHP);
            var studentCounts = Object.values(dataFromPHP);


            // Create the bar graph for the number of students per school using Chart.js
            var ctxStudent = document.getElementById('studentChart').getContext('2d');
            var colorArray = [
                'rgba(75, 192, 192, 0.2)', // Color for School 1
                'rgba(255, 99, 132, 0.2)', // Color for School 2
                'rgba(255, 205, 86, 0.2)', // Color for School 3
                'rgba(13, 255, 20, 0.8)',
                // Add more colors as needed
            ];

            var studentChart = new Chart(ctxStudent, {
                type: 'bar',
                data: {
                    labels: schoolNames,
                    datasets: [{
                        label: 'Number of Students',
                        data: studentCounts,
                        backgroundColor: colorArray,
                        borderColor: colorArray.map(color => color.replace('0.0', '1')), // Use the same colors with full opacity
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
            var schoolNamesPer = Object.keys(percentageDataFromPHP);
            var dropoutPercentages = [];
            var ongoingPercentages = [];

            schoolNamesPer.forEach(function (schoolName) {
                var schoolData = percentageDataFromPHP[schoolName];
                dropoutPercentages.push(schoolData.dropout_percentage);
                ongoingPercentages.push(schoolData.ongoing_percentage);
            });
            // Create the pie chart for the percentage of dropouts and ongoing students per school using Chart.js
            var ctxPercentage = document.getElementById('percentageChart').getContext('2d');
            var percentageChart = new Chart(ctxPercentage, {
                type: 'bar', // Change type to 'pie'
                data: {
                    labels: schoolNamesPer,
                    datasets: [{
                        label: 'dropout',
                        data: dropoutPercentages, // Use dropoutPercentages for the pie chart data
                        backgroundColor: 'rgba(255, 99, 132, 0.2)', // Change to red color for dropout
                        borderColor: 'rgba(255, 99, 132, 1)', // Change to red color for dropout
                        borderWidth: 1
                    },
                    {
                        label: 'Ongoing',
                        data: ongoingPercentages, // Use ongoingPercentages for the pie chart data
                        backgroundColor: 'rgba(144, 238, 144, 0.2)', // Change to light green color for ongoing
                        borderColor: 'rgba(144, 238, 144, 1)', // Change to light green color for ongoing
                        borderWidth: 1
                    }]
                },
            });

        </script>
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
    <script>

    </script>

    </html>