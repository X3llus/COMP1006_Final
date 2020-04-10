<?php
header("Content-Type: application/json");
require_once("../db.php");

$select = "SELECT h.hotelId as id, h.name as name, h.address as address, t.town as town, h.rating as rating, h.photo as photo FROM hotels h, towns t WHERE h.townId = t.townId;";
$cmd = $db->prepare($select);
$cmd->execute();

$hotels = $cmd->fetchAll(PDO::FETCH_ASSOC);

$JSON = json_encode($hotels);

echo $JSON;

?>
