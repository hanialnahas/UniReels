<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="generalStyle.css" rel="stylesheet">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
    <title>Unireels</title>
</head>
<body class="generalBody">
    <?php include 'db_connect.php'; ?>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">
      <div class="container">
        <a href="index.php" class="navbar-brand">UniReels</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
          <ul class="navbar-nav me-auto">
            <li class="nav-item"><a href="index.php" class="nav-link active">Home</a></li>
            <li class="nav-item"><a href="searchActor.php" class="nav-link">Actors</a></li>
            <li class="nav-item"><a href="searchStudio.php" class="nav-link">Studios</a></li>
            <?php if(isset($_SESSION['loggedin']) && isset($_SESSION['admin']) && $_SESSION['admin'] == true) echo '<li class="nav-item"><a href="maintenance.php" class="nav-link">Maintinance</a></li>'?>
            <li class="nav-item"><a href="imprint.php" class="nav-link">Imprint</a></li>
          </ul>
          <form action="searchTitle.php" method="GET" class="d-flex">
            <input type="text" id="searchBarID" class="form-control me-2 ui-widget" placeholder="Search Titles" name="searchbar">
            <input class="btn btn-primary" type="submit" value="Search">
          </form>
        </div>
      </div>
    </nav>

    <nav class="container" style="padding-top: 80px">
      <div class="row g-3">
        <?php 
          $query = "SELECT `id`, `mainTitle`, `releaseDate`, `imdb_rating`, `poster` FROM `title`";
          $result = mysqli_query($conn, $query);

          if(mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
              echo '<div class="col-12 col-md-6 col-lg-4">
                    <a href="title.php?id='.$row['id'].'" style="text-decoration: none;"><div class="card text-dark text-center" style="width: 300px;">
                    <img class="card-img-top" src="'.$row['poster'].'" alt="Title Poster">
		                <div class="card-body">
                    <h4 class="card-title"> ' . $row['mainTitle'] . '</h4>
                    <p class="card-text"> Release Date: ' . $row['releaseDate'] . '<br>Rating: '. $row['imdb_rating'] . '</p>
                    </div>
                    </div></a>
                    </div>';
            }
          } else {
            echo "No Results Found.";
          }
          closeConnection();
        ?>
      </div>
    </nav>
    <?php
      if(isset($_SESSION['loggedin']) && isset($_SESSION['admin']) && $_SESSION['admin'] == false) {
        echo '<script rel="javascript">console.log("Welcome '. $_SESSION['firstName'] . ' ' . $_SESSION['lastName'] .'");</script>';
      }
    ?>
    <script type="text/javascript">
        var sNames = [];
       $.ajax({
        async: false,
        type: 'POST',
        dataType: 'json',
        url: 'getTitleNames.php',
        success: function(response) {
          console.log("done");
          console.log(response);
          sNames = response;
        },
        error: function(response) {
          console.log("error");
          console.log(response);
        }
       });
       $(function() {
         $("#searchBarID").autocomplete({
            source: sNames
         });
       });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
