<?php
/** Count all Nendoroids available in the DB */
function count_allNendoroids()
{
  global $bdd;

  $req = $bdd->prepare("SELECT count(*) AS count FROM nendoroids AS n");
  $req->execute();
  $count = $req->fetch();

  return $count['count'];
}
/** Get all Nendoroids available in the DB */
function get_allNendoroids()
{
  global $bdd;

  $req = $bdd->prepare('SELECT n.internalid, n.box_id, n.name, n.origin, n.version, n.editor, n.dominant_color, b.name AS box_name, b.type AS box_type FROM nendoroids AS n, boxes AS b WHERE n.box_id=b.internalid;');
  $req->execute();
  $nendoroids = $req->fetchAll(PDO::FETCH_ASSOC);

  return $nendoroids;
}
/** Get a single Nendoroid based on its internalid */
function get_singleNendoroid($nendoroid_id)
{
  global $bdd;

  $req = $bdd->prepare("SELECT n.internalid, n.box_id, n.name, n.origin, n.version, n.editor, n.dominant_color, b.name AS box_name, b.type AS box_type FROM nendoroids AS n, boxes AS b WHERE n.box_id=b.internalid AND n.internalid = :nendoroid_id");
  $req->bindParam(':nendoroid_id',$nendoroid_id);
  $req->execute();
  $nendoroid = $req->fetch();

  return $nendoroid;
}
/** Get all Nendoroid for a certain box internalid */
function get_boxNendoroids($box_id)
{
  global $bdd;

  $req = $bdd->prepare("SELECT n.internalid, n.box_id, n.name, n.origin, n.version, n.editor, n.dominant_color, b.name AS box_name, b.type AS box_type FROM nendoroids AS n, boxes AS b WHERE n.box_id=b.internalid AND n.box_id = :box_id");
  $req->bindParam(':box_id',$box_id);
  $req->execute();
  $nendoroids = $req->fetchAll(PDO::FETCH_ASSOC);

  return $nendoroids;
}
