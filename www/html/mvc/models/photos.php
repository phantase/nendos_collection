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
/** Retrieve all photos within the DB */
function get_allPhotos($order="photo_uploaded",$direction="DESC",$userid=null)
{
  $orders = array("photo_title","photo_username","photo_uploaded");
  $key = array_search($order, $orders);
  $order = $orders[$key];
  $directions = array("asc","desc");
  $key = array_search($direction, $directions);
  $direction = $directions[$key];

  global $bdd;

  $req = $bdd->prepare("SELECT p.internalid AS photo_internalid,
                        p.title AS photo_title, p.width AS photo_width, p.height AS photo_height,
                        p.uploaded AS photo_uploaded, p.updated AS photo_updated,
                        p.userid AS photo_userid, u.username AS photo_username,
                        NOW() AS now
                        FROM photos AS p
                        LEFT JOIN users AS u ON p.userid = u.internalid
                        ORDER BY $order $direction;");
  $req->execute();

  $resultInfo = $req->errorInfo();

  if( $resultInfo[0]=="00000" ){
    $resultInfo[4] = $req->fetchAll(PDO::FETCH_ASSOC);
  }

  return $resultInfo;
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
                        n.name AS nendoroid_name, n.version AS nendoroid_version,
                        b.number AS box_number, b.category AS box_category
                        FROM photos_nendoroids AS pn
                        LEFT JOIN nendoroids AS n ON pn.nendoroidid = n.internalid
                        LEFT JOIN boxes AS b ON n.boxid = b.internalid
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
                        a.type AS accessory_type, a.Description AS accessory_description
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
/** Retrieve bodyparts attached to a photo */
function get_bodypartsPhoto($photo_internalid)
{
  global $bdd;

  $req = $bdd->prepare("SELECT pbp.internalid AS pbp_internalid, pbp.photoid AS photo_internalid, pbp.bodypartid AS bodypart_internalid,
                        pbp.xmin AS pbp_xmin, pbp.ymin AS pbp_ymin, pbp.xmax AS pbp_xmax, pbp.ymax AS pbp_ymax,
                        bp.part AS bodypart_part, bp.description AS bodypart_description
                        FROM photos_bodyparts AS pbp
                        LEFT JOIN bodyparts AS bp on pbp.bodypartid = bp.internalid
                        WHERE pbp.photoid = :photo_internalid");
  $req->bindParam(':photo_internalid',$photo_internalid);
  $req->execute();

  $resultInfo = $req->errorInfo();

  if( $resultInfo[0]=="00000" ){
    $resultInfo[4] = $req->fetchAll(PDO::FETCH_ASSOC);
  }

  return $resultInfo;
}
/** Retrieve boxes attached to a photo */
function get_boxesPhoto($photo_internalid)
{
  global $bdd;

  $req = $bdd->prepare("SELECT pb.internalid AS pb_internalid, pb.photoid AS photo_internalid, pb.boxid AS box_internalid,
                        pb.xmin AS pb_xmin, pb.ymin AS pb_ymin, pb.xmax AS pb_xmax, pb.ymax AS pb_ymax,
                        b.number AS box_number, b.name AS box_name, b.series AS box_series, b.category AS box_category
                        FROM photos_boxes AS pb
                        LEFT JOIN boxes AS b on pb.boxid = b.internalid
                        WHERE pb.photoid = :photo_internalid");
  $req->bindParam(':photo_internalid',$photo_internalid);
  $req->execute();

  $resultInfo = $req->errorInfo();

  if( $resultInfo[0]=="00000" ){
    $resultInfo[4] = $req->fetchAll(PDO::FETCH_ASSOC);
  }

  return $resultInfo;
}
/** Retrieve faces attached to a photo */
function get_facesPhoto($photo_internalid)
{
  global $bdd;

  $req = $bdd->prepare("SELECT pf.internalid AS pf_internalid, pf.photoid AS photo_internalid, pf.faceid AS face_internalid,
                        pf.xmin AS pf_xmin, pf.ymin AS pf_ymin, pf.xmax AS pf_xmax, pf.ymax AS pf_ymax,
                        f.eyes AS face_eyes, f.mouth AS face_mouth
                        FROM photos_faces AS pf
                        LEFT JOIN faces AS f on pf.faceid = f.internalid
                        WHERE pf.photoid = :photo_internalid");
  $req->bindParam(':photo_internalid',$photo_internalid);
  $req->execute();

  $resultInfo = $req->errorInfo();

  if( $resultInfo[0]=="00000" ){
    $resultInfo[4] = $req->fetchAll(PDO::FETCH_ASSOC);
  }

  return $resultInfo;
}
/** Retrieve hairs attached to a photo */
function get_hairsPhoto($photo_internalid)
{
  global $bdd;

  $req = $bdd->prepare("SELECT ph.internalid AS ph_internalid, ph.photoid AS photo_internalid, ph.hairid AS hair_internalid,
                        ph.xmin AS ph_xmin, ph.ymin AS ph_ymin, ph.xmax AS ph_xmax, ph.ymax AS ph_ymax,
                        h.haircut AS hair_haircut, h.frontback AS hair_frontback, h.description AS hair_description
                        FROM photos_hairs AS ph
                        LEFT JOIN hairs AS h on ph.hairid = h.internalid
                        WHERE ph.photoid = :photo_internalid");
  $req->bindParam(':photo_internalid',$photo_internalid);
  $req->execute();

  $resultInfo = $req->errorInfo();

  if( $resultInfo[0]=="00000" ){
    $resultInfo[4] = $req->fetchAll(PDO::FETCH_ASSOC);
  }

  return $resultInfo;
}
/** Retrieve hands attached to a photo */
function get_handsPhoto($photo_internalid)
{
  global $bdd;

  $req = $bdd->prepare("SELECT ph.internalid AS ph_internalid, ph.photoid AS photo_internalid, ph.handid AS hand_internalid,
                        ph.xmin AS ph_xmin, ph.ymin AS ph_ymin, ph.xmax AS ph_xmax, ph.ymax AS ph_ymax,
                        h.leftright AS hand_leftright, h.posture AS hand_posture
                        FROM photos_hands AS ph
                        LEFT JOIN hands AS h on ph.handid = h.internalid
                        WHERE ph.photoid = :photo_internalid");
  $req->bindParam(':photo_internalid',$photo_internalid);
  $req->execute();

  $resultInfo = $req->errorInfo();

  if( $resultInfo[0]=="00000" ){
    $resultInfo[4] = $req->fetchAll(PDO::FETCH_ASSOC);
  }

  return $resultInfo;
}
/** Add a part to a photo */
function add_partPhoto($photo_internalid,$part_type,$part_internalid,$xmin,$ymin,$xmax,$ymax)
{
  global $bdd;

  $allowedElement = array("accessory"   ,"bodypart"   ,"box"    ,"face"   ,"hair"   ,"hand"   ,"nendoroid"  );
  $allowedTable   = array("accessories" ,"bodyparts"  ,"boxes"  ,"faces"  ,"hairs"  ,"hands"  ,"nendoroids" );
  $allowedField   = array("accessoryid" ,"bodypartid" ,"boxid"  ,"faceid" ,"hairid" ,"handid" ,"nendoroidid");
  $key = array_search($part_type, $allowedElement);
  $tablename = $allowedTable[$key];
  $fieldname = $allowedField[$key];

  $req = $bdd->prepare("INSERT INTO photos_$tablename(photoid,$fieldname,xmin,ymin,xmax,ymax) "
                                      ."VALUES(:photoid,:partid,:xmin,:ymin,:xmax,:ymax)");
  $req->bindParam(':photoid',$photo_internalid);
  $req->bindParam(':partid',$part_internalid);
  $req->bindParam(':xmin',$xmin);
  $req->bindParam(':ymin',$ymin);
  $req->bindParam(':xmax',$xmax);
  $req->bindParam(':ymax',$ymax);
  $req->execute();

  $resultArray = $req->errorInfo();
  if($resultArray[0] == 0 ){
    $resultArray[4] = $bdd->lastInsertId();
  }

  return $resultArray;
}
