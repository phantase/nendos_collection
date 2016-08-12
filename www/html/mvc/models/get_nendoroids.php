<?php

function count_nendoroids()
{
  global $bdd;

  $req = $bdd->prepare("SELECT count(*) AS count FROM nendoroids AS n");
  $req->execute();
  $count = $req->fetch();

  return $count['count'];
}

function get_allNendoroids()
{
  global $bdd;

  $req = $bdd->prepare('SELECT n.internalid, n.box_id, n.name, n.origin, n.version, n.editor, n.dominant_color, b.name AS box_name, b.type AS box_type FROM nendoroids AS n, boxes AS b WHERE n.box_id=b.internalid;');
  $req->execute();
  $nendoroids = $req->fetchAll(PDO::FETCH_ASSOC);

  return $nendoroids;
}

function get_singleNendoroid($number)
{
  global $bdd;

  $req = $bdd->prepare("SELECT n.internalid, n.box_id, n.name, n.origin, n.version, n.editor, n.dominant_color, b.name AS box_name, b.type AS box_type FROM nendoroids AS n, boxes AS b WHERE n.box_id=b.internalid AND n.internalid = :number");
  $req->bindParam(':number',$number);
  $req->execute();
  $nendoroid = $req->fetch();

  return $nendoroid;
}
