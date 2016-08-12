<?php

function get_allNendoroids()
{
  global $bdd;

  $req = $bdd->prepare('SELECT n.internalid, n.boxid, n.name, n.origin, n.version, n.editor, n.dominant_color, b.name AS boxname, b.type AS boxtype FROM nendoroids AS n, boxes AS b WHERE n.boxid=b.internalid;');
  $req->execute();
  $nendoroids = $req->fetchAll(PDO::FETCH_ASSOC);

  return $nendoroids;
}

function get_singleNendoroid($number)
{
  global $bdd;

  $req = $bdd->prepare("SELECT n.internalid, n.boxid, n.name, n.origin, n.version, n.editor, n.dominant_color, b.name AS boxname, b.type AS boxtype FROM nendoroids AS n, boxes AS b WHERE n.boxid=b.internalid AND n.internalid = :number");
  $req->bindParam(':number',$number);
  $req->execute();
  $nendoroid = $req->fetch();

  return $nendoroid;
}
