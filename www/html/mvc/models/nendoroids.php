<?php
/** Count all Nendoroids available in the DB */
function count_allNendoroids()
{
  global $bdd;

  $req = $bdd->prepare("SELECT count(*) AS count
                        FROM nendoroids AS n");
  $req->execute();
  $count = $req->fetch();

  return $count['count'];
}
/** Get all Nendoroids available in the DB */
function get_allNendoroids($order="db_creationdate",$direction="DESC")
{
  $orders = array("nendoroid_name","nendoroid_version","nendoroid_sex",
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

  $req = $bdd->prepare("SELECT n.internalid AS nendoroid_internalid,
                        n.name AS nendoroid_name, n.version AS nendoroid_version,
                        n.sex AS nendoroid_sex, n.dominant_color AS nendoroid_dominant_color,
                        b.internalid AS box_internalid,
                        b.number AS box_number, b.name AS box_name, b.series AS box_series,
                        b.manufacturer AS box_manufacturer, b.category AS box_category, b.price AS box_price,
                        b.releasedate AS box_releasedate, b.specifications AS box_specifications,
                        b.sculptor AS box_sculptor, b.cooperation AS box_cooperation,
                        b.officialurl AS box_officialurl,
                        n.creatorid AS db_creatorid, uc.username AS db_creatorname, n.creationdate AS db_creationdate,
                        n.editorid AS db_editorid, ue.username AS db_editorname, n.editiondate AS db_editiondate,
                        NOW() AS now
                        FROM nendoroids AS n
                        LEFT JOIN boxes AS b ON n.boxid = b.internalid
                        LEFT JOIN users AS uc ON n.creatorid = uc.internalid
                        LEFT JOIN users AS ue ON n.editorid = ue.internalid
                        ORDER BY $order $direction;");
  $req->execute();

  $resultInfo = $req->errorInfo();

  if( $resultInfo[0]=="00000" ){
    $resultInfo[4] = $req->fetchAll(PDO::FETCH_ASSOC);
  }

  return $resultInfo;
}
/** Get a single Nendoroid based on its internalid */
function get_singleNendoroid($nendoroid_internalid)
{
  global $bdd;

  $req = $bdd->prepare("SELECT n.internalid AS nendoroid_internalid,
                        n.name AS nendoroid_name, n.version AS nendoroid_version,
                        n.sex AS nendoroid_sex, n.dominant_color AS nendoroid_dominant_color,
                        b.internalid AS box_internalid,
                        b.number AS box_number, b.name AS box_name, b.series AS box_series,
                        b.manufacturer AS box_manufacturer, b.category AS box_category, b.price AS box_price,
                        b.releasedate AS box_releasedate, b.specifications AS box_specifications,
                        b.sculptor AS box_sculptor, b.cooperation AS box_cooperation,
                        b.officialurl AS box_officialurl,
                        n.creatorid AS db_creatorid, uc.username AS db_creatorname, n.creationdate AS db_creationdate,
                        n.editorid AS db_editorid, ue.username AS db_editorname, n.editiondate AS db_editiondate,
                        NOW() AS now
                        FROM nendoroids AS n
                        LEFT JOIN boxes AS b ON n.boxid = b.internalid
                        LEFT JOIN users AS uc ON n.creatorid = uc.internalid
                        LEFT JOIN users AS ue ON n.editorid = ue.internalid
                        WHERE n.internalid = :nendoroid_internalid");
  $req->bindParam(':nendoroid_internalid',$nendoroid_internalid);
  $req->execute();

  $resultInfo = $req->errorInfo();

  if( $resultInfo[0]=="00000" ){
    $resultInfo[4] = $req->fetch();
  }

  return $resultInfo;
}
/** Get all Nendoroid for a certain box internalid */
function get_boxNendoroids($box_internalid)
{
  global $bdd;

  $req = $bdd->prepare("SELECT n.internalid AS nendoroid_internalid,
                        n.name AS nendoroid_name, n.version AS nendoroid_version,
                        n.sex AS nendoroid_sex, n.dominant_color AS nendoroid_dominant_color,
                        b.internalid AS box_internalid,
                        b.number AS box_number, b.name AS box_name, b.series AS box_series,
                        b.manufacturer AS box_manufacturer, b.category AS box_category, b.price AS box_price,
                        b.releasedate AS box_releasedate, b.specifications AS box_specifications,
                        b.sculptor AS box_sculptor, b.cooperation AS box_cooperation,
                        b.officialurl AS box_officialurl,
                        n.creatorid AS db_creatorid, uc.username AS db_creatorname, n.creationdate AS db_creationdate,
                        n.editorid AS db_editorid, ue.username AS db_editorname, n.editiondate AS db_editiondate,
                        NOW() AS now
                        FROM nendoroids AS n
                        LEFT JOIN boxes AS b ON n.boxid = b.internalid
                        LEFT JOIN users AS uc ON n.creatorid = uc.internalid
                        LEFT JOIN users AS ue ON n.editorid = ue.internalid
                        WHERE n.boxid = :boxid
                        ORDER BY nendoroid_name ASC");
  $req->bindParam(':boxid',$box_internalid);
  $req->execute();

  $resultInfo = $req->errorInfo();

  if( $resultInfo[0]=="00000" ){
    $resultInfo[4] = $req->fetchAll(PDO::FETCH_ASSOC);
  }

  return $resultInfo;
}
/** Add a single nendoroid in the DB */
function add_singleNendoroid($box_id,$nendoroid_name,$nendoroid_origin,$nendoroid_version,$nendoroid_company,$nendoroid_color,$userid)
{
  global $bdd;

  $req = $bdd->prepare("INSERT INTO nendoroids(box_id,name,origin,version,company,dominant_color,creator,creation;editor,edition)
                        VALUES(:box_id,:nendoroid_name,:nendoroid_origin,:nendoroid_version,:nendoroid_company,:nendoroid_color,:creator,NOW(),:editor,NOW())");
  $req->bindParam(':box_id',$box_id);
  $req->bindParam(':nendoroid_name',$nendoroid_name);
  $req->bindParam(':nendoroid_origin',$nendoroid_origin);
  $req->bindParam(':nendoroid_version',$nendoroid_version);
  $req->bindParam(':nendoroid_company',$nendoroid_company);
  $req->bindParam(':nendoroid_color',$nendoroid_color);
  $req->bindParam(':creator',$userid);
  $req->bindParam(':editor',$userid);
  $req->execute();

  $nendoroidinternalid = $bdd->lastInsertId();

  return $nendoroidinternalid;
}
