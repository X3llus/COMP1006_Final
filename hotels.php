<!DOCTYPE html>
<html lang="en" dir="ltr">
  <body>
    <?php

      $title = "Hotels";
      require_once("header.php");
    ?>
    <main>
      <table class="table table-hover table-bordered">

        <thead class="thead"><th>Hotel</th><th>Address</th><th>Town</th><th>Rating</th><th>Photo</th></thead>
        <?php

        // Connect to my database
        require_once("db.php");

        // Make sql command to get our data
        $select = "SELECT h.hotelId as id, h.name as name, h.address as address, t.town as town, h.rating as rating, h.photo as photo FROM hotels h, towns t WHERE h.townId = t.townId;";
        $cmd = $db->prepare($select);
        $cmd->execute();

        $hotels = $cmd->fetchAll();

        // Build out the table rows with the data
        foreach ($hotels as $hotel) {
          echo "<tr><td><a href=edit.php?hotelId=" . $hotel["id"] . ">" .  $hotel["name"] . "</td><td>" . $hotel["address"] . "</td><td>" . $hotel["town"] . "</td><td>" . $hotel["rating"] . "</td><td><img width=75px src=images/" . $hotel["photo"] . " alt=" . $hotel["name"] . "></td></tr>";
        }

        $db = null;

        ?>
       </table>
    </main>
    <?php require_once("footer.php"); ?>
  </body>
</html>
