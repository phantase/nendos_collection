<?php
/** Count all the Hairs available in the DB */
function count_allHairs()
{
  global $bdd;

  $req = $bdd->prepare("SELECT count(*) AS count FROM hairs AS h");
  $req->execute();
  $count = $req->fetch();

  return $count['count'];
}
/** Get all the Hairs available in the DB */
function get_allHairs()
{
  global $bdd;

  $req = $bdd->prepare("SELECT h.internalid, h.box_id, h.nendoroid_id, h.main_color, h.main_color_hex, h.other_color, h.other_color_hex, h.haircut, h.description, h.frontback FROM hairs AS h");
  $req->execute();
  $hairs = $req->fetchAll(PDO::FETCH_ASSOC);

  return $hairs;
}
/** Count all the Hairs for a specific Nendoroid */
function count_nendoroidHairs($nendoroid_id)
{
  global $bdd;

  $req = $bdd->prepare("SELECT count(*) AS count FROM hairs AS h WHERE h.nendoroid_id = :nendoroid_id");
  $req->bindParam(':nendoroid_id',$nendoroid_id);
  $req->execute();
  $count = $req->fetch();

  return $count['count'];
}
/** Get all the Hairs available for a specific Nendoroid */
function get_nendoroidHairs($nendoroid_id)
{
  global $bdd;

  $req = $bdd->prepare("SELECT h.internalid, h.box_id, h.nendoroid_id, h.main_color, h.main_color_hex, h.other_color, h.other_color_hex, h.haircut, h.description, h.frontback FROM hairs AS h WHERE h.nendoroid_id = :nendoroid_id");
  $req->bindParam(':nendoroid_id',$nendoroid_id);
  $req->execute();
  $hairs = $req->fetchAll(PDO::FETCH_ASSOC);

  return $hairs;
}
