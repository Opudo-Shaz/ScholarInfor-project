<?php require_once "includes/dbconnection.php";
session_start();
$userData = $_SESSION["userData"];
$pageTitle = "School List";
$userData = $_SESSION['userData'];
require_once 'model/Role.php';
require_once 'model/Permission.php';
require_once 'model/PrivilegedUser.php';
$u = PrivilegedUser::getByEmail($userData['email']);

if (empty($userData) || !($u->hasRole("Admin") || $u->hasRole("Editor") || $u->hasRole("User") || (!$u->hasRole("Super_admin")))) {
// If $userData is empty or user doesn't have any of the specified roles, log out the user
header('Location: userAccount.php?logoutSubmit=1');
exit();
} else if (strlen($_SESSION['sessData'] == 0)) {
header('location:logout.php');
} else {
?>

<!DOCTYPE html>

<html>

<head>

<meta charset="utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

<title></title>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.css" />
<link rel="stylesheet" type="text/css" href="assets/css/sweetalert.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style type="text/css">
#tblStudent_wrapper {
background-color: aliceblue !important;
padding: 1rem;
color: #000;
}
.error input {
border-color: red !important;
border-width: 2px !important;
}

.success input {
border-color: green !important;
border-width: 2px !important;
}

.error span {
color: red !important;
}

.success span {
color: green !important;
}

span.error {
color: red !important;
}

i {
font-weight: 900;
font-family: "Font Awesome 5 Free";
}
</style>
<!-- core:js -->

<script src="assets/js/dashboard-dark.js"></script>



<?php @include "includes/head.php"; ?>
</head>

<body>

<div class="main-wrapper">
<!-- partial:partials/_sidebar.html -->
<?php @include "includes/sidebar.php"; ?>
<!-- partial -->

<div class="page-wrapper">
<!-- partial:partials/_navbar.html -->
<?php @include "includes/header.php"; ?>
<!-- partial -->

<div class="container-fluid" style="margin-top:80px !important;">

<div class="container">

<div class="row mb-2">

<div class="col-md-9">

<h3>School List</h3>

</div>


</div>

<div class="card mb-3" id="form-body">

</div>

</div>
</div>




<?php
require "includes/dbconnection.php";
$key = 0;

$sql =
"SELECT * FROM school";

$result = mysqli_query(
$conn,
$sql
);
?>

<?php if (!empty($_SESSION["insertSchool"])) {
// Echo the success message
echo '<div class = "alert alert-success alert-dismissible fade show" role="alert">
<i data-feather="alert-circle"></i>';
echo $_SESSION["insertSchool"];
echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"></button>
</div>';
if (isset($_SESSION['insertSchool'])) {
unset($_SESSION['insertSchool']);
}
} elseif (!empty($_SESSION['insertSchoolError'])) {
// Echo the error message
echo '<div class = "alert alert-danger alert-dismissible fade show" role="alert">
<i data-feather="alert-circle"></i>';
echo $_SESSION["insertSchoolError"];
echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"></button>

</div>';
if (isset($_SESSION['insertSchoolError'])) {
unset($_SESSION['insertSchoolError']);
}
} ?>
<table id="tblStudent">

<thead>

<th>ID</th>

<th>School Name</th>
<th>County</th>

<th>Sub County</th>
<th>School Level</th>
<?php
require_once 'model/Role.php';
require_once 'model/Permission.php';
require_once 'model/PrivilegedUser.php';

$u =
$_SESSION[
'userEmail'
];
?>

<?php if (
$u->hasRole("Admin") ||
$u->hasRole("Editor")
) { ?>

<th>Action</th>
<?php } ?>




</thead>

<tbody>

<?php while (
$user = mysqli_fetch_assoc(
$result
)
) { ?>

<tr>

<td>
<?php echo ++$key; ?>
</td>

<td>
<?php echo $user[
"school_name"
]; ?>
</td>

<td>
<?php echo $user[
"county"
]; ?>
</td>


<td>
<?php echo $user[
"sub_county"
]; ?>
</td>
<td>
<?php echo $user[
"school_level"
]; ?>


</td>
<?php if (
$u->hasRole(
"Admin"
) ||
$u->hasRole(
"Editor"
)
): ?>
<td>
<?php if (
$u->hasRole(
"Editor"
) ||
$u->hasRole(
"Admin"
)
): ?>

<a href="update_school_form.php?id=<?php echo $user[
"id"
]; ?>"
class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o"></i></a><?php endif; ?>

<?php if (
$u->hasRole(
"Admin"
)
): ?>
<a href="delete_school_data.php?id=<?php echo $user[
"id"
]; ?>" class="btn btn-danger btn-sm"
onclick="return confirm('Are you sure you want to delete this school?');">
<i class="fa fa-trash"></i>
</a>
<?php endif; ?>

</td>
<?php endif; ?>


</tr>

<?php } ?>

</tbody>

</table>


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
<!-- End plugin js for this page -->

<!-- inject:js -->
<script src="assets/vendors/feather-icons/feather.min.js"></script>
<script src="assets/js/template.js"></script>
<!-- endinject -->

<!-- Custom js for this page -->
<script src="assets/js/dashboard-dark.js"></script>
<!-- End custom js for this page -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"></script>
<script src="assets/js/sweetalert2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
<script>

$(document).ready(function () {
$('#tblStudent').DataTable({
dom: 'Bfrtip',
buttons: [
'copy', 'csv', 'excel', 'pdf', 'print'
]
});

$("#form-body").hide();

$("#insert-btn").on('click', function () {
$("#form-body").toggle(500);
});

function validateForm() {
var isValid = true;

function validateField(inputElement, errorElement, errorMessage) {
var inputValue = inputElement.val().trim();
if (inputValue === "") {
isValid = false;
inputElement.addClass("is-invalid");
errorElement.html(errorMessage);
} else {
inputElement.removeClass("is-invalid");
errorElement.html("");
}
}

validateField($('#schoolName'), $("#schoolName_err"), 'School name is required');


var schoolLevel = $("input[name='school_level']:checked").val();
if (!schoolLevel) {
isValid = false;
$("#schoolLevel_err").html("Pliz select a schoolLevel.");
} else {
$("#schoolLevel_err").html("");
}
var countyName = $("#cnty").val();
if (countyName === null || countyName === "") {
isValid = false;
$("#countyName_err").html('County name is required');
} else {
$("#countyName_err").html("");
}
var subCountyName = $("#sub_cnty").val();
if (subCountyName === null || subCountyName === "") {
isValid = false;
$("#subCountyName_err").html('Sub County name is required');
} else {
$("#subCountyName_errr").html("");
}
return isValid;
}

$("#form-body").on('submit', function (e) {
e.preventDefault();

var isValid = validateForm();

if (isValid) {
var schoolName = $("input[name='school_name']").val();
var county = $("#cnty").val();
var subCounty = $("#sub_cnty").val();
var schoolLevel = $("input[name='school_level']:checked").val();


$.ajax({
url: "insert_school_data.php",
type: "POST",
data: {
school_name: schoolName,
county: county,
sub_county: subCounty,
school_level: schoolLevel,
},
success: function (data) {
alert("Data Inserted Successfully");

$("#form-body").hide();

location.reload();
},

error: function (xhr, status, error) {
alert('Error: ' + error);
}
});
}
});

// Clear validation styles when input fields change
$(".form-validation").on("input", function () {
$(this).removeClass("is-invalid");
$(this).siblings(".error-message").html('');
});




});
</script>
<script>
// Client-side validation
document.getElementById('schoolForm').addEventListener('submit', function (event) {
var valid = true;
var schoolName = document.getElementsByName('school_name')[0].value.trim();
var county = document.getElementsByName('county')[0].value;
var subCounty = document.getElementsByName('sub_county')[0].value;
var schoolLevel = document.querySelector('input[name="school_level"]:checked');

// Clear previous error messages
var errorDivs = document.getElementsByClassName('error');
for (var i = 0; i < errorDivs.length; i++) {
errorDivs[i].innerHTML = '';
}

if (schoolName === '') {
document.getElementById('schoolNameError').innerHTML = 'School Name is required.';
valid = false;
}

if (county === 'County' || county === '') {
document.getElementById('countyError').innerHTML = 'County is required.';
valid = false;
}

if (subCounty === '' || subCounty === 'Select County First') {
document.getElementById('subCountyError').innerHTML = 'Sub County is required.';
valid = false;
}

if (!schoolLevel) {
document.getElementById('schoolLevelError').innerHTML = 'Please select School Level.';
valid = false;
}

if (!valid) {
event.preventDefault();
}
});
var inputFields = document.querySelectorAll('input, select');
for (var i = 0; i < inputFields.length; i++) {
inputFields[i].addEventListener('change', function () {
var fieldName = this.getAttribute('name');
var errorDiv = document.getElementById(fieldName + 'Error');
if (errorDiv) {
errorDiv.innerHTML = '';
}
});
}
document.getElementsByName('county')[0].addEventListener('change', function () {
document.getElementById('subCountyError').innerHTML = '';
});

// Event listener to clear School Level error when radio buttons change
var schoolLevelRadios = document.querySelectorAll('input[name="school_level"]');
for (var i = 0; i < schoolLevelRadios.length; i++) {
schoolLevelRadios[i].addEventListener('change', function () {
document.getElementById('schoolLevelError').innerHTML = '';
});
}
</script>



</body>

</html>
<?php
}
?>
