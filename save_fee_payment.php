<?php
require_once('includes/dbconnection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student_id = $_POST['student_id'];
    $fee_id = $_POST['fee_id'];
    $amount_paid = $_POST['amount_paid'];
    $entered_by_name = $_POST['entered_by_name'];
    $entered_by_user_id = $_POST['entered_by_user_id'];

    $insert_query = "INSERT INTO fee_payments (student_id, fee_id, amount_paid, entered_by_name, entered_by_user_id) 
                    VALUES ($student_id, $fee_id, $amount_paid, '$entered_by_name', $entered_by_user_id)";

    if (mysqli_query($conn, $insert_query)) {
        // Payment inserted successfully
        header('Location: fee_payment.php?success=1');
    } else {
        echo 'Error inserting payment record: ' . mysqli_error($conn);
    }

    mysqli_close($conn);
    exit();
} else {
    // Redirect to the payment form
    header('Location: index.html');
    exit();
}
?>
