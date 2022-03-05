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
    <?php include 'db_connect.php'; ?>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">
      <div class="container">
        <a href="index.php" class="navbar-brand">UniReels</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
          <ul class="navbar-nav me-auto">
            <li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
            <li class="nav-item"><a href="searchActor.php" class="nav-link">Actors</a></li>
            <li class="nav-item"><a href="searchStudio.php" class="nav-link">Studios</a></li>
            <?php if(isset($_SESSION['loggedin']) && isset($_SESSION['admin']) && $_SESSION['admin'] == true) echo '<li class="nav-item"><a href="maintenance.php" class="nav-link">Maintinance</a></li>'?>
            <li class="nav-item"><a href="imprint.php" class="nav-link">Imprint</a></li>
          </ul>
          <form action="searchTitle.php" method="GET" class="d-flex">
            <input type="text" class="form-control me-2" placeholder="Search Titles" name="searchbar">
            <input class="btn btn-primary" type="submit" value="Search">
          </form>
        </div>
      </div>
    </nav>
    <?php 
        $query = "SELECT * FROM `person` LEFT OUTER JOIN `cast` ON person.id = cast.personID LEFT OUTER JOIN `crew` ON person.id = crew.personID WHERE id = '" . $_GET['id'] . "';";
        $result = mysqli_query($conn, $query);
        $title = mysqli_fetch_assoc($result);
    ?>
    <nav class="container" style="padding-top: 80px">
      <div class="row mt-5">
          <div class="col-4 mt-5">
            <img src="<?php echo $title['image']; ?>" alt="logo" class="img-fluid">
          </div>
          <div class="col-8 text-center text-light">
          <h3><?php echo $title['firstName'] . ' ' . $title['lastName']; ?></h3>  
          <div>
            <p><?php echo "Gender: " . $title['gender']; ?></p>
            <p>
              <?php 
                if(isset($title['birthDate'])) {
                  echo "Born: " . $title['birthDate'];
                }
                if(isset($title['deathDate'])) {
                  echo " - Died: " . $title['deathDate'];
                }
                if(isset($title['profession'])) {
                  echo "Profession: " . $title['profession'];
                }
              ?>
            </p>
          </div>
        </div>
      </div>
    </nav>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
