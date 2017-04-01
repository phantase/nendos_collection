<?php

/** validate an element */
function validate_singleElement($element,$internalid,$userid)
{
  global $bdd;

  $allowedElement = array("accessory"  ,"bodypart" ,"box"  ,"face" ,"hair" ,"hand" ,"nendoroid" );
  $allowedTable   = array("accessories","bodyparts","boxes","faces","hairs","hands","nendoroids");
  $key = array_search($element, $allowedElement);
  $tablename = $allowedTable[$key];

  $req = $bdd->prepare("UPDATE $tablename
                        SET validatorid = :userid, validationdate = NOW()
                        WHERE internalid = :internalid");
  $req->bindParam(':internalid',$internalid);
  $req->bindParam(':userid',$userid);
  $req->execute();

  $resultArray = $req->errorInfo();
  if($resultArray[0] == 0 ){
    $resultArray[4] = $bdd->lastInsertId();
    add_specificHistory($userid,$element,$internalid,"Validation");
  }

  return $resultArray;
}

/** unvalidate an element */
function unvalidate_singleElement($element,$internalid,$userid)
{
  global $bdd;

  $allowedElement = array("accessory"  ,"bodypart" ,"box"  ,"face" ,"hair" ,"hand" ,"nendoroid" );
  $allowedTable   = array("accessories","bodyparts","boxes","faces","hairs","hands","nendoroids");
  $key = array_search($element, $allowedElement);
  $tablename = $allowedTable[$key];

  $req = $bdd->prepare("UPDATE $tablename
                        SET validatorid = NULL, validationdate = NULL
                        WHERE internalid = :internalid");
  $req->bindParam(':internalid',$internalid);
  $req->execute();

  $resultArray = $req->errorInfo();
  if($resultArray[0] == 0 ){
    $resultArray[4] = $bdd->lastInsertId();
    add_specificHistory($userid,$element,$internalid,"Unvalidation");
  }

  return $resultArray;
}
