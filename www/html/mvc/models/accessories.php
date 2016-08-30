<?php
/** Count all the accessories available in the DB */
function count_allAccessories()
{
  global $bdd;

  $req = $bdd->prepare("SELECT count(*) As count FROM accessories AS a");
  $req->execute();
  $count = $req->fetch();

  return $count['count'];
}
/** Get all the accessories available in the DB */
function get_allAccessories()
{
  global $bdd;

  $req = $bdd->prepare("SELECT a.internalid, a.box_id, a.nendoroid_id, a.type, a.main_color, a.main_color_hex, a.other_color, a.other_color_hex, a.description FROM accessories AS a");
  $req->execute();
  $accessories = $req->fetchAll(PDO::FETCH_ASSOC);

  return $accessories;
}
/** Count all the accessories available for a specific Nendoroid */
function count_nendoroidAccessories($nendoroid_id)
{
  global $bdd;

  $req = $bdd->prepare("SELECT count(*) As count FROM accessories AS a WHERE a.nendoroid_number = :nendoroid_id");
  $req->bindParam(':nendoroid_id',$nendoroid_id);
  $req->execute();
  $count = $req->fetch();

  return $count['count'];
}
/** Get all the accessories available for a specific Nendoroid */
function get_nendoroidAccessories($nendoroid_id)
{
  global $bdd;

  $req = $bdd->prepare("SELECT a.internalid, a.box_id, a.nendoroid_id, a.type, a.main_color, a.main_color_hex, a.other_color, a.other_color_hex, a.description FROM accessories AS a WHERE a.nendoroid_id = :nendoroid_id");
  $req->bindParam(':nendoroid_id',$nendoroid_id);
  $req->execute();
  $accessories = $req->fetchAll(PDO::FETCH_ASSOC);

  return $accessories;
}
/** Get all the accessories available for a specific Box */
function get_boxAccessories($box_id)
{
  global $bdd;

  $req = $bdd->prepare("SELECT a.internalid, a.box_id, a.nendoroid_id, a.type, a.main_color, a.main_color_hex, a.other_color, a.other_color_hex, a.description FROM accessories AS a WHERE a.box_id = :box_id");
  $req->bindParam(':box_id',$box_id);
  $req->execute();
  $accessories = $req->fetchAll(PDO::FETCH_ASSOC);

  return $accessories;
}
/** Get a single accessory with its internalid */
function get_singleAccessory($accessory_id)
{
  global $bdd;

  $req = $bdd->prepare("SELECT a.internalid, a.box_id, b.name AS box_name, b.type AS box_type, a.nendoroid_id, n.name AS nendoroid_name, n.version AS nendoroid_version, a.type, a.main_color, a.main_color_hex, a.other_color, a.other_color_hex, a.description, a.creator, uc.username AS creator_name, a.creation, a.editor, ue.username AS editor_name, a.edition, NOW() AS now FROM accessories AS a LEFT JOIN boxes AS b ON a.box_id = b.internalid LEFT JOIN nendoroids AS n ON a.nendoroid_id = n.internalid LEFT JOIN users AS uc ON a.creator = uc.internalid LEFT JOIN users AS ue ON a.editor = ue.internalid WHERE a.internalid = :accessory_id");
  $req->bindParam(':accessory_id',$accessory_id);
  $req->execute();
  $bodypart = $req->fetch();

  return $bodypart;
}
/** Add a single accessory in the DB */
function add_singleAccessory($box_id,$nendoroid_id,$accessory_type,$accessory_main_color,$accessory_main_color_hex,$accessory_other_color,$accessory_other_color_hex,$accessory_description,$userid)
{
  global $bdd;

  $req = $bdd->prepare("INSERT INTO accessories(box_id,nendoroid_id,type,main_color,main_color_hex,other_color,other_color_hex,description,creator,creation,editor,edition) VALUES(:box_id,:nendoroid_id,:type,:main_color,:main_color_hex,:other_color,:other_color_hex,:description,:creator,NOW(),:editor,NOW())");
  $req->bindParam(':box_id',$box_id);
  $req->bindParam(':nendoroid_id',$nendoroid_id);
  $req->bindParam(':type',$accessory_type);
  $req->bindParam(':main_color',$accessory_main_color);
  $req->bindParam(':main_color_hex',$accessory_main_color_hex);
  $req->bindParam(':other_color',$accessory_other_color);
  $req->bindParam(':other_color_hex',$accessory_other_color_hex);
  $req->bindParam(':description',$accessory_description);
  $req->bindParam(':creator',$userid);
  $req->bindParam(':editor',$userid);
  $req->execute();

  $accessoryinternalid = $bdd->lastInsertId();

  return $accessoryinternalid;
}
