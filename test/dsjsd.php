
<?php

$queryStudents = "SELECT school_name, COUNT(*) as student_count FROM student GROUP BY school_name";
$resultStudents = $conn->query($queryStudents);

$dataStudents = [];
while ($row = $resultStudents->fetch_assoc()) {
    $dataStudents[$row["school_name"]] = $row["student_count"];
}

$queryDropouts = "SELECT school_name, COUNT(*) as dropout_count FROM student WHERE student_status = 'dropout' GROUP BY school_name";
$resultDropouts = $conn->query($queryDropouts);

$dataDropouts = [];
while ($row = $resultDropouts->fetch_assoc()) {
    $dataDropouts[$row["school_name"]] = $row["dropout_count"];
}

$queryOngoing = "SELECT s.school_name, COUNT(*) as ongoing_count FROM student s JOIN school sc ON s.school_name = sc.school_name WHERE s.student_status = 'ongoing' GROUP BY s.school_name;";
$resultOngoing = $conn->query($queryOngoing);

$dataOngoing = [];
while ($row = $resultOngoing->fetch_assoc()) {
    $dataOngoing[$row["school_name"]] = $row["ongoing_count"];
}

$querySchoolsSubCounty = "SELECT sc.county, sc.sub_county, COUNT(sc.school_name) as school_count
FROM school as sc
GROUP BY sc.sub_county;
";
$resultSchoolsSubCounty = $conn->query($querySchoolsSubCounty);
$dataSchoolsSubCounty = [];

while ($row = $resultSchoolsSubCounty->fetch_assoc()) {
    $subCountyKey = $row["county"] . ' - ' . $row["sub_county"];
    $dataSchoolsSubCounty[$subCountyKey] = $row["school_count"];
}

$totalCounts = [];
foreach ($dataDropouts as $school => $dropoutCount) {
    if (isset($dataOngoing[$school])) {
        $totalCounts[$school] = $dropoutCount + $dataOngoing[$school];
    } else {
        $dataOngoing[$school] = 0;
        $totalCounts[$school] = $dropoutCount + $dataOngoing[$school];
    }
}

$percentageData = [];
foreach ($totalCounts as $school => $totalCount) {
    if (isset($dataOngoing[$school]) && isset($dataDropouts[$school])) {
        if ($totalCount == 0) {
            continue;
        }
        $dropoutPercentage = ($dataDropouts[$school] / $totalCount) * 100;
        $ongoingPercentage = ($dataOngoing[$school] / $totalCount) * 100;
        if ($dropoutPercentage == 0 && $ongoingPercentage != 0) {
            $ongoingPercentage = 100;
        }
        $percentageData[$school] = [
            'dropout_percentage' => round($dropoutPercentage, 2),
            'ongoing_percentage' => round($ongoingPercentage, 2)
        ];
    } elseif (isset($dataOngoing[$school])) {
        if ($totalCount == 0) {
            continue;
        }
        $dropoutPercentage = 0;
        $ongoingPercentage = ($dataOngoing[$school] / $totalCount) * 100;
        if ($dropoutPercentage == 0 && $ongoingPercentage != 0) {
            $ongoingPercentage = 100;
        }
        $percentageData[$school] = [
            'dropout_percentage' => round($dropoutPercentage, 2),
            'ongoing_percentage' => round($ongoingPercentage, 2)
        ];
    }
}
$conn->close();
?>