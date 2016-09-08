<?php

/** Get the history for a box */
function get_boxHistory($box_internalid)
{
  return get_history('boxid',$box_internalid);
}
/** Get the history for a nendoroid */
function get_nendoroidHistory($nendoroid_internalid)
{
  return get_history('nendoroidid',$nendoroid_internalid);
}
/** Get the history for an accessory */
function get_accessoryHistory($accessory_internalid)
{
  return get_history('accessoryid',$accessory_internalid);
}
/** Get the history for a bodypart */
function get_bodypartHistory($bodypart_internalid)
{
  return get_history('bodypartid',$bodypart_internalid);
}
/** Get the history for a face */
function get_faceHistory($face_internalid)
{
  return get_history('faceid',$face_internalid);
}
/** Get the history for a hair */
function get_hairHistory($hair_internalid)
{
  return get_history('hairid',$hair_internalid);
}
/** Get the history for a hand */
function get_handHistory($hand_internalid)
{
  return get_history('handid',$hand_internalid);
}

/** Get the history of an element determined by the $filteron criteria */
function get_history($filteron,$internalid)
{
  global $bdd;

  $req = $bdd->prepare("SELECT h.internalid AS history_internalid,
                        h.userid AS user_internalid, u.username AS user_name,
                        h.boxid AS box_internalid, b.name AS box_name, b.category AS box_category, b.number AS box_number,
                        h.nendoroidid AS nendoroid_internalid, n.name AS nendoroid_name, n.version AS nendoroid_version,
                        h.accessoryid AS accessory_internalid, a.type AS accessory_type,
                        h.bodypartid AS bodypart_internalid, bp.part AS bodypart_part,
                        h.faceid AS face_internalid,
                        h.hairid AS hair_internalid,
                        h.handid AS hand_internalid,
                        h.action AS history_action,
                        h.actiondate AS history_actiondate,
                        NOW() AS now
                        FROM history AS  h
                        LEFT JOIN users AS u ON h.userid = u.internalid
                        LEFT JOIN boxes AS b ON h.boxid = b.internalid
                        LEFT JOIN nendoroids AS n ON h.nendoroidid = n.internalid
                        LEFT JOIN accessories AS a ON h.accessoryid = a.internalid
                        LEFT JOIN bodyparts AS bp ON h.bodypartid = bp.internalid
                        WHERE h.$filteron = :internalid
                        ORDER BY history_actiondate DESC");
  $req->bindParam(':internalid',$internalid);
  $req->execute();

  $resultInfo = $req->errorInfo();

  if( $resultInfo[0]=="00000" ){
    $resultInfo[4] = $req->fetchAll(PDO::FETCH_ASSOC);
  }

  return $resultInfo;
}
