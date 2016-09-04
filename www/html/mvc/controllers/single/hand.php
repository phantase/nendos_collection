<?php

if( isset($_GET['hand_internalid']) ){
  $hand_internalid = $_GET['hand_internalid'];

  $resultInfo = get_singleHand($hand_internalid);

  if($resultInfo[0]=="00000"){

    $hand = $resultInfo[4];

    $hand['box_url'] = urlize($hand['box_name']);

    if( isset($hand['nendoroid_name']) && strlen($hand['nendoroid_name'])>0 ){
      $hand['nendoroid_url'] = urlize($hand['nendoroid_name']);
    }

    $metadata = array('db_creatorid'    =>  $hand['db_creatorid'],
                      'db_creatorname'  =>  $hand['db_creatorname'],
                      'db_creationdate' =>  $hand['db_creationdate'],
                      'db_creationdiff' =>  ((new DateTime($hand['now']))->diff(new DateTime($hand['db_creationdate']))),
                      'db_editorid'     =>  $hand['db_editorid'],
                      'db_editorname'   =>  $hand['db_editorname'],
                      'db_editiondate'  =>  $hand['db_editiondate'],
                      'db_editiondiff'  =>  ((new DateTime($hand['now']))->diff(new DateTime($hand['db_editiondate']))));

    $page_title = "hand";

  } else {
    $include_page = "error";
    $page_title = "Error";
  }

} else {
  $include_page = "error";
  $page_title = "Error";
}

include_once('mvc/views/pages/skeleton.php');
