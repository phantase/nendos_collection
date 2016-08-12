<?php

function count_nendoroidAccessories()
{
  global $bdd;

  $req = $bdd->prepare("SELECT count(*) As count FROM accessories AS a");
  $req->execute();
  $count = $req->fetch();

  return $count['count'];
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

