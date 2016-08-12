<?php

function get_nendoroidFaces($number)
{
  global $bdd;

  $req = $bdd->prepare("SELECT f.internalid, f.nendoroid_number, f.eyes, f.eyes_color, f.eyes_color_hex, f.mouth, f.skin_color, f.skin_color_hex, f.sex FROM faces AS f WHERE f.nendoroid_number = :number");
  $req->bindParam(':number',$number);
  $req->execute();
  $faces = $req->fetchAll(PDO::FETCH_ASSOC);

  return $faces;
}

function get_nendoroidHands($number)
{
  global $bdd;

  $req = $bdd->prepare("SELECT h.internalid, h.nendoroid_number, h.skin_color, h.skin_color_hex, h.leftright, h.posture, h.description FROM hands AS h WHERE h.nendoroid_number = :number");
  $req->bindParam(':number',$number);
  $req->execute();
  $hands = $req->fetchAll(PDO::FETCH_ASSOC);

  return $hands;
}

function get_nendoroidBodyParts($number)
{
  global $bdd;

  $req = $bdd->prepare("SELECT bp.internalid, bp.nendoroid_number, bp.part, bp.main_color, bp.main_color_hex, bp.second_color, bp.second_color_hex, bp.description FROM body_parts AS bp WHERE bp.nendoroid_number = :number");
  $req->bindParam(':number',$number);
  $req->execute();
  $body_parts = $req->fetchAll(PDO::FETCH_ASSOC);

  return $body_parts;
}

function get_nendoroidHairs($number)
{
  global $bdd;

  $req = $bdd->prepare("SELECT h.internalid, h.nendoroid_number, h.main_color, h.main_color_hex, h.other_color, h.other_color_hex, h.haircut, h.description, h.frontback FROM hairs AS h WHERE h.nendoroid_number = :number");
  $req->bindParam(':number',$number);
  $req->execute();
  $hairs = $req->fetchAll(PDO::FETCH_ASSOC);

  return $hairs;
}

function get_nendoroidAccessories($number)
{
  global $bdd;

  $req = $bdd->prepare("SELECT a.internalid, a.nendoroid_number, a.type, a.main_color, a.main_color_hex, a.other_color, a.other_color_hex, a.description FROM accessories AS a WHERE a.nendoroid_number = :number");
  $req->bindParam(':number',$number);
  $req->execute();
  $accessories = $req->fetchAll(PDO::FETCH_ASSOC);

  return $accessories;
}

function count_nendoroidFaces()
{
  global $bdd;

  $req = $bdd->prepare("SELECT count(*) As count FROM faces AS f");
  $req->execute();
  $count = $req->fetch();

  return $count['count'];
}

function count_nendoroidHands()
{
  global $bdd;

  $req = $bdd->prepare("SELECT count(*) As count FROM hands AS h");
  $req->execute();
  $count = $req->fetch();

  return $count['count'];
}

function count_nendoroidBodyParts()
{
  global $bdd;

  $req = $bdd->prepare("SELECT count(*) As count FROM body_parts AS bo");
  $req->execute();
  $count = $req->fetch();

  return $count['count'];
}

function count_nendoroidHairs()
{
  global $bdd;

  $req = $bdd->prepare("SELECT count(*) As count FROM hairs AS h");
  $req->execute();
  $count = $req->fetch();

  return $count['count'];
}

function count_nendoroidAccessories()
{
  global $bdd;

  $req = $bdd->prepare("SELECT count(*) As count FROM accessories AS a");
  $req->execute();
  $count = $req->fetch();

  return $count['count'];
}
