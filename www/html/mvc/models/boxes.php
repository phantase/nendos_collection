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

  $req = $bdd->prepare("SELECT b.internalid, b.name, b.type, b.creator, uc.username AS creator_name, b.creation, b.editor, ue.username AS editor_name, b.edition FROM boxes AS b LEFT JOIN users AS uc ON b.creator = uc.internalid LEFT JOIN users AS ue ON b.creator = ue.internalid WHERE b.internalid = :boxinternalid");
  $req->bindParam(':boxinternalid',$boxinternalid);
  $req->execute();
  $box = $req->fetch();

  return $box;
}
/** Add a single box in the DB */
function add_singleBox($boxname,$boxtype)
{
  global $bdd;

  $req = $bdd->prepare("INSERT INTO boxes(name,type) VALUES(:boxname,:boxtype)");
  $req->bindParam(':boxname',$boxname);
  $req->bindParam(':boxtype',$boxtype);
  $req->execute();

  $boxinternalid = $bdd->lastInsertId();

  return $boxinternalid;
}
