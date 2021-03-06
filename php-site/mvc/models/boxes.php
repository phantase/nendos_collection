<?php
/** Count all the boxes available in the DB */
function count_allBoxes()
{
  global $bdd;

  $req = $bdd->prepare("SELECT count(*) AS count
                        FROM boxes AS b");
  $req->execute();
  $count = $req->fetch();

  return $count['count'];
}
/** Get all the boxes available in the DB */
function get_allBoxes($order="db_creationdate",$direction="DESC",$userid=null)
{
  $orders = array("box_number","box_name","box_series",
                  "box_manufacturer","box_category","box_price",
                  "box_releasedate","box_sculptor","box_cooperation",
                  "db_creatorname","db_creationdate","db_editorname","db_editiondate","db_validatorname","db_validationdate");
  $key = array_search($order, $orders);
  $order = $orders[$key];
  $directions = array("asc","desc");
  $key = array_search($direction, $directions);
  $direction = $directions[$key];

  global $bdd;

  $req = $bdd->prepare("SELECT b.internalid AS box_internalid,
                        b.number AS box_number, b.name AS box_name, b.series AS box_series,
                        b.manufacturer AS box_manufacturer, b.category AS box_category, b.price AS box_price,
                        b.releasedate AS box_releasedate, b.specifications AS box_specifications,
                        b.sculptor AS box_sculptor, b.cooperation AS box_cooperation,
                        b.officialurl AS box_officialurl,
                        b.creatorid AS db_creatorid, uc.username AS db_creatorname, b.creationdate AS db_creationdate,
                        b.editorid AS db_editorid, ue.username AS db_editorname, b.editiondate AS db_editiondate,
                        b.validatorid AS db_validatorid, uv.username AS db_validatorname, b.validationdate AS db_validationdate,
                        uc.additiondate AS coll_additiondate,
                        NOW() AS now
                        FROM boxes AS b
                        LEFT JOIN users AS uc ON b.creatorid = uc.internalid
                        LEFT JOIN users AS ue ON b.editorid = ue.internalid
                        LEFT JOIN users AS uv ON b.validatorid = uv.internalid
                        LEFT JOIN (
                          SELECT internalid, userid, boxid, additiondate
                          FROM users_boxes_collection
                          WHERE userid = :userid
                          ) AS uc ON b.internalid = uc.boxid
                        ORDER BY $order $direction");
  $req->bindParam(":userid",$userid);
  $req->execute();

  $resultInfo = $req->errorInfo();

  if( $resultInfo[0]=="00000" ){
    $resultInfo[4] = $req->fetchAll(PDO::FETCH_ASSOC);
  }

  return $resultInfo;
}
/** Get a single box from its internalid */
function get_singleBox($box_internalid,$userid=null)
{
  global $bdd;

  $req = $bdd->prepare("SELECT b.internalid AS box_internalid,
                        b.number AS box_number, b.name AS box_name, b.series AS box_series,
                        b.manufacturer AS box_manufacturer, b.category AS box_category, b.price AS box_price,
                        b.releasedate AS box_releasedate, b.specifications AS box_specifications,
                        b.sculptor AS box_sculptor, b.cooperation AS box_cooperation,
                        b.officialurl AS box_officialurl,
                        b.creatorid AS db_creatorid, uc.username AS db_creatorname, b.creationdate AS db_creationdate,
                        b.editorid AS db_editorid, ue.username AS db_editorname, b.editiondate AS db_editiondate,
                        b.validatorid AS db_validatorid, uv.username AS db_validatorname, b.validationdate AS db_validationdate,
                        ubc.additiondate AS coll_additiondate,
                        NOW() AS now
                        FROM boxes AS b
                        LEFT JOIN users AS uc ON b.creatorid = uc.internalid
                        LEFT JOIN users AS ue ON b.editorid = ue.internalid
                        LEFT JOIN users AS uv ON b.validatorid = uv.internalid
                        LEFT JOIN (
                          SELECT internalid, userid, boxid, additiondate
                          FROM users_boxes_collection
                          WHERE userid = :userid
                          ) AS ubc ON b.internalid = ubc.boxid
                        WHERE b.internalid = :box_internalid");
  $req->bindParam(":userid",$userid);
  $req->bindParam(':box_internalid',$box_internalid);
  $req->execute();

  $resultInfo = $req->errorInfo();

  if( $resultInfo[0]=="00000" ){
    $resultInfo[4] = $req->fetch();
  }

  return $resultInfo;
}
/** Add a single box in the DB */
function add_singleBox($box_number,$box_name,$box_series,$box_manufacturer,$box_category,$box_price,
                      $box_releasedate,$box_specifications,$box_sculptor,$box_cooperation,$box_officialurl,$userid)
{
  global $bdd;

  $req = $bdd->prepare("INSERT INTO boxes(number,name,series,manufacturer,category,price,
                                        releasedate,specifications,sculptor,cooperation,
                                        officialurl,creatorid,creationdate,editorid,editiondate)
                        VALUES(:box_number,:box_name,:box_series,:box_manufacturer,:box_category,:box_price,
                            :box_releasedate,:box_specifications,:box_sculptor,:box_cooperation,
                            :box_officialurl,:creatorid,NOW(),:editorid,NOW())");
  $req->bindParam(':box_number',$box_number);
  $req->bindParam(':box_name',$box_name);
  $req->bindParam(':box_series',$box_series);
  $req->bindParam(':box_manufacturer',$box_manufacturer);
  $req->bindParam(':box_category',$box_category);
  $req->bindParam(':box_price',$box_price);
  $req->bindParam(':box_releasedate',$box_releasedate);
  $req->bindParam(':box_specifications',$box_specifications);
  $req->bindParam(':box_sculptor',$box_sculptor);
  $req->bindParam(':box_cooperation',$box_cooperation);
  $req->bindParam(':box_officialurl',$box_officialurl);
  $req->bindParam(':creatorid',$userid);
  $req->bindParam(':editorid',$userid);
  $req->execute();

  $resultArray = $req->errorInfo();
  if($resultArray[0] == 0 ){
    $resultArray[4] = $bdd->lastInsertId();
  }

  return $resultArray;
}
/** Retrieve the vocabularies of a field of the boxes */
function getBoxesVocabulary($field,$order="alphabetical",$direction="ASC",$withnull=false)
{
  $fields = array("series","manufacturer","category","sculptor","cooperation");
  $key = array_search($field, $fields);
  $field = $fields[$key];

  if(!$withnull){
    $where = "WHERE $field IS NOT NULL ";
  }

  global $bdd;

  $req = $bdd->prepare("SELECT $field AS field, count(*) AS count
                        FROM boxes
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
/** Get all the boxes for selected term */
function search_allBoxes($term)
{
  global $bdd;

  $req = $bdd->prepare("SELECT b.internalid AS box_internalid,
                        b.number AS box_number, b.name AS box_name, b.series AS box_series,
                        b.manufacturer AS box_manufacturer, b.category AS box_category, b.price AS box_price,
                        b.releasedate AS box_releasedate, b.specifications AS box_specifications,
                        b.sculptor AS box_sculptor, b.cooperation AS box_cooperation,
                        b.officialurl AS box_officialurl,
                        NOW() AS now
                        FROM boxes AS b
                        WHERE b.name LIKE :term
                        ORDER BY box_number ASC");
  //$req->bindParam(":term",'%'.$term.'%');
  $req->execute(array(':term'=>'%'.$term.'%'));
  $req->execute();

  $resultInfo = $req->errorInfo();

  if( $resultInfo[0]=="00000" ){
    $resultInfo[4] = $req->fetchAll(PDO::FETCH_ASSOC);
  }

  return $resultInfo;
}
