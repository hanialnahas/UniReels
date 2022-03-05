<?php
define('HOST', ''); // Enter your database host
define('USERNAME', ''); // Enter your database username
define('PASSWORD', ''); // Enter your database password
define('DB_NAME', ''); // Enter your database name

$conn = mysqli_connect(HOST, USERNAME, PASSWORD, DB_NAME);
if(!$conn) {
  die("Error Connecting to DB");
}

function closeConnection() {
  Global $conn;
  mysqli_close($conn);
}
?>
