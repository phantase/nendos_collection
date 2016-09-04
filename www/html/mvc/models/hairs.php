<?php
/** Count all the Hairs available in the DB */
function count_allHairs()
{
  global $bdd;

  $req = $bdd->prepare("SELECT count(*) AS count
                        FROM hairs AS h");
  $req->execute();
  $count = $req->fetch();

  return $count['count'];
}
/** Get all the Hairs available in the DB */
function get_allHairs($order="db_creationdate",$direction="desc")
{
  $orders = array("hair_haircut","hair_main_color","hair_other_color","hair_frontback",
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

  $req = $bdd->prepare("SELECT h.internalid AS hair_internalid,
                        h.main_color AS hair_main_color, h.main_color_hex AS hair_main_color_hex,
                        h.other_color AS hair_other_color, h.other_color_hex AS hair_other_color_hex,
                        h.haircut AS hair_haircut, h.description AS hair_description, h.frontback AS hair_frontback,
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
                        NOW() AS now
                        FROM hairs AS h
                        LEFT JOIN nendoroids AS n ON h.nendoroidid = n.internalid
                        LEFT JOIN boxes AS b ON h.boxid = b.internalid
                        LEFT JOIN users AS uc ON h.creatorid = uc.internalid
                        LEFT JOIN users AS ue ON h.editorid = ue.internalid
                        ORDER BY $order $direction;");
  $req->execute();

  $resultInfo = $req->errorInfo();

  if( $resultInfo[0]=="00000" ){
    $resultInfo[4] = $req->fetchAll(PDO::FETCH_ASSOC);
  }

  return $resultInfo;
}
/** Count all the Hairs for a specific Nendoroid */
function count_nendoroidHairs($nendoroid_internalid)
{
  global $bdd;

  $req = $bdd->prepare("SELECT count(*) AS count
                        FROM hairs AS h
                        WHERE h.nendoroidid = :nendoroid_internalid");
  $req->bindParam(':nendoroid_internalid',$nendoroid_internalid);
  $req->execute();
  $count = $req->fetch();

  return $count['count'];
}
/** Get all the Hairs available for a specific Nendoroid */
function get_nendoroidHairs($nendoroid_internalid)
{
  global $bdd;

  $req = $bdd->prepare("SELECT h.internalid AS hair_internalid,
                        h.main_color AS hair_main_color, h.main_color_hex AS hair_main_color_hex,
                        h.other_color AS hair_other_color, h.other_color_hex AS hair_other_color_hex,
                        h.haircut AS hair_haircut, h.description AS hair_description, h.frontback AS hair_frontback,
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
                        NOW() AS now
                        FROM hairs AS h
                        LEFT JOIN nendoroids AS n ON h.nendoroidid = n.internalid
                        LEFT JOIN boxes AS b ON h.boxid = b.internalid
                        LEFT JOIN users AS uc ON h.creatorid = uc.internalid
                        LEFT JOIN users AS ue ON h.editorid = ue.internalid
                        WHERE h.nendoroidid = :nendoroid_internalid");
  $req->bindParam(':nendoroid_internalid',$nendoroid_internalid);
  $req->execute();

  $resultInfo = $req->errorInfo();

  if( $resultInfo[0]=="00000" ){
    $resultInfo[4] = $req->fetchAll(PDO::FETCH_ASSOC);
  }

  return $resultInfo;
}
/** Get all the Hairs available for a specific Box */
function get_boxHairs($box_internalid)
{
  global $bdd;

  $req = $bdd->prepare("SELECT h.internalid AS hair_internalid,
                        h.main_color AS hair_main_color, h.main_color_hex AS hair_main_color_hex,
                        h.other_color AS hair_other_color, h.other_color_hex AS hair_other_color_hex,
                        h.haircut AS hair_haircut, h.description AS hair_description, h.frontback AS hair_frontback,
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
                        NOW() AS now
                        FROM hairs AS h
                        LEFT JOIN nendoroids AS n ON h.nendoroidid = n.internalid
                        LEFT JOIN boxes AS b ON h.boxid = b.internalid
                        LEFT JOIN users AS uc ON h.creatorid = uc.internalid
                        LEFT JOIN users AS ue ON h.editorid = ue.internalid
                        WHERE h.boxid = :box_internalid");
  $req->bindParam(':box_internalid',$box_internalid);
  $req->execute();

  $resultInfo = $req->errorInfo();

  if( $resultInfo[0]=="00000" ){
    $resultInfo[4] = $req->fetchAll(PDO::FETCH_ASSOC);
  }

  return $resultInfo;
}
/** Get a single hair with its internalid */
function get_singleHair($hair_internalid)
{
  global $bdd;

  $req = $bdd->prepare("SELECT h.internalid AS hair_internalid,
                        h.main_color AS hair_main_color, h.main_color_hex AS hair_main_color_hex,
                        h.other_color AS hair_other_color, h.other_color_hex AS hair_other_color_hex,
                        h.haircut AS hair_haircut, h.description AS hair_description, h.frontback AS hair_frontback,
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
                        NOW() AS now
                        FROM hairs AS h
                        LEFT JOIN nendoroids AS n ON h.nendoroidid = n.internalid
                        LEFT JOIN boxes AS b ON h.boxid = b.internalid
                        LEFT JOIN users AS uc ON h.creatorid = uc.internalid
                        LEFT JOIN users AS ue ON h.editorid = ue.internalid
                        WHERE h.internalid = :hair_internalid");
  $req->bindParam(':hair_internalid',$hair_internalid);
  $req->execute();

  $resultInfo = $req->errorInfo();

  if( $resultInfo[0]=="00000" ){
    $resultInfo[4] = $req->fetch();
  }

  return $resultInfo;
}
/** Add a single hair in the DB */
function add_singleHair($box_internalid,$nendoroid_internalid,
                        $hair_main_color,$hair_main_color_hex,
                        $hair_other_color,$hair_other_color_hex,
                        $hair_haircut,$hair_description,$hair_frontback,
                        $userid)
{
  global $bdd;

  $req = $bdd->prepare("INSERT INTO hairs(boxid,nendoroidid,
                                          main_color,main_color_hex,
                                          other_color,other_color_hex,
                                          haircut,description,frontback,
                                          creatorid,creationdate,editorid,editiondate)
                        VALUES(:box_internalid,:nendoroid_internalid,
                                :main_color,:main_color_hex,
                                :other_color,:other_color_hex,
                                :haircut,:description,:frontback,
                                :creatorid,NOW(),:editorid,NOW())");
  $req->bindParam(':box_internalid',$box_internalid);
  $req->bindParam(':nendoroid_internalid',$nendoroid_internalid);
  $req->bindParam(':main_color',$hair_main_color);
  $req->bindParam(':main_color_hex',$hair_main_color_hex);
  $req->bindParam(':other_color',$hair_other_color);
  $req->bindParam(':other_color_hex',$hair_other_color_hex);
  $req->bindParam(':haircut',$hair_haircut);
  $req->bindParam(':frontback',$hair_frontback);
  $req->bindParam(':description',$hair_description);
  $req->bindParam(':creatorid',$userid);
  $req->bindParam(':editorid',$userid);
  $req->execute();

  $resultInfo = $req->errorInfo();

  if( $resultInfo[0]=="00000" ){
    $resultInfo[4] = $bdd->lastInsertId();
  }

  return $resultInfo;
}
