<?php session_start(); require_once 'db_connect.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="generalStyle.css">
  <title>Unireels</title>
</head>
<body class="generalBody">
  <?php include 'navbar.php'; displayNavbar("Titles");?>
  <nav class="container text-light" style="padding-top: 70px">
  <?php 
    if(isset($_SESSION['loggedin']) && isset($_SESSION['admin']) && $_SESSION['admin'] == true) {
      echo '<form action="addTitle.php" method="POST" id="dataForm">
      Title: <input type="text" name="mainTitle"><br>
      Release Date:  <input type="number" min="1900" max="2099" step="1" value="2021" name="releaseDate"/><br>
      IMDB Rating: <input type="number" min="0" max="10" step="0.1" value="5" name="imdb_rating"/><br>
      Budget: <input type="number" min="0" name="budget"><br>
      Age Rating: <input type="text" name="ageRating"><br>
      Short Description:<br> <textarea name="shortDescription" cols="30" rows="10" style="resize:none"></textarea><br>
      Studio: <select name="studio_id">';
                      
                          $result = mysqli_query($conn, "SELECT id, studioName FROM studio");
                          while($row = mysqli_fetch_assoc($result)) {
                              echo '<option value="' . $row['id'] .'">' . $row['id'] . " - " .  $row['studioName'] . '</option>';
                          }
                      echo '
                  </select><br>
      <input type="submit" value="Insert">
  </form>';
      if($_SERVER['REQUEST_METHOD'] == 'POST') {
          if(isset($_POST['mainTitle']) && isset($_POST['studio_id'])) {
              $sql =  "INSERT INTO title (mainTitle, releaseDate, imdb_rating, budget, ageRating, shortDescription, studio_id) VALUES ('". $_POST['mainTitle'] . "', '" . $_POST['releaseDate'] . "', '" . $_POST['imdb_rating'] . "', '" . $_POST['budget'] . "', '" . $_POST['ageRating'] . "', '" . $_POST['shortDescription'] . "', '" . $_POST['studio_id'] . "')";
              if(mysqli_query($conn, $sql)) {
       echo "New record created successfully";
              } else {
                  echo "Error : " . mysqli_error($conn);
              }
          } else {
              echo "missing title and/or studio";
          } 
      }      

      mysqli_close($conn);
    } else {
      echo "You are not an admin.";
    }
  ?>
  </nav>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>