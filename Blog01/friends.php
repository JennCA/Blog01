<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Other blogs</title>
  <link rel="stylesheet" href="css/style.css">
  <style>
  body {
      background-image: url("http://i66.tinypic.com/s2a9uf.png");
      background-repeat: space;
      background-size: 1900px;
      background-position: center;
      background-color: black;
  }
  </style>
</head>
<body>
  <div id="main">
            <h3>Here you can check out other Blogs:</h3>
            <?php
              $dbconnection = new PDO('mysql:host=10.20.16.102;dbname=ipadressen','DB_BLJ','BLJ12345l');
            ?>
            <h4>Fynn:</h4>
            <?php
            $stmt = $dbconnection->query("SELECT ip,home FROM t_ipadress order by ID");
            $ipArray = $stmt -> fetchAll();
            ?>


            <p><a href="http://<?php echo $ipArray[2][0] ?><?php echo $homeArray[2][1] ?>">Fynnus Blogus</a></p>
            <h4>Carolina:</h4>
            <p><a href="http://<?php echo $ipArray[1][0]?><?php echo $homeArray[1][1] ?>">Carolina's Blog</a></p>
            <h4>Raffaele:</h4>
            <p><a href="http://<?php echo $ipArray[7][0]?><?php echo $homeArray[7][1] ?>">RBWS</a></p>
            <h4>David:</h4>
            <p><a href="http://<?php echo $ipArray[0][0]?><?php echo $homeArray[0][1] ?>">Ein Blog der dein Leben verändert</a></p>
            <h4>Céline</h4>
            <p><a href="http://<?php echo $ipArray[3][0]?><?php echo $homeArray[3][1] ?>">CBlog</a></p>
            <h4>Jennifer:</h4>
            <p><a href="http://<?php echo $ipArray[4][0]?><?php echo $homeArray[4][1] ?>">Conspiracy FLOK</a></p>
        </div>


</html>
