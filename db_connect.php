<?php
define('HOST', 'localhost');
define('USERNAME', 'root');
define('PASSWORD', '');
define('DB_NAME', 'unireels_test');

$conn = mysqli_connect(HOST, USERNAME, PASSWORD, DB_NAME);
if(!$conn) {
  die("Error Connecting to DB");
}

function closeConnection() {
  Global $conn;
  mysqli_close($conn);
}
?>
