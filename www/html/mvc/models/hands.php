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
function get_allHands($order="db_creationdate",$direction="desc",$userid=null)
{
  $orders = array("hand_posture","hand_skin_color","hand_leftright",
                  "nendoroid_name","nendoroid_version","nendoroid_sex",
                  "box_number","box_name","box_series",
                  "box_manufacturer","box_category","box_price",
                  "box_releasedate","box_sculptor","box_cooperation",
                  "db_creatorname","db_creationdate","db_editorname","db_editiondate","db_validatorname","db_validationdate");
  $key = array_search($order, $orders);
  $order = $orders[$key];
  $directions = array("asc","desc");
  $key = array_search($direction, $directions);
  $direction = $directions[$key];

  global $bdd;

  $req = $bdd->prepare("SELECT h.internalid AS hand_internalid,
                        h.skin_color AS hand_skin_color,
                        h.leftright AS hand_leftright, h.posture AS hand_posture,
                        h.description AS hand_description,
                        n.internalid AS nendoroid_internalid,
                        n.name AS nendoroid_name, n.version AS nendoroid_version,
                        n.sex AS nendoroid_sex, n.dominant_color AS nendoroid_dominant_color,
                        b.internalid AS box_internalid,
                        b.number AS box_number, b.name AS box_name, b.series AS box_series,
                        b.manufacturer AS box_manufacturer, b.category AS box_category, b.price AS box_price,
                        b.releasedate AS box_releasedate, b.specifications AS box_specifications,
                        b.sculptor AS box_sculptor, b.cooperation AS box_cooperation,
                        b.officialurl AS box_officialurl,
                        h.creatorid AS db_creatorid, uc.username AS db_creatorname, h.creationdate AS db_creationdate,
                        h.editorid AS db_editorid, ue.username AS db_editorname, h.editiondate AS db_editiondate,
                        h.validatorid AS db_validatorid, uv.username AS db_validatorname, h.validationdate AS db_validationdate,
                        uc.additiondate AS coll_additiondate,
                        NOW() AS now
                        FROM hands AS h
                        LEFT JOIN nendoroids AS n ON h.nendoroidid = n.internalid
                        LEFT JOIN boxes AS b ON h.boxid = b.internalid
                        LEFT JOIN users AS uc ON h.creatorid = uc.internalid
                        LEFT JOIN users AS ue ON h.editorid = ue.internalid
                        LEFT JOIN users AS uv ON h.validatorid = uv.internalid
                        LEFT JOIN (
                          SELECT internalid, userid, handid, additiondate
                          FROM users_hands_collection
                          WHERE userid = :userid
                          ) AS uc ON h.internalid = uc.handid
                        ORDER BY $order $direction;");
  $req->bindParam(":userid",$userid);
  $req->execute();

  $resultInfo = $req->errorInfo();

  if( $resultInfo[0]=="00000" ){
    $resultInfo[4] = $req->fetchAll(PDO::FETCH_ASSOC);
  }

  return $resultInfo;
}
/** Count all the Hands available for a specific Nendoroid */
function count_nendoroidHands($nendoroid_internalid)
{
  global $bdd;

  $req = $bdd->prepare("SELECT count(*) AS count
                        FROM hands AS h
                        WHERE h.nendoroidid = :nendoroid_internalid");
  $req->bindParam(':nendoroid_internalid',$nendoroid_internalid);
  $req->execute();
  $count = $req->fetch();

  return $count['count'];
}
/** Get all the Hands available for a specific Nendoroid */
function get_nendoroidHands($nendoroid_internalid)
{
  global $bdd;

  $req = $bdd->prepare("SELECT h.internalid AS hand_internalid,
                        h.skin_color AS hand_skin_color,
                        h.leftright AS hand_leftright, h.posture AS hand_posture,
                        h.description AS hand_description,
                        n.internalid AS nendoroid_internalid,
                        n.name AS nendoroid_name, n.version AS nendoroid_version,
                        n.sex AS nendoroid_sex, n.dominant_color AS nendoroid_dominant_color,
                        b.internalid AS box_internalid,
                        b.number AS box_number, b.name AS box_name, b.series AS box_series,
                        b.manufacturer AS box_manufacturer, b.category AS box_category, b.price AS box_price,
                        b.releasedate AS box_releasedate, b.specifications AS box_specifications,
                        b.sculptor AS box_sculptor, b.cooperation AS box_cooperation,
                        b.officialurl AS box_officialurl,
                        h.creatorid AS db_creatorid, uc.username AS db_creatorname, h.creationdate AS db_creationdate,
                        h.editorid AS db_editorid, ue.username AS db_editorname, h.editiondate AS db_editiondate,
                        h.validatorid AS db_validatorid, uv.username AS db_validatorname, h.validationdate AS db_validationdate,
                        NOW() AS now
                        FROM hands AS h
                        LEFT JOIN nendoroids AS n ON h.nendoroidid = n.internalid
                        LEFT JOIN boxes AS b ON h.boxid = b.internalid
                        LEFT JOIN users AS uc ON h.creatorid = uc.internalid
                        LEFT JOIN users AS ue ON h.editorid = ue.internalid
                        LEFT JOIN users AS uv ON h.validatorid = uv.internalid
                        WHERE h.nendoroidid = :nendoroid_internalid");
  $req->bindParam(':nendoroid_internalid',$nendoroid_internalid);
  $req->execute();

  $resultInfo = $req->errorInfo();

  if( $resultInfo[0]=="00000" ){
    $resultInfo[4] = $req->fetchAll(PDO::FETCH_ASSOC);
  }

  return $resultInfo;
}
/** Get all the Hands available for a specific Box */
function get_boxHands($box_internalid,$userid=null)
{
  global $bdd;

  $req = $bdd->prepare("SELECT h.internalid AS hand_internalid,
                        h.skin_color AS hand_skin_color,
                        h.leftright AS hand_leftright, h.posture AS hand_posture,
                        h.description AS hand_description,
                        n.internalid AS nendoroid_internalid,
                        n.name AS nendoroid_name, n.version AS nendoroid_version,
                        n.sex AS nendoroid_sex, n.dominant_color AS nendoroid_dominant_color,
                        b.internalid AS box_internalid,
                        b.number AS box_number, b.name AS box_name, b.series AS box_series,
                        b.manufacturer AS box_manufacturer, b.category AS box_category, b.price AS box_price,
                        b.releasedate AS box_releasedate, b.specifications AS box_specifications,
                        b.sculptor AS box_sculptor, b.cooperation AS box_cooperation,
                        b.officialurl AS box_officialurl,
                        h.creatorid AS db_creatorid, uc.username AS db_creatorname, h.creationdate AS db_creationdate,
                        h.editorid AS db_editorid, ue.username AS db_editorname, h.editiondate AS db_editiondate,
                        h.validatorid AS db_validatorid, uv.username AS db_validatorname, h.validationdate AS db_validationdate,
                        uc.additiondate AS coll_additiondate,
                        NOW() AS now
                        FROM hands AS h
                        LEFT JOIN nendoroids AS n ON h.nendoroidid = n.internalid
                        LEFT JOIN boxes AS b ON h.boxid = b.internalid
                        LEFT JOIN users AS uc ON h.creatorid = uc.internalid
                        LEFT JOIN users AS ue ON h.editorid = ue.internalid
                        LEFT JOIN users AS uv ON h.validatorid = uv.internalid
                        LEFT JOIN (
                          SELECT internalid, userid, handid, additiondate
                          FROM users_hands_collection
                          WHERE userid = :userid
                          ) AS uc ON h.internalid = uc.handid
                        WHERE h.boxid = :box_internalid");
  $req->bindParam(":userid",$userid);
  $req->bindParam(':box_internalid',$box_internalid);
  $req->execute();

  $resultInfo = $req->errorInfo();

  if( $resultInfo[0]=="00000" ){
    $resultInfo[4] = $req->fetchAll(PDO::FETCH_ASSOC);
  }

  return $resultInfo;
}
/** Get a single hair with its internalid */
function get_singleHand($hand_internalid)
{
  global $bdd;

  $req = $bdd->prepare("SELECT h.internalid AS hand_internalid,
                        h.skin_color AS hand_skin_color,
                        h.leftright AS hand_leftright, h.posture AS hand_posture,
                        h.description AS hand_description,
                        n.internalid AS nendoroid_internalid,
                        n.name AS nendoroid_name, n.version AS nendoroid_version,
                        n.sex AS nendoroid_sex, n.dominant_color AS nendoroid_dominant_color,
                        b.internalid AS box_internalid,
                        b.number AS box_number, b.name AS box_name, b.series AS box_series,
                        b.manufacturer AS box_manufacturer, b.category AS box_category, b.price AS box_price,
                        b.releasedate AS box_releasedate, b.specifications AS box_specifications,
                        b.sculptor AS box_sculptor, b.cooperation AS box_cooperation,
                        b.officialurl AS box_officialurl,
                        h.creatorid AS db_creatorid, uc.username AS db_creatorname, h.creationdate AS db_creationdate,
                        h.editorid AS db_editorid, ue.username AS db_editorname, h.editiondate AS db_editiondate,
                        h.validatorid AS db_validatorid, uv.username AS db_validatorname, h.validationdate AS db_validationdate,
                        NOW() AS now
                        FROM hands AS h
                        LEFT JOIN nendoroids AS n ON h.nendoroidid = n.internalid
                        LEFT JOIN boxes AS b ON h.boxid = b.internalid
                        LEFT JOIN users AS uc ON h.creatorid = uc.internalid
                        LEFT JOIN users AS ue ON h.editorid = ue.internalid
                        LEFT JOIN users AS uv ON h.validatorid = uv.internalid
                        WHERE h.internalid = :hand_internalid");
  $req->bindParam(':hand_internalid',$hand_internalid);
  $req->execute();

  $resultInfo = $req->errorInfo();

  if( $resultInfo[0]=="00000" ){
    $resultInfo[4] = $req->fetch();
  }

  return $resultInfo;
}
/** Add a single hair in the DB */
function add_singleHand($box_internalid,$nendoroid_internalid,
                        $hand_skin_color,
                        $hand_leftright,$hand_posture,
                        $hand_description,
                        $userid)
{
  global $bdd;

  $req = $bdd->prepare("INSERT INTO hands(boxid,nendoroidid,
                                          skin_color,
                                          leftright,posture,
                                          description,
                                          creatorid,creationdate,editorid,editiondate)
                        VALUES(:box_internalid,:nendoroid_internalid,
                              :skin_color,
                              :leftright,:posture,
                              :description,
                              :creatorid,NOW(),:editorid,NOW())");
  $req->bindParam(':box_internalid',$box_internalid);
  $req->bindParam(':nendoroid_internalid',$nendoroid_internalid);
  $req->bindParam(':skin_color',$hand_skin_color);
  $req->bindParam(':leftright',$hand_leftright);
  $req->bindParam(':posture',$hand_posture);
  $req->bindParam(':description',$hand_description);
  $req->bindParam(':creatorid',$userid);
  $req->bindParam(':editorid',$userid);
  $req->execute();

  $resultInfo = $req->errorInfo();

  if( $resultInfo[0]=="00000" ){
    $resultInfo[4] = $bdd->lastInsertId();
  }

  return $resultInfo;
}
/** Retrieve the vocabularies of a field of the hands */
function getHandsVocabulary($field,$order="alphabetical",$direction="ASC",$withnull=false)
{
  $fields = array("posture","skin_color");
  $key = array_search($field, $fields);
  $field = $fields[$key];

  if(!$withnull){
    $where = "WHERE $field IS NOT NULL ";
  }

  global $bdd;

  $req = $bdd->prepare("SELECT $field AS field, count(*) AS count
                        FROM hands
                        $where
                        GROUP BY field
                        ORDER BY field $direction");
  $req->execute();

  $resultInfo = $req->errorInfo();

  if( $resultInfo[0]=="00000" ){
    $resultInfo[4] = $req->fetchAll(PDO::FETCH_ASSOC);
  }

  return $resultInfo;
}
