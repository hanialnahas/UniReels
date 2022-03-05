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
  <nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">
    <div class="container">
      <a href="#" class="navbar-brand">UniReels</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav me-auto">
          <li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
          <li class="nav-item"><a href="searchActor.php" class="nav-link">Actors</a></li>
          <li class="nav-item"><a href="searchStudio.php" class="nav-link">Studios</a></li>
          <?php if(isset($_SESSION['loggedin']) && isset($_SESSION['admin']) && $_SESSION['admin'] == true) echo '<li class="nav-item"><a href="maintenance.php" class="nav-link active">Maintinance</a></li>'; ?>
          <li class="nav-item"><a href="imprint.php" class="nav-link">Imprint</a></li>
        </ul>
        <form action="searchTitle.php" method="GET" class="d-flex">
          <input type="text" class="form-control me-2" placeholder="Search Titles" name="searchbar">
          <input class="btn btn-primary" type="submit" value="Search">
        </form>
      </div>
    </div>
  </nav>
  <nav class="container text-light" style="padding-top: 70px">
  <?php 
    if(isset($_SESSION['loggedin']) && isset($_SESSION['admin']) && $_SESSION['admin'] == true) {
      echo '<form action="add_movie.php" method="POST" id="dataForm">
      Title: <select name="titleID">';
                      
                          $result = mysqli_query($conn, "SELECT id, mainTitle FROM title");
                          while($row = mysqli_fetch_assoc($result)) {
                              echo '<option value="' . $row['id'] .'">' . $row['id'] . " - " . $row['mainTitle'] . '</option>';
                          }
                      echo '
                  </select><br>
      Run Time: <input type="number" min="1" name="runTime"/><br>
      Box Office: <input type="number" min="1" name="boxOffice"/><br>
      <input type="submit" value="Insert">
  </form>';


      if($_SERVER['REQUEST_METHOD'] == 'POST') {
          if(isset($_POST['titleID'])) {
              $sql =  "INSERT INTO movie (titleID, runTime, boxOffice) VALUES ('". $_POST['titleID'] . "', '" . $_POST['runTime'] . "', '" . $_POST['boxOffice'] . "')";
              if(mysqli_query($conn, $sql)) {
                  echo "New record created successfully";
              } else {
                  echo "Error : " . mysqli_error($conn);
              }
          } else {
              echo "missing title";
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