<?php
/** Count all the body parts available in the DB */
function count_allBodyParts()
{
  global $bdd;

  $req = $bdd->prepare("SELECT count(*) As count FROM body_parts AS bp");
  $req->execute();
  $count = $req->fetch();

  return $count['count'];
}
/** Get all the body parts available in the DB */
function get_allBodyParts()
{
  global $bdd;

  $req = $bdd->prepare("SELECT bp.internalid, bp.box_id, bp.nendoroid_id, bp.part, bp.main_color, bp.main_color_hex, bp.second_color, bp.second_color_hex, bp.description FROM body_parts AS bp");
  $req->execute();
  $body_parts = $req->fetchAll(PDO::FETCH_ASSOC);

  return $body_parts;
}
/** Count all the body parts available for a specific Nendoroid */
function count_nendoroidBodyParts($nendoroid_id)
{
  global $bdd;

  $req = $bdd->prepare("SELECT count(*) As count FROM body_parts AS bp WHERE bp.nendoroid_id = :nendoroid_id");
  $req->bindParam(':nendoroid_id',$nendoroid_id);
  $req->execute();
  $count = $req->fetch();

  return $count['count'];
}
/** Get all the body parts available for a specific Nendoroid */
function get_nendoroidBodyParts($nendoroid_id)
{
  global $bdd;

  $req = $bdd->prepare("SELECT bp.internalid, bp.box_id, bp.nendoroid_id, bp.part, bp.main_color, bp.main_color_hex, bp.second_color, bp.second_color_hex, bp.description FROM body_parts AS bp WHERE bp.nendoroid_id = :nendoroid_id");
  $req->bindParam(':nendoroid_id',$nendoroid_id);
  $req->execute();
  $body_parts = $req->fetchAll(PDO::FETCH_ASSOC);

  return $body_parts;
}
/** Get all the body parts available for a specific Box */
function get_boxBodyParts($box_id)
{
  global $bdd;

  $req = $bdd->prepare("SELECT bp.internalid, bp.box_id, bp.nendoroid_id, bp.part, bp.main_color, bp.main_color_hex, bp.second_color, bp.second_color_hex, bp.description FROM body_parts AS bp WHERE bp.box_id = :box_id");
  $req->bindParam(':box_id',$box_id);
  $req->execute();
  $body_parts = $req->fetchAll(PDO::FETCH_ASSOC);

  return $body_parts;
}
/** Get a single bodypart with its internalid */
function get_singleBodypart($bodypart_id)
{
  global $bdd;

  $req = $bdd->prepare("SELECT bp.internalid, bp.box_id, b.name AS box_name, b.type AS box_type, bp.nendoroid_id, n.name AS nendoroid_name, n.version AS nendoroid_version, bp.main_color, bp.main_color_hex, bp.second_color, bp.second_color_hex, bp.part, bp.description, bp.creator, uc.username AS creator_name, bp.creation, bp.editor, ue.username AS editor_name, bp.edition, NOW() AS now  FROM body_parts AS bp LEFT JOIN boxes AS b ON bp.box_id = b.internalid LEFT JOIN nendoroids AS n ON bp.nendoroid_id = n.internalid LEFT JOIN users AS uc ON bp.creator = uc.internalid LEFT JOIN users AS ue ON bp.editor = ue.internalid WHERE bp.internalid = :bodypart_id");
  $req->bindParam(':bodypart_id',$bodypart_id);
  $req->execute();
  $bodypart = $req->fetch();

  return $bodypart;
}
/** Add a single bodypart in the DB */
function add_singleBodypart($box_id,$nendoroid_id,$bodypart_main_color,$bodypart_main_color_hex,$bodypart_second_color,$bodypart_second_color_hex,$bodypart_part,$bodypart_description)
{
  global $bdd;

  $req = $bdd->prepare("INSERT INTO body_parts(box_id,nendoroid_id,main_color,main_color_hex,second_color,second_color_hex,part,description) VALUES(:box_id,:nendoroid_id,:main_color,:main_color_hex,:second_color,:second_color_hex,:part,:description)");
  $req->bindParam(':box_id',$box_id);
  $req->bindParam(':nendoroid_id',$nendoroid_id);
  $req->bindParam(':main_color',$bodypart_main_color);
  $req->bindParam(':main_color_hex',$bodypart_main_color_hex);
  $req->bindParam(':second_color',$bodypart_second_color);
  $req->bindParam(':second_color_hex',$bodypart_second_color_hex);
  $req->bindParam(':part',$bodypart_part);
  $req->bindParam(':description',$bodypart_description);
  $req->execute();

  $bodypartinternalid = $bdd->lastInsertId();

  return $bodypartinternalid;
}
