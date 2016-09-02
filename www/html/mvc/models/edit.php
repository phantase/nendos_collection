<?php

/** edit and element with a single value */
function edit_singleElement($element,$internalid,$field,$value,$userid)
{
  global $bdd;

  $allowedElement = array("accessory"  ,"bodypart" ,"box"  ,"face" ,"hair" ,"hand" ,"nendoroid" );
  $allowedTable   = array("accessories","bodyparts","boxes","faces","hairs","hands","nendoroids");
  $key = array_search($element, $allowedElement);
  $tablename = $allowedTable[$key];
  $allowedField = array(
    "accessories" =>  array(""),
    "bodyparts"   =>  array(""),
    "boxes"       =>  array("number","name","series","manufacturer","category","officialurl"),
    "faces"       =>  array(""),
    "hairs"       =>  array(""),
    "hands"       =>  array(""),
    "nendoroids"  =>  array(""),
    );
  $key = array_search($field,$allowedField[$tablename]);
  $field = $allowedField[$tablename][$key];

  $req = $bdd->prepare("UPDATE $tablename SET $field = :value, editorid = :editorid WHERE internalid = :internalid");
  $req->bindParam(':internalid',$internalid);
  $req->bindParam(':value',$value);
  $req->bindParam(':editorid',$userid);
  $req->execute();

  $resultArray = $req->errorInfo();
  if($resultArray[0] == 0 ){
    $resultArray[4] = $bdd->lastInsertId();
  }

  return $resultArray;
}
