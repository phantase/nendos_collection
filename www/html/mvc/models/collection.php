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
/** Count nendoroids in a user collection */
function count_userNendoroids($userid)
{
  global $bdd;

  $req = $bdd->prepare("SELECT count(*) AS count
                        FROM users_nendoroids_collection
                        WHERE userid=:userid");
  $req->bindParam(':userid',$userid);
  $req->execute();

  $resultInfo = $req->errorInfo();

  if( $resultInfo[0]=="00000" ){
    $resultInfo[4] = $req->fetch()['count'];
  }

  return $resultInfo;
}
/** Count faces in a user collection */
function count_userFaces($userid)
{
  global $bdd;

  $req = $bdd->prepare("SELECT count(*) AS count
                        FROM users_faces_collection
                        WHERE userid=:userid");
  $req->bindParam(':userid',$userid);
  $req->execute();

  $resultInfo = $req->errorInfo();

  if( $resultInfo[0]=="00000" ){
    $resultInfo[4] = $req->fetch()['count'];
  }

  return $resultInfo;
}
/** Count hairs in a user collection */
function count_userHairs($userid)
{
  global $bdd;

  $req = $bdd->prepare("SELECT count(*) AS count
                        FROM users_hairs_collection
                        WHERE userid=:userid");
  $req->bindParam(':userid',$userid);
  $req->execute();

  $resultInfo = $req->errorInfo();

  if( $resultInfo[0]=="00000" ){
    $resultInfo[4] = $req->fetch()['count'];
  }

  return $resultInfo;
}
/** Count hands in a user collection */
function count_userHands($userid)
{
  global $bdd;

  $req = $bdd->prepare("SELECT count(*) AS count
                        FROM users_hands_collection
                        WHERE userid=:userid");
  $req->bindParam(':userid',$userid);
  $req->execute();

  $resultInfo = $req->errorInfo();

  if( $resultInfo[0]=="00000" ){
    $resultInfo[4] = $req->fetch()['count'];
  }

  return $resultInfo;
}
/** Count bodyparts in a user collection */
function count_userBodyparts($userid)
{
  global $bdd;

  $req = $bdd->prepare("SELECT count(*) AS count
                        FROM users_bodyparts_collection
                        WHERE userid=:userid");
  $req->bindParam(':userid',$userid);
  $req->execute();

  $resultInfo = $req->errorInfo();

  if( $resultInfo[0]=="00000" ){
    $resultInfo[4] = $req->fetch()['count'];
  }

  return $resultInfo;
}
/** Count accessories in a user collection */
function count_userAccessories($userid)
{
  global $bdd;

  $req = $bdd->prepare("SELECT count(*) AS count
                        FROM users_accessories_collection
                        WHERE userid=:userid");
  $req->bindParam(':userid',$userid);
  $req->execute();

  $resultInfo = $req->errorInfo();

  if( $resultInfo[0]=="00000" ){
    $resultInfo[4] = $req->fetch()['count'];
  }

  return $resultInfo;
}
