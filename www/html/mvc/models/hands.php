<?php
/** Count all the Hands available in the DB */
function count_allHands()
{
  global $bdd;

  $req = $bdd->prepare("SELECT count(*) AS count
                        FROM hands AS h");
  $req->execute();
  $count = $req->fetch();

  return $count['count'];
}
/** Get all the Hands available in the DB */
function get_allHands()
{
  global $bdd;

  $req = $bdd->prepare("SELECT h.internalid, h.box_id, h.nendoroid_id,
                        h.skin_color, h.skin_color_hex,
                        h.leftright, h.posture, h.description
                        FROM hands AS h");
  $req->execute();
  $hands = $req->fetchAll(PDO::FETCH_ASSOC);

  return $hands;
}
/** Count all the Hands available for a specific Nendoroid */
function count_nendoroidHands($nendoroid_id)
{
  global $bdd;

  $req = $bdd->prepare("SELECT count(*) AS count
                        FROM hands AS h
                        WHERE h.nendoroid_id = :nendoroid_id");
  $req->bindParam(':nendoroid_id',$nendoroid_id);
  $req->execute();
  $count = $req->fetch();

  return $count['count'];
}
/** Get all the Hands available for a specific Nendoroid */
function get_nendoroidHands($nendoroid_id)
{
  global $bdd;

  $req = $bdd->prepare("SELECT h.internalid, h.box_id, h.nendoroid_id,
                        h.skin_color, h.skin_color_hex,
                        h.leftright, h.posture, h.description
                        FROM hands AS h
                        WHERE h.nendoroid_id = :nendoroid_id");
  $req->bindParam(':nendoroid_id',$nendoroid_id);
  $req->execute();
  $hands = $req->fetchAll(PDO::FETCH_ASSOC);

  return $hands;
}
/** Get all the Hands available for a specific Box */
function get_boxHands($box_id)
{
  global $bdd;

  $req = $bdd->prepare("SELECT h.internalid, h.box_id, h.nendoroid_id,
                        h.skin_color, h.skin_color_hex,
                        h.leftright, h.posture, h.description
                        FROM hands AS h
                        WHERE h.box_id = :box_id");
  $req->bindParam(':box_id',$box_id);
  $req->execute();
  $hands = $req->fetchAll(PDO::FETCH_ASSOC);

  return $hands;
}
/** Get a single hair with its internalid */
function get_singleHand($hand_id)
{
  global $bdd;

  $req = $bdd->prepare("SELECT h.internalid,
                        h.box_id, b.name AS box_name, b.type AS box_type,
                        h.nendoroid_id, n.name AS nendoroid_name, n.version AS nendoroid_version,
                        h.skin_color, h.skin_color_hex,
                        h.leftright, h.description, h.posture,
                        h.creator, uc.username AS creator_name, h.creation,
                        h.editor, ue.username AS editor_name, h.edition,
                        NOW() AS now
                        FROM hands AS h
                        LEFT JOIN boxes AS b ON h.box_id = b.internalid
                        LEFT JOIN nendoroids AS n ON h.nendoroid_id = n.internalid
                        LEFT JOIN users AS uc ON h.creator = uc.internalid
                        LEFT JOIN users AS ue ON h.editor = ue.internalid
                        WHERE h.internalid = :hand_id");
  $req->bindParam(':hand_id',$hand_id);
  $req->execute();
  $face = $req->fetch();

  return $face;
}
/** Add a single hair in the DB */
function add_singleHand($box_id,$nendoroid_id,$hand_skin_color,$hand_skin_color_hex,$hand_leftright,$hand_posture,$hand_description,$userid)
{
  global $bdd;

  $req = $bdd->prepare("INSERT INTO hands(box_id,nendoroid_id,skin_color,skin_color_hex,leftright,posture,description,creator,creation,editor,edition)
                        VALUES(:box_id,:nendoroid_id,:skin_color,:skin_color_hex,:leftright,:posture,:description,:creator,NOW(),:editor,NOW())");
  $req->bindParam(':box_id',$box_id);
  $req->bindParam(':nendoroid_id',$nendoroid_id);
  $req->bindParam(':skin_color',$hand_skin_color);
  $req->bindParam(':skin_color_hex',$hand_skin_color_hex);
  $req->bindParam(':leftright',$hand_leftright);
  $req->bindParam(':posture',$hand_posture);
  $req->bindParam(':description',$hand_description);
  $req->bindParam(':creator',$userid);
  $req->bindParam(':editor',$userid);
  $req->execute();

  $handinternalid = $bdd->lastInsertId();

  return $handinternalid;
}
