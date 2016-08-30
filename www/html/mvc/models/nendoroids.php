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

  $req = $bdd->prepare('SELECT n.internalid, n.box_id, n.name, n.origin, n.version, n.company, n.dominant_color, b.name AS box_name, b.type AS box_type FROM nendoroids AS n, boxes AS b WHERE n.box_id=b.internalid;');
  $req->execute();
  $nendoroids = $req->fetchAll(PDO::FETCH_ASSOC);

  return $nendoroids;
}
/** Get a single Nendoroid based on its internalid */
function get_singleNendoroid($nendoroid_id)
{
  global $bdd;

  $req = $bdd->prepare("SELECT n.internalid, n.box_id, n.name, n.origin, n.version, n.company, n.dominant_color, b.name AS box_name, b.type AS box_type FROM nendoroids AS n, boxes AS b WHERE n.box_id=b.internalid AND n.internalid = :nendoroid_id");
  $req->bindParam(':nendoroid_id',$nendoroid_id);
  $req->execute();
  $nendoroid = $req->fetch();

  return $nendoroid;
}
/** Get all Nendoroid for a certain box internalid */
function get_boxNendoroids($box_id)
{
  global $bdd;

  $req = $bdd->prepare("SELECT n.internalid, n.box_id, n.name, n.origin, n.version, n.company, n.dominant_color, b.name AS box_name, b.type AS box_type FROM nendoroids AS n, boxes AS b WHERE n.box_id=b.internalid AND n.box_id = :box_id");
  $req->bindParam(':box_id',$box_id);
  $req->execute();
  $nendoroids = $req->fetchAll(PDO::FETCH_ASSOC);

  return $nendoroids;
}
/** Add a single nendoroid in the DB */
function add_singleNendoroid($box_id,$nendoroid_name,$nendoroid_origin,$nendoroid_version,$nendoroid_company,$nendoroid_color)
{
  global $bdd;

  $req = $bdd->prepare("INSERT INTO nendoroids(box_id,name,origin,version,company,dominant_color) VALUES(:box_id,:nendoroid_name,:nendoroid_origin,:nendoroid_version,:nendoroid_company,:nendoroid_color)");
  $req->bindParam(':box_id',$box_id);
  $req->bindParam(':nendoroid_name',$nendoroid_name);
  $req->bindParam(':nendoroid_origin',$nendoroid_origin);
  $req->bindParam(':nendoroid_version',$nendoroid_version);
  $req->bindParam(':nendoroid_company',$nendoroid_company);
  $req->bindParam(':nendoroid_color',$nendoroid_color);
  $req->execute();

  $nendoroidinternalid = $bdd->lastInsertId();

  return $nendoroidinternalid;
}
