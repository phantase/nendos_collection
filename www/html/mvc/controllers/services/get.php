<?php

header('Content-Type: application/json');

if( ! isset($_GET['internalid']) ){
 raiseError("No box id provided");
}
if( ! isset($_GET['parttype']) ){
 raiseError("No part type of box requested");
}

switch ($_GET['parttype']) {
  case 'nendoroids':
    $resultInfo = get_boxNendoroids($_GET['internalid']);
    $parttype_sg = 'nendoroid';
    break;
  case 'faces':
    $resultInfo = get_boxFaces($_GET['internalid']);
    $parttype_sg = 'face';
    break;
  case 'hairs':
    $resultInfo = get_boxHairs($_GET['internalid']);
    $parttype_sg = 'hair';
    break;
  case 'hands':
    $resultInfo = get_boxHands($_GET['internalid']);
    $parttype_sg = 'hand';
    break;
  case 'bodyparts':
    $resultInfo = get_boxBodyparts($_GET['internalid']);
    $parttype_sg = 'bodypart';
    break;
  case 'accessories':
    $resultInfo = get_boxAccessories($_GET['internalid']);
    $parttype_sg = 'accessory';
    break;
  default:
    raiseError("WTF, this is not a valid part type you requested");
    break;
}

if( $resultInfo[0]=="00000" ){
  $result = $resultInfo[4];
  foreach ($result as $key => $value) {
    $result[$key]['parttype_pl'] = $_GET['parttype'];
    $result[$key]['parttype_sg'] = $parttype_sg;
    if( $parttype_sg == 'nendoroid' ){
      $result[$key]['nendoroid_url'] = urlize($value['nendoroid_name']);
    }
  }
} else {
  raiseError($resultInfo[2]);
}

echo json_encode($result);
