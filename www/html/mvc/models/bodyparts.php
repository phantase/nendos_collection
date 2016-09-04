<?php
/** Count all the body parts available in the DB */
function count_allBodyParts()
{
  global $bdd;

  $req = $bdd->prepare("SELECT count(*) AS count
                        FROM body_parts AS bp");
  $req->execute();
  $count = $req->fetch();

  return $count['count'];
}
/** Get all the body parts available in the DB */
function get_allBodyParts($order="db_creationdate",$direction="desc")
{
  $orders = array("bodypart_part","bodypart_main_color","bodypart_other_color",
                  "nendoroid_name","nendoroid_version","nendoroid_sex",
                  "box_number","box_name","box_series",
                  "box_manufacturer","box_category","box_price",
                  "box_releasedate","box_sculptor","box_cooperation",
                  "db_creatorname","db_creationdate","db_editorname","db_editiondate");
  $key = array_search($order, $orders);
  $order = $orders[$key];
  $directions = array("asc","desc");
  $key = array_search($direction, $directions);
  $direction = $directions[$key];

  global $bdd;

  $req = $bdd->prepare("SELECT bp.internalid AS bodypart_internalid,
                        bp.main_color AS bodypart_main_color, bp.main_color_hex AS bodypart_main_color_hex,
                        bp.other_color AS bodypart_other_color, bp.other_color_hex AS bodypart_other_color_hex,
                        bp.part AS bodypart_part, bp.description AS bodypart_description,
                        n.internalid AS nendoroid_internalid,
                        n.name AS nendoroid_name, n.version AS nendoroid_version,
                        n.sex AS nendoroid_sex, n.dominant_color AS nendoroid_dominant_color,
                        b.internalid AS box_internalid,
                        b.number AS box_number, b.name AS box_name, b.series AS box_series,
                        b.manufacturer AS box_manufacturer, b.category AS box_category, b.price AS box_price,
                        b.releasedate AS box_releasedate, b.specifications AS box_specifications,
                        b.sculptor AS box_sculptor, b.cooperation AS box_cooperation,
                        b.officialurl AS box_officialurl,
                        bp.creatorid AS db_creatorid, uc.username AS db_creatorname, bp.creationdate AS db_creationdate,
                        bp.editorid AS db_editorid, ue.username AS db_editorname, bp.editiondate AS db_editiondate,
                        NOW() AS now
                        FROM bodyparts AS bp
                        LEFT JOIN nendoroids AS n ON bp.nendoroidid = n.internalid
                        LEFT JOIN boxes AS b ON bp.boxid = b.internalid
                        LEFT JOIN users AS uc ON bp.creatorid = uc.internalid
                        LEFT JOIN users AS ue ON bp.editorid = ue.internalid
                        ORDER BY $order $direction;");
  $req->execute();

  $resultInfo = $req->errorInfo();

  if( $resultInfo[0]=="00000" ){
    $resultInfo[4] = $req->fetchAll(PDO::FETCH_ASSOC);
  }

  return $resultInfo;
}
/** Count all the body parts available for a specific Nendoroid */
function count_nendoroidBodyParts($nendoroid_internalid)
{
  global $bdd;

  $req = $bdd->prepare("SELECT count(*) AS count
                        FROM body_parts AS bp
                        WHERE bp.nendoroidid = :nendoroid_internalid");
  $req->bindParam(':nendoroid_internalid',$nendoroid_internalid);
  $req->execute();
  $count = $req->fetch();

  return $count['count'];
}
/** Get all the body parts available for a specific Nendoroid */
function get_nendoroidBodyParts($nendoroid_internalid)
{
  global $bdd;

  $req = $bdd->prepare("SELECT bp.internalid AS bodypart_internalid,
                        bp.main_color AS bodypart_main_color, bp.main_color_hex AS bodypart_main_color_hex,
                        bp.other_color AS bodypart_other_color, bp.other_color_hex AS bodypart_other_color_hex,
                        bp.part AS bodypart_part, bp.description AS bodypart_description,
                        n.internalid AS nendoroid_internalid,
                        n.name AS nendoroid_name, n.version AS nendoroid_version,
                        n.sex AS nendoroid_sex, n.dominant_color AS nendoroid_dominant_color,
                        b.internalid AS box_internalid,
                        b.number AS box_number, b.name AS box_name, b.series AS box_series,
                        b.manufacturer AS box_manufacturer, b.category AS box_category, b.price AS box_price,
                        b.releasedate AS box_releasedate, b.specifications AS box_specifications,
                        b.sculptor AS box_sculptor, b.cooperation AS box_cooperation,
                        b.officialurl AS box_officialurl,
                        bp.creatorid AS db_creatorid, uc.username AS db_creatorname, bp.creationdate AS db_creationdate,
                        bp.editorid AS db_editorid, ue.username AS db_editorname, bp.editiondate AS db_editiondate,
                        NOW() AS now
                        FROM bodyparts AS bp
                        LEFT JOIN nendoroids AS n ON bp.nendoroidid = n.internalid
                        LEFT JOIN boxes AS b ON bp.boxid = b.internalid
                        LEFT JOIN users AS uc ON bp.creatorid = uc.internalid
                        LEFT JOIN users AS ue ON bp.editorid = ue.internalid
                        WHERE bp.nendoroidid = :nendoroid_internalid");
  $req->bindParam(':nendoroid_internalid',$nendoroid_internalid);
  $req->execute();

  $resultInfo = $req->errorInfo();

  if( $resultInfo[0]=="00000" ){
    $resultInfo[4] = $req->fetchAll(PDO::FETCH_ASSOC);
  }

  return $resultInfo;
}
/** Get all the body parts available for a specific Box */
function get_boxBodyParts($box_internalid)
{
  global $bdd;

  $req = $bdd->prepare("SELECT bp.internalid AS bodypart_internalid,
                        bp.main_color AS bodypart_main_color, bp.main_color_hex AS bodypart_main_color_hex,
                        bp.other_color AS bodypart_other_color, bp.other_color_hex AS bodypart_other_color_hex,
                        bp.part AS bodypart_part, bp.description AS bodypart_description,
                        n.internalid AS nendoroid_internalid,
                        n.name AS nendoroid_name, n.version AS nendoroid_version,
                        n.sex AS nendoroid_sex, n.dominant_color AS nendoroid_dominant_color,
                        b.internalid AS box_internalid,
                        b.number AS box_number, b.name AS box_name, b.series AS box_series,
                        b.manufacturer AS box_manufacturer, b.category AS box_category, b.price AS box_price,
                        b.releasedate AS box_releasedate, b.specifications AS box_specifications,
                        b.sculptor AS box_sculptor, b.cooperation AS box_cooperation,
                        b.officialurl AS box_officialurl,
                        bp.creatorid AS db_creatorid, uc.username AS db_creatorname, bp.creationdate AS db_creationdate,
                        bp.editorid AS db_editorid, ue.username AS db_editorname, bp.editiondate AS db_editiondate,
                        NOW() AS now
                        FROM bodyparts AS bp
                        LEFT JOIN nendoroids AS n ON bp.nendoroidid = n.internalid
                        LEFT JOIN boxes AS b ON bp.boxid = b.internalid
                        LEFT JOIN users AS uc ON bp.creatorid = uc.internalid
                        LEFT JOIN users AS ue ON bp.editorid = ue.internalid
                        WHERE bp.boxid = :box_internalid");
  $req->bindParam(':box_internalid',$box_internalid);
  $req->execute();

  $resultInfo = $req->errorInfo();

  if( $resultInfo[0]=="00000" ){
    $resultInfo[4] = $req->fetchAll(PDO::FETCH_ASSOC);
  }

  return $resultInfo;
}
/** Get a single bodypart with its internalid */
function get_singleBodypart($bodypart_internalid)
{
  global $bdd;

  $req = $bdd->prepare("SELECT bp.internalid AS bodypart_internalid,
                        bp.main_color AS bodypart_main_color, bp.main_color_hex AS bodypart_main_color_hex,
                        bp.other_color AS bodypart_other_color, bp.other_color_hex AS bodypart_other_color_hex,
                        bp.part AS bodypart_part, bp.description AS bodypart_description,
                        n.internalid AS nendoroid_internalid,
                        n.name AS nendoroid_name, n.version AS nendoroid_version,
                        n.sex AS nendoroid_sex, n.dominant_color AS nendoroid_dominant_color,
                        b.internalid AS box_internalid,
                        b.number AS box_number, b.name AS box_name, b.series AS box_series,
                        b.manufacturer AS box_manufacturer, b.category AS box_category, b.price AS box_price,
                        b.releasedate AS box_releasedate, b.specifications AS box_specifications,
                        b.sculptor AS box_sculptor, b.cooperation AS box_cooperation,
                        b.officialurl AS box_officialurl,
                        bp.creatorid AS db_creatorid, uc.username AS db_creatorname, bp.creationdate AS db_creationdate,
                        bp.editorid AS db_editorid, ue.username AS db_editorname, bp.editiondate AS db_editiondate,
                        NOW() AS now
                        FROM bodyparts AS bp
                        LEFT JOIN nendoroids AS n ON bp.nendoroidid = n.internalid
                        LEFT JOIN boxes AS b ON bp.boxid = b.internalid
                        LEFT JOIN users AS uc ON bp.creatorid = uc.internalid
                        LEFT JOIN users AS ue ON bp.editorid = ue.internalid
                        WHERE bp.internalid = :bodypart_internalid");
  $req->bindParam(':bodypart_internalid',$bodypart_internalid);
  $req->execute();

  $resultInfo = $req->errorInfo();

  if( $resultInfo[0]=="00000" ){
    $resultInfo[4] = $req->fetchAll(PDO::FETCH_ASSOC);
  }

  return $resultInfo;
}
/** Add a single bodypart in the DB */
function add_singleBodypart($box_internalid,$nendoroid_internalid,
                            $bodypart_main_color,$bodypart_main_color_hex,
                            $bodypart_other_color,$bodypart_other_color_hex,
                            $bodypart_part,$bodypart_description,
                            $userid)
{
  global $bdd;

  $req = $bdd->prepare("INSERT INTO body_parts(boxid,nendoroidid,
                                              main_color,main_color_hex,
                                              other_color,other_color_hex,
                                              part,description,
                                              creatorid,creationdate,editorid,editiondate)
                        VALUES(:box_internalid,:nendoroid_internalid,
                              :main_color,:main_color_hex,
                              :other_color,:other_color_hex,
                              :part,:description,
                              :creatorid,NOW(),:editorid,NOW())");
  $req->bindParam(':box_internalid',$box_internalid);
  $req->bindParam(':nendoroid_internalid',$nendoroid_internalid);
  $req->bindParam(':main_color',$bodypart_main_color);
  $req->bindParam(':main_color_hex',$bodypart_main_color_hex);
  $req->bindParam(':other_color',$bodypart_other_color);
  $req->bindParam(':other_color_hex',$bodypart_other_color_hex);
  $req->bindParam(':part',$bodypart_part);
  $req->bindParam(':description',$bodypart_description);
  $req->bindParam(':creatorid',$userid);
  $req->bindParam(':editorid',$userid);
  $req->execute();

  $resultInfo = $req->errorInfo();

  if( $resultInfo[0]=="00000" ){
    $resultInfo[4] = $bdd->lastInsertId();
  }

  return $resultInfo;
}
