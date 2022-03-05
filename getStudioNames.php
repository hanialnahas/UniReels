<?php 
    include 'db_connect.php';
    $studioNames = array();
    $query = 'SELECT * FROM studio';
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
          array_push($studioNames, $row['studioName']);
        }
    }

    echo json_encode($studioNames);
?>