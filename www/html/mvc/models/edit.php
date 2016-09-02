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
    "boxes"       =>  array(null,"number","name","series","manufacturer","category","price","releasedate","specifications","sculptor","cooperation","officialurl"),
    "faces"       =>  array(""),
    "hairs"       =>  array(""),
    "hands"       =>  array(""),
    "nendoroids"  =>  array(""),
    );
  $keyfield = array_search($field,$allowedField[$tablename]);
  $field = $allowedField[$tablename][$keyfield];
  $datefield = array(null,"releasedate");
  $keydatefield = array_search($field, $datefield);
  if( $keydatefield ){
    $value = split("/",$value)[0]."-".split("/", $value)[1]."-01";
  }

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
