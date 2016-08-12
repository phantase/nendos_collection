<?php

function count_nendoroidHands()
{
  global $bdd;

  $req = $bdd->prepare("SELECT count(*) As count FROM hands AS h");
  $req->execute();
  $count = $req->fetch();

  return $count['count'];
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

