<?php

if( isset($_GET['box_internalid']) ){
  $box_internalid = $_GET['box_internalid'];

  $box = get_singleBox($box_internalid);
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
    $include_page = "error";
    $page_title = "Error";
  }
  $nendoroids = $resultInfo[4];
  foreach ($nendoroids as $key => $nendoroid) {
    $nendoroids[$key]['nendoroid_url'] = urlize($nendoroid['nendoroid_name']);
  }

  $resultInfo = get_boxFaces($box_internalid);
  if($resultInfo[0]!="00000"){
    $include_page = "error";
    $page_title = "Error";
  }
  $faces = $resultInfo[4];

  $resultInfo = get_boxHands($box_internalid);
  if($resultInfo[0]!="00000"){
    $include_page = "error";
    $page_title = "Error";
  }
  $hands = $resultInfo[4];

  $resultInfo = get_boxBodyParts($box_internalid);
  if($resultInfo[0]!="00000"){
    $include_page = "error";
    $page_title = "Error";
  }
  $bodyparts = $resultInfo[4];

  $resultInfo = get_boxHairs($box_internalid);
  if($resultInfo[0]!="00000"){
    $include_page = "error";
    $page_title = "Error";
  }
  $hairs = $resultInfo[4];

  $resultInfo = get_boxAccessories($box_internalid);
  if($resultInfo[0]!="00000"){
    $include_page = "error";
    $page_title = "Error";
  }
  $accessories = $resultInfo[4];

  $page_title = "Box - ".$box['box_category'];
  if($box['box_number']){
    $page_title .= " #".$box['box_number'];
  }
  $page_title .= " ".$box['box_name'];

} else {
  $include_page = "error";
  $page_title = "Error";
}

include_once('mvc/views/pages/skeleton.php');
