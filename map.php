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
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
    integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
    crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
    integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
    crossorigin=""></script>
  <title>Unireels</title>
</head>
<body class="generalBody">
    <?php include('db_connect.php'); include('navbar.php'); displayNavbar()?>
    

    <nav class="container" style="padding-top: 80px">
      <div id="map" style="height: 800px;"></div>
    </nav>
    <?php
      if(isset($_SESSION['loggedin']) && isset($_SESSION['admin']) && $_SESSION['admin'] == false) {
        echo '<script rel="javascript">console.log("Welcome '. $_SESSION['firstName'] . ' ' . $_SESSION['lastName'] .'");</script>';
      }
    ?>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script>
    $.getJSON('https://api.db-ip.com/v2/free/self', function(data) {
      var ipObj = JSON.parse(JSON.stringify(data, null, 2));
      console.log(ipObj.ipAddress);
      $.getJSON('http://ip-api.com/json/'+ipObj.ipAddress, function(data) {
      var locObj = JSON.parse(JSON.stringify(data, null, 2));
      var lat = locObj.lat;
      var lon = locObj.lon;
      var map = L.map('map').setView([lat, lon], 14);
      L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
      attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
      maxZoom: 18,
      id: 'mapbox/streets-v11',
      tileSize: 512,
      zoomOffset: -1,
      accessToken: 'pk.eyJ1IjoiN2FuaSIsImEiOiJja3dud2lmNHQwbXRwMnBxdDMxZmEyMzFlIn0.Qbmd-c7zPH53uQnJnM9lvg'
      }).addTo(map);
      var marker = L.marker([lat, lon]).addTo(map);
      marker.bindPopup("You are here.").openPopup();
    });
    });
    
    
  </script>
</body>
</html>
