<?php
/** Count all the accessories available in the DB */
function count_allAccessories()
{
  global $bdd;

  $req = $bdd->prepare("SELECT count(*) As count FROM accessories AS a");
  $req->execute();
  $count = $req->fetch();

  return $count['count'];
}
/** Get all the accessories available in the DB */
function get_allAccessories()
{
  global $bdd;

  $req = $bdd->prepare("SELECT a.internalid, a.box_id, a.nendoroid_id, a.type, a.main_color, a.main_color_hex, a.other_color, a.other_color_hex, a.description FROM accessories AS a");
  $req->execute();
  $accessories = $req->fetchAll(PDO::FETCH_ASSOC);

  return $accessories;
}
/** Count all the accessories available for a specific Nendoroid */
function count_nendoroidAccessories($nendoroid_id)
{
  global $bdd;

  $req = $bdd->prepare("SELECT count(*) As count FROM accessories AS a WHERE a.nendoroid_number = :nendoroid_id");
  $req->bindParam(':nendoroid_id',$nendoroid_id);
  $req->execute();
  $count = $req->fetch();

  return $count['count'];
}
/** Get all the accessories available for a specific Nendoroid */
function get_nendoroidAccessories($nendoroid_id)
{
  global $bdd;

  $req = $bdd->prepare("SELECT a.internalid, a.box_id, a.nendoroid_id, a.type, a.main_color, a.main_color_hex, a.other_color, a.other_color_hex, a.description FROM accessories AS a WHERE a.nendoroid_id = :nendoroid_id");
  $req->bindParam(':nendoroid_id',$nendoroid_id);
  $req->execute();
  $accessories = $req->fetchAll(PDO::FETCH_ASSOC);

  return $accessories;
}
