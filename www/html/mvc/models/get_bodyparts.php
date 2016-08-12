<?php

function get_nendoroidBodyParts($number)
{
  global $bdd;

  $req = $bdd->prepare("SELECT bp.internalid, bp.nendoroid_number, bp.part, bp.main_color, bp.main_color_hex, bp.second_color, bp.second_color_hex, bp.description FROM body_parts AS bp WHERE bp.nendoroid_number = :number");
  $req->bindParam(':number',$number);
  $req->execute();
  $body_parts = $req->fetchAll(PDO::FETCH_ASSOC);

  return $body_parts;
}

function count_nendoroidBodyParts()
{
  global $bdd;

  $req = $bdd->prepare("SELECT count(*) As count FROM body_parts AS bo");
  $req->execute();
  $count = $req->fetch();

  return $count['count'];
}

