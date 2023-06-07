<?php
require('../model/database.php');
require('../model/customer_db.php');
require('../model/product_db.php');
require('../model/incident_db.php');

$action = filter_input(INPUT_POST, 'action');
if ($action === NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action === NULL) {
        $action = 'display_customer_get';
    }
}


$email = '';

if ($action == 'display_customer_get'){
        include('customer_get.php');    
} 
else if ($action == 'get_customer'){
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_INT);       
    if ( empty($email) || $email == FALSE) {
        $error = "Invalid email. Please try again.";
        include ('../errors/error.php');
        exit();
    }
    
    $customer = get_customer_by_email($email);
    if ($customer === NULL) {
        $error = "Customer doesn't exist. Please try again.";
        include ('../errors/error.php');
        exit();
    }
    $products = get_products_by_customer($email);
    include ('incident_create.php');    
} 
else if ($action == 'create_incident'){
    $customer_id = filter_input(INPUT_POST, 'customer_id', FILTER_VALIDATE_INT);
    $product_code = filter_input(INPUT_POST, 'product_code');
    $title = filter_input(INPUT_POST, 'title');
    $description = filter_input(INPUT_POST, 'description');
        

        

    if ( empty($product_code) || empty($title) || empty($description) ) {
        $error = "Please complete all fields and try again.";
        include ('../errors/error.php');
    } else {
        add_incident($customer_id, $product_code, $title, $description);
        header("Location: .?action=success");
    }
} else if ($action == 'success'){
    $message = "This incident was added to our database.";
    include ('incident_create.php');
}       
?>
