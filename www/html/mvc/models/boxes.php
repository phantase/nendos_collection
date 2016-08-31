<?php
/** Count all the boxes available in the DB */
function count_allBoxes()
{
  global $bdd;

  $req = $bdd->prepare("SELECT count(*) As count
                        FROM boxes AS b");
  $req->execute();
  $count = $req->fetch();

  return $count['count'];
}
/** Get all the boxes available in the DB */
function get_allBoxes($order="name",$direction="DESC")
{
  $orders = array("internalid","name","type","creator_name,creation,editor_name,edition");
  $key = array_search($order, $orders);
  $order = $orders[$key];
  $directions = array("ASC","DESC");
  $key = array_search($direction, $directions);
  $direction = $directions[$key];

  global $bdd;

  $req = $bdd->prepare("SELECT b.internalid, b.name, b.type,
                        b.creator, uc.username AS creator_name, b.creation,
                        b.editor, ue.username AS editor_name, b.edition,
                        NOW() AS now
                        FROM boxes AS b
                        LEFT JOIN users AS uc ON b.creator = uc.internalid
                        LEFT JOIN users AS ue ON b.creator = ue.internalid
                        ORDER BY $order $direction");
  $req->execute();
  $boxes = $req->fetchAll(PDO::FETCH_ASSOC);

  return $boxes;
}
/** Get a single box from its internalid */
function get_singleBox($boxinternalid)
{
  global $bdd;

  $req = $bdd->prepare("SELECT b.internalid, b.name, b.type,
                        b.creator, uc.username AS creator_name, b.creation,
                        b.editor, ue.username AS editor_name, b.edition,
                        NOW() AS now
                        FROM boxes AS b
                        LEFT JOIN users AS uc ON b.creator = uc.internalid
                        LEFT JOIN users AS ue ON b.creator = ue.internalid
                        WHERE b.internalid = :boxinternalid");
  $req->bindParam(':boxinternalid',$boxinternalid);
  $req->execute();
  $box = $req->fetch();

  return $box;
}
/** Add a single box in the DB */
function add_singleBox($boxname,$boxtype,$userid)
{
  global $bdd;

  $req = $bdd->prepare("INSERT INTO boxes(name,type,creator,creation,editor,edition)
                        VALUES(:boxname,:boxtype,:creator,NOW(),:editor,NOW())");
  $req->bindParam(':boxname',$boxname);
  $req->bindParam(':boxtype',$boxtype);
  $req->bindParam(':creator',$userid);
  $req->bindParam(':editor',$userid);
  $req->execute();

  $boxinternalid = $bdd->lastInsertId();

  return $boxinternalid;
}
