<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="generalStyle.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
    <title>Unireels</title>
</head>
<body class="generalBody">
    <?php include 'db_connect.php'; include 'navbar.php'; displayNavbar("Titles");?>
    <nav class="container text-light" style="padding-top: 80px">
      <div class="row g-3">
        <?php 
         if($_SERVER['REQUEST_METHOD'] == 'GET') {
          $searchTerm = isset($_GET['searchbar']) ? $_GET['searchbar'] : "";
          $query = "SELECT `id`, `mainTitle`, `releaseDate`, `imdb_rating`, `poster` FROM `title` WHERE mainTitle LIKE '%" . $searchTerm . "%'";
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
         }
        ?>
      </div>
    </nav>
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
    </body>
</html>
