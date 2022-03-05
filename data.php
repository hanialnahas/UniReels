<html>
<head>
<title>List of actors</title>
<link rel="stylesheet" href="dataStyle.css">
</head>
<body>
<?php
include_once('db_connect.php');
$sql = "SELECT id, firstName, lastName FROM person";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) > 0) {
	echo "<table>";
	echo "<tr><th>id</th><th>First Name</th><th>Last Name</th></tr>";
	while($row = mysqli_fetch_assoc($result)) {
		echo "<tr>";
		echo "<td>". $row["id"]. "</td><td>" .$row["firstName"]. "</td><td>" . $row["lastName"] . "</td>";
		echo "</tr>";
	}
	echo "</table>";
} else {
	echo "0 results";
}

closeConnection();
?>
</body>
</html>
