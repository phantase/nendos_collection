<?php

if( isset($_GET['box_internalid']) ){
  $box_internalid = $_GET['box_internalid'];

  $resultInfo = get_singleBox($box_internalid,$_SESSION['userid']);
  if($resultInfo[0]!="00000"){
    raiseError($resultInfo[2]);
  }
  $box = $resultInfo[4];
  $box['box_url'] = urlize($box['box_name']);
  if( $box['coll_additiondate'] ) {
    $box['coll_additionsince'] = ((new DateTime($box['now']))->diff(new DateTime($box['coll_additiondate'])));
  }
  $metadata = array('db_creatorid'    =>  $box['db_creatorid'],
                    'db_creatorname'  =>  $box['db_creatorname'],
                    'db_creationdate' =>  $box['db_creationdate'],
                    'db_creationdiff' =>  ((new DateTime($box['now']))->diff(new DateTime($box['db_creationdate']))),
                    'db_editorid'     =>  $box['db_editorid'],
                    'db_editorname'   =>  $box['db_editorname'],
                    'db_editiondate'  =>  $box['db_editiondate'],
                    'db_editiondiff'  =>  ((new DateTime($box['now']))->diff(new DateTime($box['db_editiondate']))),
                    'db_validatorid'     =>  $box['db_validatorid'],
                    'db_validatorname'   =>  $box['db_validatorname'],
                    'db_validationdate'  =>  $box['db_validationdate'],
                    'db_validationdiff'  =>  ((new DateTime($box['now']))->diff(new DateTime($box['db_validationdate']))));

  $resultInfo = get_boxNendoroids($box_internalid,$_SESSION['userid']);
  if($resultInfo[0]!="00000"){
    raiseError($resultInfo[2]);
  }
  $nendoroids = $resultInfo[4];
  foreach ($nendoroids as $key => $nendoroid) {
    $nendoroids[$key]['nendoroid_url'] = urlize($nendoroid['nendoroid_name']);
    if( $nendoroid['coll_additiondate'] ) {
      $nendoroids[$key]['coll_additionsince'] = ((new DateTime($nendoroid['now']))->diff(new DateTime($nendoroid['coll_additiondate'])));
    }
}

  $resultInfo = get_boxFaces($box_internalid,$_SESSION['userid']);
  if($resultInfo[0]!="00000"){
    raiseError($resultInfo[2]);
  }
  $faces = $resultInfo[4];
  foreach ($faces as $key => $face) {
    if( $face['coll_additiondate'] ) {
      $faces[$key]['coll_additionsince'] = ((new DateTime($face['now']))->diff(new DateTime($face['coll_additiondate'])));
    }
  }

  $resultInfo = get_boxHands($box_internalid,$_SESSION['userid']);
  if($resultInfo[0]!="00000"){
    raiseError($resultInfo[2]);
  }
  $hands = $resultInfo[4];
  foreach ($hands as $key => $hand) {
    if( $hand['coll_additiondate'] ) {
      $hands[$key]['coll_additionsince'] = ((new DateTime($hand['now']))->diff(new DateTime($hand['coll_additiondate'])));
    }
  }

  $resultInfo = get_boxBodyParts($box_internalid,$_SESSION['userid']);
  if($resultInfo[0]!="00000"){
    raiseError($resultInfo[2]);
  }
  $bodyparts = $resultInfo[4];
  foreach ($bodyparts as $key => $bodypart) {
    if( $bodypart['coll_additiondate'] ) {
      $bodyparts[$key]['coll_additionsince'] = ((new DateTime($bodypart['now']))->diff(new DateTime($bodypart['coll_additiondate'])));
    }
  }

  $resultInfo = get_boxHairs($box_internalid,$_SESSION['userid']);
  if($resultInfo[0]!="00000"){
    raiseError($resultInfo[2]);
  }
  $hairs = $resultInfo[4];
  foreach ($hairs as $key => $hair) {
    if( $hair['coll_additiondate'] ) {
      $hairs[$key]['coll_additionsince'] = ((new DateTime($hair['now']))->diff(new DateTime($hair['coll_additiondate'])));
    }
  }

  $resultInfo = get_boxAccessories($box_internalid,$_SESSION['userid']);
  if($resultInfo[0]!="00000"){
    raiseError($resultInfo[2]);
  }
  $accessories = $resultInfo[4];
  foreach ($accessories as $key => $accessory) {
    if( $accessory['coll_additiondate'] ) {
      $accessories[$key]['coll_additionsince'] = ((new DateTime($accessory['now']))->diff(new DateTime($accessory['coll_additiondate'])));
    }
  }

  $resultInfo = get_photos4Box($box_internalid);
  if($resultInfo[0]!="00000"){
    raiseError($resultInfo[2]);
  }
  $photos = $resultInfo[4];

  $resultInfo = get_boxHistory($box_internalid);
  if($resultInfo[0]!="00000"){
    raiseError($resultInfo[2]);
  }
  $history = $resultInfo[4];
  foreach ($history as $key => $histentry) {
    $history[$key]['history_actioninterval'] = ((new DateTime($histentry['now']))->diff(new DateTime($histentry['history_actiondate'])));
    $history[$key]['box_url'] = urlize($histentry['box_name']);
    if( isset($histentry['nendoroid_name']) ){
      $history[$key]['nendoroid_url'] = urlize($histentry['nendoroid_name']);
    }
  }

  $page_title = "Box - ".$box['box_category'];
  if($box['box_number']){
    $page_title .= " #".$box['box_number'];
  }
  $page_title .= " ".$box['box_name'];

} else {
  raiseError("There is no box id provided.");
}

include_once('mvc/views/pages/skeleton.php');
