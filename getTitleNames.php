<?php 
    include 'db_connect.php';
    $titleNames = array();
    $query = 'SELECT * FROM title';
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
          array_push($titleNames, $row['mainTitle']);
        }
    }

    echo json_encode($titleNames);
?>