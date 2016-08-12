<?php
/** Count all the Hands available in the DB */
function count_allHands()
{
  global $bdd;

  $req = $bdd->prepare("SELECT count(*) AS count FROM hands AS h");
  $req->execute();
  $count = $req->fetch();

  return $count['count'];
}
/** Get all the Hands available in the DB */
function get_allHands()
{
  global $bdd;

  $req = $bdd->prepare("SELECT h.internalid, h.box_id, h.nendoroid_id, h.skin_color, h.skin_color_hex, h.leftright, h.posture, h.description FROM hands AS h");
  $req->execute();
  $hands = $req->fetchAll(PDO::FETCH_ASSOC);

  return $hands;
}
/** Count all the Hands available for a specific Nendoroid */
function count_nendoroidHands($nendoroid_id)
{
  global $bdd;

  $req = $bdd->prepare("SELECT count(*) AS count FROM hands AS h WHERE h.nendoroid_id = :nendoroid_id");
  $req->bindParam(':nendoroid_id',$nendoroid_id);
  $req->execute();
  $count = $req->fetch();

  return $count['count'];
}
/** Get all the Hands available for a specific Nendoroid */
function get_nendoroidHands($nendoroid_id)
{
  global $bdd;

  $req = $bdd->prepare("SELECT h.internalid, h.box_id, h.nendoroid_id, h.skin_color, h.skin_color_hex, h.leftright, h.posture, h.description FROM hands AS h WHERE h.nendoroid_id = :nendoroid_id");
  $req->bindParam(':nendoroid_id',$nendoroid_id);
  $req->execute();
  $hands = $req->fetchAll(PDO::FETCH_ASSOC);

  return $hands;
}

