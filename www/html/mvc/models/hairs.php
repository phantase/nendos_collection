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
/** Get all the Hairs available for a specific Box */
function get_boxHairs($box_id)
{
  global $bdd;

  $req = $bdd->prepare("SELECT h.internalid, h.box_id, h.nendoroid_id, h.main_color, h.main_color_hex, h.other_color, h.other_color_hex, h.haircut, h.description, h.frontback FROM hairs AS h WHERE h.box_id = :box_id");
  $req->bindParam(':box_id',$box_id);
  $req->execute();
  $hairs = $req->fetchAll(PDO::FETCH_ASSOC);

  return $hairs;
}
/** Get a single hair with its internalid */
function get_singleHair($hair_id)
{
  global $bdd;

  $req = $bdd->prepare("SELECT h.internalid, h.box_id, b.name AS box_name, b.type AS box_type, h.nendoroid_id, n.name AS nendoroid_name, n.version AS nendoroid_version, h.main_color, h.main_color_hex, h.other_color, h.other_color_hex, h.haircut, h.description, h.frontback FROM hairs AS h LEFT JOIN boxes AS b ON h.box_id = b.internalid LEFT JOIN nendoroids AS n ON h.nendoroid_id = n.internalid WHERE h.internalid = :hair_id");
  $req->bindParam(':hair_id',$hair_id);
  $req->execute();
  $face = $req->fetch();

  return $face;
}
/** Add a single hair in the DB */
function add_singleHair($box_id,$nendoroid_id,$hair_main_color,$hair_main_color_hex,$hair_other_color,$hair_other_color_hex,$hair_haircut,$hair_frontback,$hair_description)
{
  global $bdd;

  $req = $bdd->prepare("INSERT INTO hairs(box_id,nendoroid_id,main_color,main_color_hex,other_color,other_color_hex,haircut,description,frontback) VALUES(:box_id,:nendoroid_id,:main_color,:main_color_hex,:other_color,:other_color_hex,:haircut,:description,:frontback)");
  $req->bindParam(':box_id',$box_id);
  $req->bindParam(':nendoroid_id',$nendoroid_id);
  $req->bindParam(':main_color',$hair_main_color);
  $req->bindParam(':main_color_hex',$hair_main_color_hex);
  $req->bindParam(':other_color',$hair_other_color);
  $req->bindParam(':other_color_hex',$hair_other_color_hex);
  $req->bindParam(':haircut',$hair_haircut);
  $req->bindParam(':frontback',$hair_frontback);
  $req->bindParam(':description',$hair_description);
  $req->execute();

  $hairinternalid = $bdd->lastInsertId();

  return $hairinternalid;
}
