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

    $page_title = "Accessory";

  } else {
    $include_page = "error";
    $page_title = "Error";
  }

} else {
  $include_page = "error";
  $page_title = "Error";
}

include_once('mvc/views/pages/skeleton.php');
