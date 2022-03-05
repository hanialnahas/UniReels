<?php 
    include 'db_connect.php';
    $actorNames = array();
    $query = "SELECT CONCAT(`firstName`, ' ', `lastName`) as name FROM person";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
          array_push($actorNames, $row['name'] );
        }
    }

    echo json_encode($actorNames);
?>