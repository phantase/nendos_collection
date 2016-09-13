<?php

if( isset($_GET['box_internalid']) ){
  $box_internalid = $_GET['box_internalid'];

  $resultInfo = get_singleBox($box_internalid);
  if($resultInfo[0]!="00000"){
    raiseError($resultInfo[2]);
  }
  $box = $resultInfo[4];
  $box['box_url'] = urlize($box['box_name']);
  $metadata = array('db_creatorid'    =>  $box['db_creatorid'],
                    'db_creatorname'  =>  $box['db_creatorname'],
                    'db_creationdate' =>  $box['db_creationdate'],
                    'db_creationdiff' =>  ((new DateTime($box['now']))->diff(new DateTime($box['db_creationdate']))),
                    'db_editorid'     =>  $box['db_editorid'],
                    'db_editorname'   =>  $box['db_editorname'],
                    'db_editiondate'  =>  $box['db_editiondate'],
                    'db_editiondiff'  =>  ((new DateTime($box['now']))->diff(new DateTime($box['db_editiondate']))));

  $resultInfo = get_boxNendoroids($box_internalid);
  if($resultInfo[0]!="00000"){
    raiseError($resultInfo[2]);
  }
  $nendoroids = $resultInfo[4];
  foreach ($nendoroids as $key => $nendoroid) {
    $nendoroids[$key]['nendoroid_url'] = urlize($nendoroid['nendoroid_name']);
  }

  $resultInfo = get_boxFaces($box_internalid);
  if($resultInfo[0]!="00000"){
    raiseError($resultInfo[2]);
  }
  $faces = $resultInfo[4];

  $resultInfo = get_boxHands($box_internalid);
  if($resultInfo[0]!="00000"){
    raiseError($resultInfo[2]);
  }
  $hands = $resultInfo[4];

  $resultInfo = get_boxBodyParts($box_internalid);
  if($resultInfo[0]!="00000"){
    raiseError($resultInfo[2]);
  }
  $bodyparts = $resultInfo[4];

  $resultInfo = get_boxHairs($box_internalid);
  if($resultInfo[0]!="00000"){
    raiseError($resultInfo[2]);
  }
  $hairs = $resultInfo[4];

  $resultInfo = get_boxAccessories($box_internalid);
  if($resultInfo[0]!="00000"){
    raiseError($resultInfo[2]);
  }
  $accessories = $resultInfo[4];

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
