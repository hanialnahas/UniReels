<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="generalStyle.css">
    <title>Unireels</title>
</head>
<body class="generalBody">
    <?php include 'db_connect.php'; include 'navbar.php'; displayNavbar("Titles");?>
    <?php 
        $query = "SELECT * FROM `title` INNER JOIN `studio` ON studio.id = title.studio_id LEFT OUTER JOIN `movie` ON title.id = movie.titleID LEFT OUTER JOIN `series` ON title.id = series.titleID WHERE title.id = '" . $_GET['id'] . "';";
        $result = mysqli_query($conn, $query);
        $title = mysqli_fetch_assoc($result);
    ?>
    <nav class="container" style="padding-top: 80px">
      <div class="row mt-5">
          <div class="col-4 mt-5">
            <img src="<?php echo $title['poster']; ?>" alt="logo" class="img-fluid">
          </div>
          <div class="col-8 text-center text-light">
          <h3><?php echo $title['mainTitle']; ?></h3>  
          <div>
            <p><?php echo "Released: " . $title['releaseDate']; ?></p><br>
            <p><?php echo "Studio: " . $title['studioName']; ?></p><br>
            <p><?php echo "Rating: " . $title['imdb_rating']; ?></p><br>
            <p><?php echo "Parental Guide: " . $title['ageRating']; ?></p><br>
            <p><?php echo "Description: " . $title['shortDescription']; ?></p><br>
          </div>
          <p>
            <?php 
              if(isset($title['runTime'])) {
                echo "<p>Run Time: " . $title['runTime'] . ' minutes</p>';
              }
              if(isset($title['boxOffice'])) {
                echo "<p>Box Office: $" . number_format($title['boxOffice']) . '</p>';
              }
              if(isset($title['numberOfEpisodes'])) {
                echo "<p>" . $title['numberOfEpisodes'] . ' episodes</p>';
              }
              if(isset($title['endDate'])) {
                echo "<p>Ended: " . $title['endDate'] . '</p>';
              }
            ?>
          </p>
        </div>
      </div>
    </nav>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
