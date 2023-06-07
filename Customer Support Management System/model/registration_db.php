<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

function add_registration($customer_id, $product_code) {
    global $db;
    $date = date('Y-m-d');
    $query = 'INSERT INTO registrations VALUES
                 (:customer_id, :product_code, :date)';
    $statement = $db->prepare($query);
    $statement->bindValue(':customer_id', $customer_id);
    $statement->bindValue(':product_code', $product_code);
    $statement->bindValue(':date', $date);
    $statement->execute();
    $statement->closeCursor();
}
function get_registration($customer_id, $product_code) {
    global $db;
    $query = 'SELECT * FROM registrations
              WHERE customerID = :customer_id
              AND productCode = product_code';
    $statement = $db->prepare($query);
    $statement->bindValue(':customer_id', $customer_id);
    $statement->bindValue(':product_code', $product_code);   
    $statement->execute();
    $registration = $statement->fetchAll();
    $statement->closeCursor();
    
    if ($registration === FALSE) {
        return NULL;
    } else {
        return $registration;
    }
}
?>