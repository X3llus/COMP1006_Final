<!DOCTYPE html>
<html lang="en" dir="ltr">
  <body>
    <?php

      $title = "Updating";
      require_once("header.php");

      $valid = true;

      $hotelId = htmlspecialchars($_POST["hotelId"]);
      $hotel = htmlspecialchars($_POST["hotel"]);
      $address = htmlspecialchars($_POST["address"]);
      $town = htmlspecialchars($_POST["town"]);
      $rating = htmlspecialchars($_POST["rating"]);
      $photo = htmlspecialchars($_FILES["photo"]);
      $photoName = null;

      $vars = array($hotelId, $hotel, $address, $town, $rating, $photo);

      foreach ($vars as $var) {
        if (empty($var)) {
          echo "$var required";
          $valid = false;
        }
      }

      if (!empty($photo["tmp_name"])) {
        $photoName = $photo["name"];
        $tmp_name = $photo["tmp_name"];
        $type = mime_content_type($tmp_name);

        if ($type != "image/png") {
            echo "File must be a png" . $type;
            $valid = false;
        }

        $photoName = session_id() . "-" . $photoName;
        move_uploaded_file($tmp_name, "images/$photoName");
      }

      if ($valid) {
        require_once("db.php");
        $update = "UPDATE hotels SET name = :name, address = :address, townId = :town, photo = :photo, rating = :rating WHERE hotelId = :id;";
        $cmd = $db->prepare($update);

        $cmd->bindParam(":name", $hotel, PDO::PARAM_STR);
        $cmd->bindParam(":address", $address, PDO::PARAM_STR);
        $cmd->bindParam(":town", $town, PDO::PARAM_STR);
        $cmd->bindParam(":photo", $photoName, PDO::PARAM_STR);
        $cmd->bindParam(":rating", $rating, PDO::PARAM_INT);
        $cmd->bindParam(":id", $hotelId, PDO::PARAM_INT);

        $cmd->execute();

        $db = null;
        echo "<h2 class=\"alert alert-success\">Review Posted</h2>";
        header("location:hotels.php");
      }

      require_once("footer.php");
    ?>
  </body>
</html>
