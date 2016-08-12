<?php

function count_nendoroidHairs()
{
  global $bdd;

  $req = $bdd->prepare("SELECT count(*) As count FROM hairs AS h");
  $req->execute();
  $count = $req->fetch();

  return $count['count'];
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
