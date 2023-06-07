<?php
function get_technicians() {
    global $db;
    $query = 'SELECT * FROM technicians
              ORDER BY lastName';
    $statement = $db->prepare($query);
    $statement->execute();
    $technicians = $statement->fetchAll();
    $statement->closeCursor();
    return $technicians;            
}

function add_technician ($first_name, $last_name, $phone, $email, $password) {
    global $db;
    $query = 'INSERT INTO technicians
                 (firstName, lastName, phone, email, password)
              VALUES
                 (:first_name, :last_name, :phone, :email, :password)';
    $statement = $db->prepare($query);
    $statement->bindValue(':first_name', $first_name);
    $statement->bindValue(':last_name', $last_name);
    $statement->bindValue(':phone', $phone);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':password', $password);
    $statement->execute();
    $statement->closeCursor();
}

function update_technician ($id, $name, $version, $release_date) {
    global $db;
    $query = 'UPDATE technicians
                  SET name = :name,
                      version = :version,
                      listPrice = :price,
                      releaseDate = :release_date
                  WHERE technicianid = :technician_id';   
    $statement = $db->prepare($query);
    $statement->bindValue(':name', $name);
    $statement->bindValue(':version', $version);
    $statement->bindValue(':release_date', $release_date);
    $statement->bindValue(':technician_id', $id);
    $statement->execute();
    $statement->closeCursor(); 
}
function delete_technician ($technician_id) {
    global $db;
    $query = 'DELETE FROM technicians
              WHERE technicianid = :technician_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':technician_id', $technician_id);
    $statement->execute();
    $statement->closeCursor();    
}
?>