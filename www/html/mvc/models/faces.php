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
/** Get all the faces available for a specific Box */
function get_boxFaces($box_id)
{
  global $bdd;

  $req = $bdd->prepare("SELECT f.internalid, f.box_id, f.nendoroid_id, f.eyes, f.eyes_color, f.eyes_color_hex, f.mouth, f.skin_color, f.skin_color_hex, f.sex FROM faces AS f WHERE f.box_id = :box_id");
  $req->bindParam(':box_id',$box_id);
  $req->execute();
  $faces = $req->fetchAll(PDO::FETCH_ASSOC);

  return $faces;
}
/** Get a single face with its internalid */
function get_singleFace($face_id)
{
  global $bdd;

  $req = $bdd->prepare("SELECT f.internalid, f.box_id, b.name AS box_name, b.type AS box_type, f.nendoroid_id, n.name AS nendoroid_name, n.version AS nendoroid_version, f.eyes, f.eyes_color, f.eyes_color_hex, f.mouth, f.skin_color, f.skin_color_hex, f.sex, f.creator, uc.username AS creator_name, f.creation, f.editor, ue.username AS editor_name, f.edition, NOW() AS now  FROM faces AS f LEFT JOIN boxes AS b ON f.box_id = b.internalid LEFT JOIN nendoroids AS n ON f.nendoroid_id = n.internalid LEFT JOIN users AS uc ON f.creator = uc.internalid LEFT JOIN users AS ue ON f.editor = ue.internalid WHERE f.internalid = :face_id");
  $req->bindParam(':face_id',$face_id);
  $req->execute();
  $face = $req->fetch();

  return $face;
}
/** Add a single face in the DB */
function add_singleFace($box_id,$nendoroid_id,$face_eyes,$face_eyes_color,$face_eyes_color_hex,$face_mouth,$face_skin_color,$face_skin_color_hex,$face_sex)
{
  global $bdd;

  $req = $bdd->prepare("INSERT INTO faces(box_id,nendoroid_id,eyes,eyes_color,eyes_color_hex,mouth,skin_color,skin_color_hex,sex) VALUES(:box_id,:nendoroid_id,:eyes,:eyes_color,:eyes_color_hex,:mouth,:skin_color,:skin_color_hex,:sex)");
  $req->bindParam(':box_id',$box_id);
  $req->bindParam(':nendoroid_id',$nendoroid_id);
  $req->bindParam(':eyes',$face_eyes);
  $req->bindParam(':eyes_color',$face_eyes_color);
  $req->bindParam(':eyes_color_hex',$face_eyes_color_hex);
  $req->bindParam(':mouth',$face_mouth);
  $req->bindParam(':skin_color',$face_skin_color);
  $req->bindParam(':skin_color_hex',$face_skin_color_hex);
  $req->bindParam(':sex',$face_sex);
  $req->execute();

  $faceinternalid = $bdd->lastInsertId();

  return $faceinternalid;
}
