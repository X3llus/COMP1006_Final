<?php

  require_once("db.php");
  $select = "SELECT COUNT(hotelId) as count FROM hotels;";
  $cmd = $db->prepare($select);
  $cmd->execute();

  $count = $cmd->fetch();
  $numHotels = $count["count"];


?>
<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <title><?php echo $title ?></title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="footer.css">
</head>
<body>
  <header>
    <nav class="navbar navbar-light bg-light navbar-expand-lg">
      <ul class="navbar-nav">
        <li class="nav-item"><a class="nav-link" href="hotels.php">Hotels (<?php echo $numHotels; ?>)</a></li>
        <li class="nav-item"><a class="nav-link" href="api/hotels.php">API</a></li>
      </ul>
    </nav>
  </header>
</body>
