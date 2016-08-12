<?php
/** Count all the faces available in the DB */
function count_allFaces()
{
  global $bdd;

  $req = $bdd->prepare("SELECT count(*) AS count FROM faces AS f");
  $req->execute();
  $count = $req->fetch();

  return $count['count'];
}
/** Get all the faces available in the DB */
function get_allFaces()
{
  global $bdd;

  $req = $bdd->prepare("SELECT f.internalid, f.box_id, f.nendoroid_id, f.eyes, f.eyes_color, f.eyes_color_hex, f.mouth, f.skin_color, f.skin_color_hex, f.sex FROM faces AS f");
  $req->execute();
  $faces = $req->fetchAll(PDO::FETCH_ASSOC);

  return $faces;
}
/** Count all the faces available for a specific Nendoroid */
function count_nendoroidFaces($nendoroid_id)
{
  global $bdd;

  $req = $bdd->prepare("SELECT count(*) AS count FROM faces AS f WHERE f.nendoroid_id = :nendoroid_id");
  $req->bindParam(':nendoroid_id',$nendoroid_id);
  $req->execute();
  $count = $req->fetch();

  return $count['count'];
}
/** Get all the faces available for a specific Nendoroid */
function get_nendoroidFaces($nendoroid_id)
{
  global $bdd;

  $req = $bdd->prepare("SELECT f.internalid, f.box_id, f.nendoroid_id, f.eyes, f.eyes_color, f.eyes_color_hex, f.mouth, f.skin_color, f.skin_color_hex, f.sex FROM faces AS f WHERE f.nendoroid_id = :nendoroid_id");
  $req->bindParam(':nendoroid_id',$nendoroid_id);
  $req->execute();
  $faces = $req->fetchAll(PDO::FETCH_ASSOC);

  return $faces;
}
