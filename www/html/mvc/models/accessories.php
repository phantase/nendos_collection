<?php
/** Count all the accessories available in the DB */
function count_allAccessories()
{
  global $bdd;

  $req = $bdd->prepare("SELECT count(*) AS count
                        FROM accessories AS a");
  $req->execute();
  $count = $req->fetch();

  return $count['count'];
}
/** Get all the accessories available in the DB */
function get_allAccessories($order="db_creationdate",$direction="desc")
{
  $orders = array("accessory_type","accessory_main_color","accessory_other_color",
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

  $req = $bdd->prepare("SELECT a.internalid AS accessory_internalid,
                        a.main_color AS accessory_main_color, a.other_color AS accessory_other_color,
                        a.type AS accessory_type, a.description AS accessory_description,
                        n.internalid AS nendoroid_internalid,
                        n.name AS nendoroid_name, n.version AS nendoroid_version,
                        n.sex AS nendoroid_sex, n.dominant_color AS nendoroid_dominant_color,
                        b.internalid AS box_internalid,
                        b.number AS box_number, b.name AS box_name, b.series AS box_series,
                        b.manufacturer AS box_manufacturer, b.category AS box_category, b.price AS box_price,
                        b.releasedate AS box_releasedate, b.specifications AS box_specifications,
                        b.sculptor AS box_sculptor, b.cooperation AS box_cooperation,
                        b.officialurl AS box_officialurl,
                        a.creatorid AS db_creatorid, uc.username AS db_creatorname, a.creationdate AS db_creationdate,
                        a.editorid AS db_editorid, ue.username AS db_editorname, a.editiondate AS db_editiondate,
                        a.validatorid AS db_validatorid, uv.username AS db_validatorname, a.validationdate AS db_validationdate,
                        NOW() AS now
                        FROM accessories AS a
                        LEFT JOIN nendoroids AS n ON a.nendoroidid = n.internalid
                        LEFT JOIN boxes AS b ON a.boxid = b.internalid
                        LEFT JOIN users AS uc ON a.creatorid = uc.internalid
                        LEFT JOIN users AS ue ON a.editorid = ue.internalid
                        LEFT JOIN users AS uv ON a.validatorid = uv.internalid
                        ORDER BY $order $direction;");
  $req->execute();

  $resultInfo = $req->errorInfo();

  if( $resultInfo[0]=="00000" ){
    $resultInfo[4] = $req->fetchAll(PDO::FETCH_ASSOC);
  }

  return $resultInfo;
}
/** Count all the accessories available for a specific Nendoroid */
function count_nendoroidAccessories($nendoroid_internalid)
{
  global $bdd;

  $req = $bdd->prepare("SELECT count(*) AS count
                        FROM accessories AS a
                        WHERE a.nendoroidid = :nendoroid_internalid");
  $req->bindParam(':nendoroid_internalid',$nendoroid_internalid);
  $req->execute();
  $count = $req->fetch();

  return $count['count'];
}
/** Get all the accessories available for a specific Nendoroid */
function get_nendoroidAccessories($nendoroid_internalid)
{
  global $bdd;

  $req = $bdd->prepare("SELECT a.internalid AS accessory_internalid,
                        a.main_color AS accessory_main_color, a.other_color AS accessory_other_color,
                        a.type AS accessory_type, a.description AS accessory_description,
                        n.internalid AS nendoroid_internalid,
                        n.name AS nendoroid_name, n.version AS nendoroid_version,
                        n.sex AS nendoroid_sex, n.dominant_color AS nendoroid_dominant_color,
                        b.internalid AS box_internalid,
                        b.number AS box_number, b.name AS box_name, b.series AS box_series,
                        b.manufacturer AS box_manufacturer, b.category AS box_category, b.price AS box_price,
                        b.releasedate AS box_releasedate, b.specifications AS box_specifications,
                        b.sculptor AS box_sculptor, b.cooperation AS box_cooperation,
                        b.officialurl AS box_officialurl,
                        a.creatorid AS db_creatorid, uc.username AS db_creatorname, a.creationdate AS db_creationdate,
                        a.editorid AS db_editorid, ue.username AS db_editorname, a.editiondate AS db_editiondate,
                        a.validatorid AS db_validatorid, uv.username AS db_validatorname, a.validationdate AS db_validationdate,
                        NOW() AS now
                        FROM accessories AS a
                        LEFT JOIN nendoroids AS n ON a.nendoroidid = n.internalid
                        LEFT JOIN boxes AS b ON a.boxid = b.internalid
                        LEFT JOIN users AS uc ON a.creatorid = uc.internalid
                        LEFT JOIN users AS ue ON a.editorid = ue.internalid
                        LEFT JOIN users AS uv ON a.validatorid = uv.internalid
                        WHERE a.nendoroidid = :nendoroid_internalid");
  $req->bindParam(':nendoroid_internalid',$nendoroid_internalid);
  $req->execute();

  $resultInfo = $req->errorInfo();

  if( $resultInfo[0]=="00000" ){
    $resultInfo[4] = $req->fetchAll(PDO::FETCH_ASSOC);
  }

  return $resultInfo;
}
/** Get all the accessories available for a specific Box */
function get_boxAccessories($box_internalid)
{
  global $bdd;

  $req = $bdd->prepare("SELECT a.internalid AS accessory_internalid,
                        a.main_color AS accessory_main_color, a.other_color AS accessory_other_color,
                        a.type AS accessory_type, a.description AS accessory_description,
                        n.internalid AS nendoroid_internalid,
                        n.name AS nendoroid_name, n.version AS nendoroid_version,
                        n.sex AS nendoroid_sex, n.dominant_color AS nendoroid_dominant_color,
                        b.internalid AS box_internalid,
                        b.number AS box_number, b.name AS box_name, b.series AS box_series,
                        b.manufacturer AS box_manufacturer, b.category AS box_category, b.price AS box_price,
                        b.releasedate AS box_releasedate, b.specifications AS box_specifications,
                        b.sculptor AS box_sculptor, b.cooperation AS box_cooperation,
                        b.officialurl AS box_officialurl,
                        a.creatorid AS db_creatorid, uc.username AS db_creatorname, a.creationdate AS db_creationdate,
                        a.editorid AS db_editorid, ue.username AS db_editorname, a.editiondate AS db_editiondate,
                        a.validatorid AS db_validatorid, uv.username AS db_validatorname, a.validationdate AS db_validationdate,
                        NOW() AS now
                        FROM accessories AS a
                        LEFT JOIN nendoroids AS n ON a.nendoroidid = n.internalid
                        LEFT JOIN boxes AS b ON a.boxid = b.internalid
                        LEFT JOIN users AS uc ON a.creatorid = uc.internalid
                        LEFT JOIN users AS ue ON a.editorid = ue.internalid
                        LEFT JOIN users AS uv ON a.validatorid = uv.internalid
                        WHERE a.boxid = :box_internalid");
  $req->bindParam(':box_internalid',$box_internalid);
  $req->execute();

  $resultInfo = $req->errorInfo();

  if( $resultInfo[0]=="00000" ){
    $resultInfo[4] = $req->fetchAll(PDO::FETCH_ASSOC);
  }

  return $resultInfo;
}
/** Get a single accessory with its internalid */
function get_singleAccessory($accessory_internalid)
{
  global $bdd;

  $req = $bdd->prepare("SELECT a.internalid AS accessory_internalid,
                        a.main_color AS accessory_main_color, a.other_color AS accessory_other_color,
                        a.type AS accessory_type, a.description AS accessory_description,
                        n.internalid AS nendoroid_internalid,
                        n.name AS nendoroid_name, n.version AS nendoroid_version,
                        n.sex AS nendoroid_sex, n.dominant_color AS nendoroid_dominant_color,
                        b.internalid AS box_internalid,
                        b.number AS box_number, b.name AS box_name, b.series AS box_series,
                        b.manufacturer AS box_manufacturer, b.category AS box_category, b.price AS box_price,
                        b.releasedate AS box_releasedate, b.specifications AS box_specifications,
                        b.sculptor AS box_sculptor, b.cooperation AS box_cooperation,
                        b.officialurl AS box_officialurl,
                        a.creatorid AS db_creatorid, uc.username AS db_creatorname, a.creationdate AS db_creationdate,
                        a.editorid AS db_editorid, ue.username AS db_editorname, a.editiondate AS db_editiondate,
                        a.validatorid AS db_validatorid, uv.username AS db_validatorname, a.validationdate AS db_validationdate,
                        NOW() AS now
                        FROM accessories AS a
                        LEFT JOIN nendoroids AS n ON a.nendoroidid = n.internalid
                        LEFT JOIN boxes AS b ON a.boxid = b.internalid
                        LEFT JOIN users AS uc ON a.creatorid = uc.internalid
                        LEFT JOIN users AS ue ON a.editorid = ue.internalid
                        LEFT JOIN users AS uv ON a.validatorid = uv.internalid
                        WHERE a.internalid = :accessory_internalid");
  $req->bindParam(':accessory_internalid',$accessory_internalid);
  $req->execute();

  $resultInfo = $req->errorInfo();

  if( $resultInfo[0]=="00000" ){
    $resultInfo[4] = $req->fetch();
  }

  return $resultInfo;
}
/** Add a single accessory in the DB */
function add_singleAccessory($box_internalid,$nendoroid_internalid,
                            $accessory_type,
                            $accessory_main_color,$accessory_other_color,
                            $accessory_description,
                            $userid)
{
  global $bdd;

  $req = $bdd->prepare("INSERT INTO accessories(boxid,nendoroidid,
                                                type,
                                                main_color,other_color,
                                                description,
                                                creatorid,creationdate,editorid,editiondate)
                        VALUES(:box_internalid,:nendoroid_internalid,
                              :type,
                              :main_color,:other_color,
                              :description,
                              :creatorid,NOW(),:editorid,NOW())");
  $req->bindParam(':box_internalid',$box_internalid);
  $req->bindParam(':nendoroid_internalid',$nendoroid_internalid);
  $req->bindParam(':type',$accessory_type);
  $req->bindParam(':main_color',$accessory_main_color);
  $req->bindParam(':other_color',$accessory_other_color);
  $req->bindParam(':description',$accessory_description);
  $req->bindParam(':creatorid',$userid);
  $req->bindParam(':editorid',$userid);
  $req->execute();

  $resultInfo = $req->errorInfo();

  if( $resultInfo[0]=="00000" ){
    $resultInfo[4] = $bdd->lastInsertId();
  }

  return $resultInfo;
}
/** Retrieve the vocabularies of a field of the accessories */
function getAccessoriesVocabulary($field,$order="alphabetical",$direction="ASC",$withnull=false)
{
  $fields = array("main_color","other_color","type");
  $key = array_search($field, $fields);
  $field = $fields[$key];

  if(!$withnull){
    $where = "WHERE $field IS NOT NULL ";
  }

  global $bdd;

  $req = $bdd->prepare("SELECT $field AS field, count(*) AS count
                        FROM accessories
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
