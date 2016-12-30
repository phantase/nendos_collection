<?php
/** Count all photos in the DB */
function count_allPhotos()
{
  global $bdd;

  $req = $bdd->prepare("SELECT count(*) AS count
                        FROM photos AS p");
  $req->execute();
  $count = $req->fetch();

  return $count['count'];
}
/** Add a photo to the DB */
function add_singlePhoto($userid,$title,$width,$height)
{
  global $bdd;

  $req = $bdd->prepare("INSERT INTO photos(userid,title,width,height,uploaded,updated)
                        VALUES(:userid,:title,:width,:height,NOW(),NOW())");
  $req->bindParam(':userid',$userid);
  $req->bindParam(':title',$title);
  $req->bindParam(':width',$width);
  $req->bindParam(':height',$height);
  $req->execute();

  $resultInfo = $req->errorInfo();

  if( $resultInfo[0]=="00000" ){
    $resultInfo[4] = $bdd->lastInsertId();
  }

  return $resultInfo;
}
/** Retrieve a single photo */
function get_singlePhoto($photo_internalid)
{
  global $bdd;

  $req = $bdd->prepare("SELECT p.internalid AS photo_internalid,
                        p.title AS photo_title, p.width AS photo_width, p.height AS photo_height,
                        p.uploaded AS photo_uploaded, p.updated AS photo_updated,
                        p.userid AS photo_userid, u.username AS photo_username,
                        NOW() AS now
                        FROM photos AS p
                        LEFT JOIN users AS u ON p.userid = u.internalid
                        WHERE p.internalid = :photo_internalid");
  $req->bindParam(':photo_internalid',$photo_internalid);
  $req->execute();

  $resultInfo = $req->errorInfo();

  if( $resultInfo[0]=="00000" ){
    $resultInfo[4] = $req->fetch();
  }

  return $resultInfo;
}
/** Retrieve nendoroids attached to a photo */
function get_nendoroidsPhoto($photo_internalid)
{
  global $bdd;

  $req = $bdd->prepare("SELECT pn.internalid AS pn_internalid, pn.photoid AS photo_internalid, pn.nendoroidid AS nendoroid_internalid,
                        pn.xmin AS pn_xmin, pn.ymin AS pn_ymin, pn.xmax AS pn_xmax, pn.ymax AS pn_ymax,
                        n.name AS nendoroid_name, n.version AS nendoroid_version
                        FROM photos_nendoroids AS pn
                        LEFT JOIN nendoroids AS n on pn.nendoroidid = n.internalid
                        WHERE pn.photoid = :photo_internalid");
  $req->bindParam(':photo_internalid',$photo_internalid);
  $req->execute();

  $resultInfo = $req->errorInfo();

  if( $resultInfo[0]=="00000" ){
    $resultInfo[4] = $req->fetchAll(PDO::FETCH_ASSOC);
  }

  return $resultInfo;
}
/** Retrieve accessories attached to a photo */
function get_accessoriesPhoto($photo_internalid)
{
  global $bdd;

  $req = $bdd->prepare("SELECT pa.internalid AS pa_internalid, pa.photoid AS photo_internalid, pa.accessoryid AS accessory_internalid,
                        pa.xmin AS pa_xmin, pa.ymin AS pa_ymin, pa.xmax AS pa_xmax, pa.ymax AS pa_ymax,
                        a.type AS accessory_type
                        FROM photos_accessories AS pa
                        LEFT JOIN accessories AS a on pa.accessoryid = a.internalid
                        WHERE pa.photoid = :photo_internalid");
  $req->bindParam(':photo_internalid',$photo_internalid);
  $req->execute();

  $resultInfo = $req->errorInfo();

  if( $resultInfo[0]=="00000" ){
    $resultInfo[4] = $req->fetchAll(PDO::FETCH_ASSOC);
  }

  return $resultInfo;
}
