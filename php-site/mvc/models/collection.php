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

/** collect a single element */
function collect_singleElement($element,$internalid,$userid)
{
  global $bdd;

  $allowedElement = array("accessory"  ,"bodypart" ,"box"  ,"face" ,"hair" ,"hand" ,"nendoroid" );
  $allowedField = array("accessoryid"  ,"bodypartid" ,"boxid"  ,"faceid" ,"hairid" ,"handid" ,"nendoroidid" );
  $allowedTable   = array("accessories","bodyparts","boxes","faces","hairs","hands","nendoroids");
  $key = array_search($element, $allowedElement);
  $fieldname = $allowedField[$key];
  $tablename = "users_".$allowedTable[$key]."_collection";

  // Check if the element is already in collection
  $req = $bdd->prepare("SELECT quantity FROM $tablename WHERE userid=:userid AND $fieldname=:internalid");
  $req->bindParam(':internalid',$internalid);
  $req->bindParam(':userid',$userid);
  $req->execute();
  $resultArray = $req->errorInfo();
  if($resultArray[0] != 0 ){
    return $resultArray;
  }

  if($record = $req->fetch()){
  // if yes, raise its quantity by one
    $quantity = $record['quantity'] + 1;
    $req = $bdd->prepare("UPDATE $tablename
                          SET quantity = :quantity
                          WHERE userid = :userid
                          AND $fieldname = :internalid;");
    $req->bindParam(':internalid',$internalid);
    $req->bindParam(':userid',$userid);
    $req->bindParam(':quantity',$quantity);
    $req->execute();
  } else {
  // if no, add it to collection
    $quantity = 1;
    $req = $bdd->prepare("INSERT INTO $tablename(userid,$fieldname)
                          VALUES(:userid,:internalid);");
    $req->bindParam(':internalid',$internalid);
    $req->bindParam(':userid',$userid);
    $req->execute();
  }

  $resultArray = $req->errorInfo();
  if($resultArray[0] == 0 ){
    $resultArray[4] = $quantity;
  }

  return $resultArray;
}

/** uncollect a single element (i.e. remove it from user collection) */
function uncollect_singleElement($element,$internalid,$userid)
{
  global $bdd;

  $allowedElement = array("accessory"  ,"bodypart" ,"box"  ,"face" ,"hair" ,"hand" ,"nendoroid" );
  $allowedField = array("accessoryid"  ,"bodypartid" ,"boxid"  ,"faceid" ,"hairid" ,"handid" ,"nendoroidid" );
  $allowedTable   = array("accessories","bodyparts","boxes","faces","hairs","hands","nendoroids");
  $key = array_search($element, $allowedElement);
  $fieldname = $allowedField[$key];
  $tablename = "users_".$allowedTable[$key]."_collection";

  // the element is in collection, check its quantity
  $req = $bdd->prepare("SELECT quantity FROM $tablename WHERE userid=:userid AND $fieldname=:internalid");
  $req->bindParam(':internalid',$internalid);
  $req->bindParam(':userid',$userid);
  $req->execute();
  $resultArray = $req->errorInfo();
  if($resultArray[0] != 0 ){
    return $resultArray;
  }

  if($record = $req->fetch()){
    $quantity = $record['quantity'];
    if($quantity>1){
      // if its quantity is more than one, just decrease by one
      $quantity --;
      $req = $bdd->prepare("UPDATE $tablename
                            SET quantity = :quantity
                            WHERE userid = :userid
                            AND $fieldname = :internalid;");
      $req->bindParam(':internalid',$internalid);
      $req->bindParam(':userid',$userid);
      $req->bindParam(':quantity',$quantity);
      $req->execute();
    } else {
    // if no, remove it totally from collection
      $quantity = 0;
      $req = $bdd->prepare("DELETE FROM  $tablename
                            WHERE userid = :userid
                            AND $fieldname = :internalid;");
      $req->bindParam(':internalid',$internalid);
      $req->bindParam(':userid',$userid);
      $req->execute();
    }

    $resultArray = $req->errorInfo();
    if($resultArray[0] == 0 ){
      $resultArray[4] = $quantity;
    }

  } else {
    $resultArray[0] = 666;
    $resultArray[2] = "Error, the element is not in the user collection.";
  }

  return $resultArray;
}
