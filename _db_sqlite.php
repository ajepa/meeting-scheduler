<?php

$db_exists = file_exists("daypilot.sqlite");

$db = new PDO('sqlite:daypilot.sqlite');

if (!$db_exists) {
    //create the database
    $db->exec("CREATE TABLE IF NOT EXISTS rooms (
                        id INTEGER PRIMARY KEY, 
                        name TEXT, 
                        capacity INTEGER,
                        status VARCHAR(30))");

    $db->exec("CREATE TABLE IF NOT EXISTS reservations (
                        id INTEGER PRIMARY KEY, 
                        name TEXT, 
                        start DATETIME, 
                        end DATETIME,
                        room_id INTEGER,
                        status VARCHAR(30),
                        paid INTEGER)");

    $rooms = array(
                    array('name' => 'Meeting Room',
                        'id' => 7,
                        'capacity' => 50,
                        'status' => 'Ready'),
                    array('name' => 'Teleconferences Room',
                        'id' => 8,
                        'capacity' => 25,
                        'status' => "Ready"),
                    array('name' => 'Innovate Room',
                        'id' => 9,
                        'capacity' => 10,
                        'status' => "Ready"),
        );

    $insert = "INSERT INTO rooms (id, name, capacity, status) VALUES (:id, :name, :capacity, :status)";
    $stmt = $db->prepare($insert);
 
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':capacity', $capacity);
    $stmt->bindParam(':status', $status);
 
    foreach ($rooms as $r) {
      $id = $r['id'];
      $name = $r['name'];
      $capacity = $r['capacity'];
      $status = $r['status'];
      $stmt->execute();
    }
    
}
?>