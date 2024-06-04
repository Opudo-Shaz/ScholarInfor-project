<?php
// Include database configuration file  
require_once 'dbConnect.php';

// Retrieve JSON from POST body 
$jsonStr = file_get_contents('php://input');
$jsonObj = json_decode($jsonStr);

if ($jsonObj->request_type == 'addEditUser') {
    $user_data = $jsonObj->user_data;
    $first_name = !empty($user_data[0]) ? $user_data[0] : '';
    $last_name = !empty($user_data[1]) ? $user_data[1] : '';
    $email = !empty($user_data[2]) ? $user_data[2] : '';
    $gender = !empty($user_data[3]) ? $user_data[3] : '';
    $country = !empty($user_data[4]) ? $user_data[4] : '';
    $status = !empty($user_data[5]) ? $user_data[5] : 0;
    $id = !empty($user_data[6]) ? $user_data[6] : 0;

    $err = '';
    if (empty($first_name)) {
        $err .= 'Please enter your First Name.<br/>';
    }
    if (empty($last_name)) {
        $err .= 'Please enter your Last Name.<br/>';
    }
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $err .= 'Please enter a valid Email Address.<br/>';
    }

    if (!empty($user_data) && empty($err)) {
        if (!empty($id)) {
            // Update user data into the database 
            $sqlQ = "UPDATE members SET first_name=?,last_name=?,email=?,gender=?,country=?,status=?,modified=NOW() WHERE id=?";
            $stmt = $conn->prepare($sqlQ);
            $stmt->bind_param("sssssii", $first_name, $last_name, $email, $gender, $country, $status, $id);
            $update = $stmt->execute();

            if ($update) {
                $output = [
                    'status' => 1,
                    'msg' => 'Member updated successfully!'
                ];
                echo json_encode($output);
            } else {
                echo json_encode(['error' => 'Member Update request failed!']);
            }
        } else {
            // Insert event data into the database 
            $sqlQ = "INSERT INTO members (first_name,last_name,email,gender,country,status) VALUES (?,?,?,?,?,?)";
            $stmt = $conn->prepare($sqlQ);
            $stmt->bind_param("sssssi", $first_name, $last_name, $email, $gender, $country, $status);
            $insert = $stmt->execute();

            if ($insert) {
                $output = [
                    'status' => 1,
                    'msg' => 'Member added successfully!'
                ];
                echo json_encode($output);
            } else {
                echo json_encode(['error' => 'Member Add request failed!']);
            }
        }
    } else {
        echo json_encode(['error' => trim($err, '<br/>')]);
    }
} elseif ($jsonObj->request_type == 'deleteUser') {
    $id = $jsonObj->user_id;

    $sql = "DELETE FROM members WHERE id=$id";
    $delete = $conn->query($sql);
    if ($delete) {
        $output = [
            'status' => 1,
            'msg' => 'Member deleted successfully!'
        ];
        echo json_encode($output);
    } else {
        echo json_encode(['error' => 'Member Delete request failed!']);
    }
}