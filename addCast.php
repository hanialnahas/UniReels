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
      echo '<form action="addCast.php" method="POST" id="dataForm">
      First Name: <input type="text" name="firstName"><br>
      Last Name:  <input type="text" name="lastName"><br>
      Gender: <input type="text" name="gender" maxlength="1" size="1"><br>
      Birth Date: <input type="date" name="birthDate"><br>
      Is Dead? <input type="checkbox" name="isDead" id="isDead" onClick="showHideDiv(this)"><div id="deathDateDiv" style="display:none">Death Date: <input type="date" name="deathDate"></div><br>
      <input type="submit" value="Insert">
  </form>';
      if($_SERVER['REQUEST_METHOD'] == 'POST') {
          if(isset($_POST['firstName'])) {
              $sql =  "INSERT INTO `person` (`firstName`, `lastName`, `gender`) VALUES ('" . $_POST['firstName'] . "', '" . $_POST['lastName'] . "', '" . $_POST['gender'] . "');";
                  if(isset($_POST['isDead'])) {
                      $sql .= "INSERT INTO `cast` (`personID`, `birthDate`, `deathDate`) VALUES (LAST_INSERT_ID(), '" . $_POST['birthDate'] . "', '" . $_POST['deathDate'] ."');"; 
                  } else {
                      $sql .= "INSERT INTO `cast` (`personID`, `birthDate`) VALUES (LAST_INSERT_ID(), '" . $_POST['birthDate'] ."');";
                  }
                  if(mysqli_multi_query($conn, $sql)) {
                      echo "Done.";
                  } else {
                      echo "Error Inserting Cast : " . mysqli.error($conn);
                  }
          } else {
              echo "missing first name";
          } 
        mysqli_close($conn);
        }
    } else {
      echo "You are not an admin.";
    }
  ?>
  </nav>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script>
        function showHideDiv(chBox) {
            var dv = document.getElementById('deathDateDiv');
            dv.style.display = chBox.checked ? "block" : "none";
        }
    </script>
</body>
</html>