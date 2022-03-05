<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="generalStyle.css" rel="stylesheet">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Unireels</title>
</head>
<body class="generalBody">
    <?php include 'db_connect.php'; include 'navbar.php'; displayNavbar("Titles");?>

    <nav class="container text-light" style="padding-top: 80px; ">
        <br>
        Hani Alnahas - h.alnahas(at)jacobs-university.de<br>
        Max Haumann - m.haumann(at)jacobs-university.de<br>
        Bidur Niroula - b.niroula(at)jacobs-university.de<br>
        <hr>
        This website is student lab work and does not necessarily reflect Jacobs University Bremen opinions. Jacobs University Bremen does not endorse this site, nor is it checked by Jacobs University
        Bremen regularly, nor is it part of the official Jacobs University Bremen web presence.<br>
        For each external link existing on this website, we initially have checked that the target page
        does not contain contents which is illegal wrt. German jurisdiction. However, as we have no influence on such contents, this may change without our notice. Therefore we deny any responsibility for the websites referenced through our external links from here.<br>
        No information conflicting with GDPR is stored in the server.
    </nav>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
