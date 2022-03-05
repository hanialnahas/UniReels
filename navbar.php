<?php

function displayNavbar() {
    echo '<nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">
    <div class="container">
      <a href="index.php" class="navbar-brand">UniReels</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav me-auto">
          <li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
          <li class="nav-item"><a href="searchActor.php" class="nav-link">Actors</a></li>
          <li class="nav-item"><a href="searchStudio.php" class="nav-link">Studios</a></li>';
          if(isset($_SESSION["loggedin"]) && isset($_SESSION["admin"]) && $_SESSION["admin"] == true) {echo '<li class="nav-item"><a href="maintenance.php" class="nav-link">Maintinance</a></li>';}
          echo '<li class="nav-item"><a href="imprint.php" class="nav-link">Imprint</a></li>
        </ul>
        <form action="searchTitle.php" method="GET" class="d-flex">
          <input type="text" id="searchBarID" class="form-control me-2 ui-widget" placeholder="Search Titles" name="searchbar">
          <input class="btn btn-primary" type="submit" value="Search">
        </form>
      </div>
    </div>
  </nav>';
}

?>