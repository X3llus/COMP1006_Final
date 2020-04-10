<?php

$id = $_GET["hotelId"];

require_once("db.php");

$select = "SELECT h.hotelId as id, h.name as name, h.address as address, t.town as town, h.rating as rating, h.photo as photo FROM hotels h, towns t WHERE h.townId = t.townId AND h.hotelId = :id;";
$cmd = $db->prepare($select);
$cmd->bindParam(':id', $id, PDO::PARAM_INT);
$cmd->execute();

$hotel = $cmd->fetch();
$hotelId = $hotel["id"];
$name = $hotel["name"];
$address = $hotel["address"];
$currentTown = $hotel["town"];
$rating = $hotel["rating"];
$photo = $hotel["photo"];

$select = "SELECT * FROM towns;";
$cmd = $db->prepare($select);
$cmd->execute();

$towns = $cmd->fetchAll();

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <body>
    <?php

      $title = "Edit";
      require_once("header.php");

    ?>
    <main>
      <form class="container" action="update.php" method="post" enctype="multipart/form-data">
        <fieldset>
          <label for="hotel">Hotel</label>
          <input type="text" name="hotel" value="<?php echo $name; ?>" required>
        </fieldset>
        <fieldset>
          <label for="address">Address</label>
          <textarea name="address" rows="4" cols="40" required><?php echo $address; ?></textarea>
        </fieldset>
        <fieldset>
          <label for="town">Town</label>
          <select name="town" required>
            <?php

              foreach ($towns as $town) {
                echo "<option value=" . $town['townId'];
                if ($town["town"] == $currentTown) {
                  echo " selected";
                }
                echo ">" . $town["town"] . "</option>";
              }

            ?>
          </select>
        </fieldset>
        <fieldset>
          <label for="rating">Rating</label>
          <input type="number" name="rating" value=<?php echo $rating; ?> min=1 max=5 required>
        </fieldset>
        <fieldset>
          <label for="photo">Photo</label>
          <input type="file" name="photo" accept="image/png">
          <img src=images/<?php echo $photo; ?> alt=<?php $hotel; ?>>
        </fieldset>
        <input type="hidden" name="hotelId" value=<?php echo $hotelId; ?>>
        <input type="submit" value="Update">
      </form>
    </main>
    <?php require_once("footer.php"); $db = null;?>
  </body>
</html>
