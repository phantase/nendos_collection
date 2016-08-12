<?php
/** Count all the body parts available in the DB */
function count_allBodyParts()
{
  global $bdd;

  $req = $bdd->prepare("SELECT count(*) As count FROM body_parts AS bo");
  $req->execute();
  $count = $req->fetch();

  return $count['count'];
}
/** Get all the body parts available in the DB */
function get_allBodyParts()
{
  global $bdd;

  $req = $bdd->prepare("SELECT bp.internalid, bp.box_id, bp.nendoroid_id, bp.part, bp.main_color, bp.main_color_hex, bp.second_color, bp.second_color_hex, bp.description FROM body_parts AS bp");
  $req->execute();
  $body_parts = $req->fetchAll(PDO::FETCH_ASSOC);

  return $body_parts;
}
/** Count all the body parts available for a specific Nendoroid */
function count_nendoroidBodyParts($number)
{
  global $bdd;

  $req = $bdd->prepare("SELECT count(*) As count FROM body_parts AS bo WHERE bp.nendoroid_number = :number");
  $req->bindParam(':number',$number);
  $req->execute();
  $count = $req->fetch();

  return $count['count'];
}
/** Get all the body parts available for a specific Nendoroid */
function get_nendoroidBodyParts($number)
{
  global $bdd;

  $req = $bdd->prepare("SELECT bp.internalid, bp.box_id, bp.nendoroid_id, bp.part, bp.main_color, bp.main_color_hex, bp.second_color, bp.second_color_hex, bp.description FROM body_parts AS bp WHERE bp.nendoroid_id = :number");
  $req->bindParam(':number',$number);
  $req->execute();
  $body_parts = $req->fetchAll(PDO::FETCH_ASSOC);

  return $body_parts;
}
