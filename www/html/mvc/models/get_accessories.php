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

  $req = $bdd->prepare("SELECT a.internalid, a.nendoroid_number, a.type, a.main_color, a.main_color_hex, a.other_color, a.other_color_hex, a.description FROM accessories AS a");
  $req->execute();
  $accessories = $req->fetchAll(PDO::FETCH_ASSOC);

  return $accessories;
}
/** Count all the accessories available for a specific Nendoroid */
function count_nendoroidAccessories($number)
{
  global $bdd;

  $req = $bdd->prepare("SELECT count(*) As count FROM accessories AS a WHERE a.nendoroid_number = :number");
  $req->bindParam(':number',$number);
  $req->execute();
  $count = $req->fetch();

  return $count['count'];
}
/** Get all the accessories available for a specific Nendoroid */
function get_nendoroidAccessories($number)
{
  global $bdd;

  $req = $bdd->prepare("SELECT a.internalid, a.nendoroid_number, a.type, a.main_color, a.main_color_hex, a.other_color, a.other_color_hex, a.description FROM accessories AS a WHERE a.nendoroid_number = :number");
  $req->bindParam(':number',$number);
  $req->execute();
  $accessories = $req->fetchAll(PDO::FETCH_ASSOC);

  return $accessories;
}
