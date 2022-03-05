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
      echo '<form action="add_episode.php" method="POST" id="dataForm">
      Series: <select name="seriesID">';
                      
                          $result = mysqli_query($conn, "SELECT id, mainTitle FROM series INNER JOIN title ON series.titleID = title.id");
                          while($row = mysqli_fetch_assoc($result)) {
                              echo '<option value="' . $row['id'] .'">' . $row['id'] . " - " . $row['mainTitle'] . '</option>';
                          }
                      echo '
                  </select><br>
      Episode Title: <input type="text" name="title"/><br>
      duration: <input type="number" name="duration"/><br>
      Air Date: <input type="date" name="airDate"><br>
      Episode Number: <input type="number" name="episodeNum"><br>
      Season Number: <input type="number" name="seasonNum"><br>
      <input type="submit" value="Insert">
  </form>';
      if($_SERVER['REQUEST_METHOD'] == 'POST') {
          if(isset($_POST['seriesId']) && isset($_POST['title'])) {
              $sql =  "INSERT INTO episode (seriesID, title, duration, airDate, episodeNum, seasonNum) VALUES ('". $_POST['seriesID'] . "', '" . $_POST['title'] . "', '" . $_POST['duration'] . "', '" . $_POST['airDate'] . "', '" . $_POST['episodeNum'] . "', '" . $_POST['seasonNum'] . "')";
              if(mysqli_query($conn, $sql)) {
                  echo "New record created successfully";
              } else {
                  echo "Error : " . mysqli_error($conn);
              }
          } else {
              echo "missing series or title";
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