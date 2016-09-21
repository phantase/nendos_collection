<?php
/** Count boxes in a user collection */
function count_userBoxes($userid)
{
  global $bdd;

  $req = $bdd->prepare("SELECT count(*) AS count
                        FROM users_boxes_collection
                        WHERE userid=:userid");
  $req->bindParam(':userid',$userid);
  $req->execute();

  $resultInfo = $req->errorInfo();

  if( $resultInfo[0]=="00000" ){
    $resultInfo[4] = $req->fetch()['count'];
  }

  return $resultInfo;
}
