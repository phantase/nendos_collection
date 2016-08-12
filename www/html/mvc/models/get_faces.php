<?php

function count_nendoroidFaces()
{
  global $bdd;

  $req = $bdd->prepare("SELECT count(*) As count FROM faces AS f");
  $req->execute();
  $count = $req->fetch();

  return $count['count'];
}

function get_nendoroidFaces($number)
{
  global $bdd;

  $req = $bdd->prepare("SELECT f.internalid, f.nendoroid_number, f.eyes, f.eyes_color, f.eyes_color_hex, f.mouth, f.skin_color, f.skin_color_hex, f.sex FROM faces AS f WHERE f.nendoroid_number = :number");
  $req->bindParam(':number',$number);
  $req->execute();
  $faces = $req->fetchAll(PDO::FETCH_ASSOC);

  return $faces;
}

