<?php

/** Get the history for a box */
function get_boxHistory($box_internalid)
{
  global $bdd;

  $req = $bdd->prepare("SELECT h.internalid AS history_internalid,
                        h.userid AS history_user_internalid, u.username AS history_user_name,
                        h.boxid AS history_box_internalid,
                        h.nendoroidid AS history_nendoroid_internalid,
                        h.accessoryid AS history_accessory_internalid,
                        h.bodypartid AS history_bodypart_internalid,
                        h.faceid AS history_face_internalid,
                        h.hairid AS history_hair_internalid,
                        h.handid AS history_hand_internalid,
                        h.action AS history_action,
                        h.actiondate AS history_actiondate,
                        NOW() AS now
                        FROM history AS  h
                        LEFT JOIN users AS u ON h.userid = u.internalid
                        WHERE h.boxid = :box_internalid
                        ORDER BY history_actiondate DESC");
  $req->bindParam(':box_internalid',$box_internalid);
  $req->execute();

  $resultInfo = $req->errorInfo();

  if( $resultInfo[0]=="00000" ){
    $resultInfo[4] = $req->fetchAll(PDO::FETCH_ASSOC);
  }

  return $resultInfo;
}
