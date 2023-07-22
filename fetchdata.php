<?php 
// Include config file 
include_once 'config.php'; 
 
// Database connection info 
$dbDetails = array( 
    'host' => DB_HOST, 
    'user' => DB_USER, 
    'pass' => DB_PASS, 
    'db'   => DB_NAME 
); 
 
// DB table to use 
$table = 'members'; 
 
// Table's primary key 
$primaryKey = 'id'; 
 
// Array of database columns which should be read and sent back to DataTables. 
// The `db` parameter represents the column name in the database.  
// The `dt` parameter represents the DataTables column identifier. 
$columns = array( 
    array( 'db' => 'first_name', 'dt' => 0 ), 
    array( 'db' => 'last_name',  'dt' => 1 ), 
    array( 'db' => 'email',      'dt' => 2 ), 
    array( 'db' => 'gender',     'dt' => 3 ), 
    array( 'db' => 'country',    'dt' => 4 ), 
    array( 
        'db'        => 'created', 
        'dt'        => 5, 
        'formatter' => function( $d, $row ) { 
            return date( 'jS M Y', strtotime($d)); 
        } 
    ), 
    array( 
        'db'        => 'status', 
        'dt'        => 6, 
        'formatter' => function( $d, $row ) { 
            return ($d == 1)?'Active':'Inactive'; 
        } 
    ), 
    array( 
        'db'        => 'id', 
        'dt'        => 7, 
        'formatter' => function( $d, $row ) { 
            return ' 
                <a href="javascript:void(0);" class="btn btn-warning" onclick="editData('.htmlspecialchars(json_encode($row), ENT_QUOTES, 'UTF-8').')">Edit</a>&nbsp; 
                <a href="javascript:void(0);" class="btn btn-danger" onclick="deleteData('.$d.')">Delete</a> 
            '; 
        } 
    ) 
); 
 
// Include SQL query processing class 
require 'ssp.class.php'; 
 
// Output data as json format 
echo json_encode( 
    SSP::simple( $_GET, $dbDetails, $table, $primaryKey, $columns ) 
);