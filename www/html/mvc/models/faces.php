<?php
/** Count all the faces available in the DB */
function count_allFaces()
{
  global $bdd;

  $req = $bdd->prepare("SELECT count(*) AS count
                        FROM faces AS f");
  $req->execute();
  $count = $req->fetch();

  return $count['count'];
}
/** Get all the faces available in the DB */
function get_allFaces($order="db_creationdate",$direction="desc")
{
  $orders = array("face_eyes_color","face_skin_color","face_sex",
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

  $req = $bdd->prepare("SELECT f.internalid AS face_internalid,
                        f.eyes AS face_eyes, f.eyes_color AS face_eyes_color,
                        f.mouth AS face_mouth, f.skin_color AS face_skin_color,
                        f.sex AS face_sex,
                        n.internalid AS nendoroid_internalid,
                        n.name AS nendoroid_name, n.version AS nendoroid_version,
                        n.sex AS nendoroid_sex, n.dominant_color AS nendoroid_dominant_color,
                        b.internalid AS box_internalid,
                        b.number AS box_number, b.name AS box_name, b.series AS box_series,
                        b.manufacturer AS box_manufacturer, b.category AS box_category, b.price AS box_price,
                        b.releasedate AS box_releasedate, b.specifications AS box_specifications,
                        b.sculptor AS box_sculptor, b.cooperation AS box_cooperation,
                        b.officialurl AS box_officialurl,
                        f.creatorid AS db_creatorid, uc.username AS db_creatorname, f.creationdate AS db_creationdate,
                        f.editorid AS db_editorid, ue.username AS db_editorname, f.editiondate AS db_editiondate,
                        NOW() AS now
                        FROM faces AS f
                        LEFT JOIN nendoroids AS n ON f.nendoroidid = n.internalid
                        LEFT JOIN boxes AS b ON f.boxid = b.internalid
                        LEFT JOIN users AS uc ON f.creatorid = uc.internalid
                        LEFT JOIN users AS ue ON f.editorid = ue.internalid
                        ORDER BY $order $direction;");
  $req->execute();

  $resultInfo = $req->errorInfo();

  if( $resultInfo[0]=="00000" ){
    $resultInfo[4] = $req->fetchAll(PDO::FETCH_ASSOC);
  }

  return $resultInfo;
}
/** Count all the faces available for a specific Nendoroid */
function count_nendoroidFaces($nendoroid_internalid)
{
  global $bdd;

  $req = $bdd->prepare("SELECT count(*) AS count
                        FROM faces AS f
                        WHERE f.nendoroidid = :nendoroid_internalid");
  $req->bindParam(':nendoroid_internalid',$nendoroid_internalid);
  $req->execute();
  $count = $req->fetch();

  return $count['count'];
}
/** Get all the faces available for a specific Nendoroid */
function get_nendoroidFaces($nendoroid_internalid)
{
  global $bdd;

  $req = $bdd->prepare("SELECT f.internalid AS face_internalid,
                        f.eyes AS face_eyes, f.eyes_color AS face_eyes_color,
                        f.mouth AS face_mouth, f.skin_color AS face_skin_color,
                        f.sex AS face_sex,
                        n.internalid AS nendoroid_internalid,
                        n.name AS nendoroid_name, n.version AS nendoroid_version,
                        n.sex AS nendoroid_sex, n.dominant_color AS nendoroid_dominant_color,
                        b.internalid AS box_internalid,
                        b.number AS box_number, b.name AS box_name, b.series AS box_series,
                        b.manufacturer AS box_manufacturer, b.category AS box_category, b.price AS box_price,
                        b.releasedate AS box_releasedate, b.specifications AS box_specifications,
                        b.sculptor AS box_sculptor, b.cooperation AS box_cooperation,
                        b.officialurl AS box_officialurl,
                        f.creatorid AS db_creatorid, uc.username AS db_creatorname, f.creationdate AS db_creationdate,
                        f.editorid AS db_editorid, ue.username AS db_editorname, f.editiondate AS db_editiondate,
                        NOW() AS now
                        FROM faces AS f
                        LEFT JOIN nendoroids AS n ON f.nendoroidid = n.internalid
                        LEFT JOIN boxes AS b ON f.boxid = b.internalid
                        LEFT JOIN users AS uc ON f.creatorid = uc.internalid
                        LEFT JOIN users AS ue ON f.editorid = ue.internalid
                        WHERE f.nendoroidid = :nendoroid_internalid");
  $req->bindParam(':nendoroid_internalid',$nendoroid_internalid);
  $req->execute();

  $resultInfo = $req->errorInfo();

  if( $resultInfo[0]=="00000" ){
    $resultInfo[4] = $req->fetchAll(PDO::FETCH_ASSOC);
  }

  return $resultInfo;
}
/** Get all the faces available for a specific Box */
function get_boxFaces($box_internalid)
{
  global $bdd;

  $req = $bdd->prepare("SELECT f.internalid AS face_internalid,
                        f.eyes AS face_eyes, f.eyes_color AS face_eyes_color,
                        f.mouth AS face_mouth, f.skin_color AS face_skin_color,
                        f.sex AS face_sex,
                        n.internalid AS nendoroid_internalid,
                        n.name AS nendoroid_name, n.version AS nendoroid_version,
                        n.sex AS nendoroid_sex, n.dominant_color AS nendoroid_dominant_color,
                        b.internalid AS box_internalid,
                        b.number AS box_number, b.name AS box_name, b.series AS box_series,
                        b.manufacturer AS box_manufacturer, b.category AS box_category, b.price AS box_price,
                        b.releasedate AS box_releasedate, b.specifications AS box_specifications,
                        b.sculptor AS box_sculptor, b.cooperation AS box_cooperation,
                        b.officialurl AS box_officialurl,
                        f.creatorid AS db_creatorid, uc.username AS db_creatorname, f.creationdate AS db_creationdate,
                        f.editorid AS db_editorid, ue.username AS db_editorname, f.editiondate AS db_editiondate,
                        NOW() AS now
                        FROM faces AS f
                        LEFT JOIN nendoroids AS n ON f.nendoroidid = n.internalid
                        LEFT JOIN boxes AS b ON f.boxid = b.internalid
                        LEFT JOIN users AS uc ON f.creatorid = uc.internalid
                        LEFT JOIN users AS ue ON f.editorid = ue.internalid
                        WHERE f.boxid = :box_internalid");
  $req->bindParam(':box_internalid',$box_internalid);
  $req->execute();

  $resultInfo = $req->errorInfo();

  if( $resultInfo[0]=="00000" ){
    $resultInfo[4] = $req->fetchAll(PDO::FETCH_ASSOC);
  }

  return $resultInfo;
}
/** Get a single face with its internalid */
function get_singleFace($face_internalid)
{
  global $bdd;

  $req = $bdd->prepare("SELECT f.internalid AS face_internalid,
                        f.eyes AS face_eyes, f.eyes_color AS face_eyes_color,
                        f.mouth AS face_mouth, f.skin_color AS face_skin_color,
                        f.sex AS face_sex,
                        n.internalid AS nendoroid_internalid,
                        n.name AS nendoroid_name, n.version AS nendoroid_version,
                        n.sex AS nendoroid_sex, n.dominant_color AS nendoroid_dominant_color,
                        b.internalid AS box_internalid,
                        b.number AS box_number, b.name AS box_name, b.series AS box_series,
                        b.manufacturer AS box_manufacturer, b.category AS box_category, b.price AS box_price,
                        b.releasedate AS box_releasedate, b.specifications AS box_specifications,
                        b.sculptor AS box_sculptor, b.cooperation AS box_cooperation,
                        b.officialurl AS box_officialurl,
                        f.creatorid AS db_creatorid, uc.username AS db_creatorname, f.creationdate AS db_creationdate,
                        f.editorid AS db_editorid, ue.username AS db_editorname, f.editiondate AS db_editiondate,
                        NOW() AS now
                        FROM faces AS f
                        LEFT JOIN nendoroids AS n ON f.nendoroidid = n.internalid
                        LEFT JOIN boxes AS b ON f.boxid = b.internalid
                        LEFT JOIN users AS uc ON f.creatorid = uc.internalid
                        LEFT JOIN users AS ue ON f.editorid = ue.internalid
                        WHERE f.internalid = :face_internalid");
  $req->bindParam(':face_internalid',$face_internalid);
  $req->execute();

  $resultInfo = $req->errorInfo();

  if( $resultInfo[0]=="00000" ){
    $resultInfo[4] = $req->fetch();
  }

  return $resultInfo;
}
/** Add a single face in the DB */
function add_singleFace($box_internalid,$nendoroid_internalid,
                        $face_eyes,$face_eyes_color,
                        $face_mouth,$face_skin_color,
                        $face_sex,
                        $userid)
{
  global $bdd;

  $req = $bdd->prepare("INSERT INTO faces(boxid,nendoroidid,
                                          eyes,eyes_color,
                                          mouth,skin_color,
                                          sex,
                                          creatorid,creationdate,editorid,editiondate)
                        VALUES(:box_internalid,:nendoroid_internalid,
                              :eyes,:eyes_color,
                              :mouth,:skin_color,
                              :sex,
                              :creatorid,NOW(),:editorid,NOW())");
  $req->bindParam(':box_internalid',$box_internalid);
  $req->bindParam(':nendoroid_internalid',$nendoroid_internalid);
  $req->bindParam(':eyes',$face_eyes);
  $req->bindParam(':eyes_color',$face_eyes_color);
  $req->bindParam(':mouth',$face_mouth);
  $req->bindParam(':skin_color',$face_skin_color);
  $req->bindParam(':sex',$face_sex);
  $req->bindParam(':creatorid',$userid);
  $req->bindParam(':editorid',$userid);
  $req->execute();

  $resultInfo = $req->errorInfo();

  if( $resultInfo[0]=="00000" ){
    $resultInfo[4] = $bdd->lastInsertId();
  }

  return $resultInfo;
}
/** Retrieve the vocabularies of a field of the faces */
function getFacesVocabulary($field,$order="alphabetical",$direction="ASC",$withnull=false)
{
  $fields = array("eyes_color","skin_color");
  $key = array_search($field, $fields);
  $field = $fields[$key];

  if(!$withnull){
    $where = "WHERE $field IS NOT NULL ";
  }

  global $bdd;

  $req = $bdd->prepare("SELECT $field AS field, count(*) AS count
                        FROM faces
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
