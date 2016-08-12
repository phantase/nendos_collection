<?php
/** Count all the boxes available in the DB */
function count_allBoxes()
{
  global $bdd;

  $req = $bdd->prepare("SELECT count(*) As count FROM boxes AS b");
  $req->execute();
  $count = $req->fetch();

  return $count['count'];
}
/** Get all the boxes available in the DB */
function get_allBoxes()
{
  global $bdd;

  $req = $bdd->prepare("SELECT b.internalid, b.name, b.type FROM boxes AS b");
  $req->execute();
  $boxes = $req->fetchAll(PDO::FETCH_ASSOC);

  return $boxes;
}
/** Get a single box from its internalid */
function get_singleBox($boxinternalid)
{
  global $bdd;

  $req = $bdd->prepare("SELECT b.internalid, b.name, b.type FROM boxes AS b WHERE b.internalid = :boxinternalid");
  $req->bindParam(':boxinternalid',$boxinternalid);
  $req->execute();
  $box = $req->fetch();

  return $box;
}
