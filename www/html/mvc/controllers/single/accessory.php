<?php

if( isset($_GET['accessory_internalid']) ){
  $accessory_internalid = $_GET['accessory_internalid'];

  $resultInfo = get_singleAccessory($accessory_internalid);

  if($resultInfo[0]=="00000"){

    $accessory = $resultInfo[4];

    $accessory['box_url'] = urlize($accessory['box_name']);

    if( isset($accessory['nendoroid_name']) && strlen($accessory['nendoroid_name'])>0 ){
      $accessory['nendoroid_url'] = urlize($accessory['nendoroid_name']);
    }

    $metadata = array('db_creatorid'    =>  $accessory['db_creatorid'],
                      'db_creatorname'  =>  $accessory['db_creatorname'],
                      'db_creationdate' =>  $accessory['db_creationdate'],
                      'db_creationdiff' =>  ((new DateTime($accessory['now']))->diff(new DateTime($accessory['db_creationdate']))),
                      'db_editorid'     =>  $accessory['db_editorid'],
                      'db_editorname'   =>  $accessory['db_editorname'],
                      'db_editiondate'  =>  $accessory['db_editiondate'],
                      'db_editiondiff'  =>  ((new DateTime($accessory['now']))->diff(new DateTime($accessory['db_editiondate']))));

    $resultInfo = get_accessoryHistory($accessory_internalid);
    if($resultInfo[0]!="00000"){
      $include_page = "error";
      $page_title = "Error";
    }
    $history = $resultInfo[4];
    foreach ($history as $key => $histentry) {
      $history[$key]['history_actioninterval'] = ((new DateTime($histentry['now']))->diff(new DateTime($histentry['history_actiondate'])));
      $history[$key]['box_url'] = urlize($histentry['box_name']);
      if( isset($histentry['nendoroid_name']) ){
        $history[$key]['nendoroid_url'] = urlize($histentry['nendoroid_name']);
      }
    }

    $page_title = "Accessory";

  } else {
    raiseError($resultInfo[2]);
  }

} else {
  raiseError("There is no accessory id provided.");
}

include_once('mvc/views/pages/skeleton.php');
