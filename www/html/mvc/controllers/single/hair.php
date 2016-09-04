<?php

if( isset($_GET['hair_internalid']) ){
  $hair_internalid = $_GET['hair_internalid'];

  $resultInfo = get_singleHair($hair_internalid);

  if($resultInfo[0]=="00000"){

    $hair = $resultInfo[4];

    $hair['box_url'] = urlize($hair['box_name']);

    if( isset($hair['nendoroid_name']) && strlen($hair['nendoroid_name'])>0 ){
      $hair['nendoroid_url'] = urlize($hair['nendoroid_name']);
    }

    $metadata = array('db_creatorid'    =>  $hair['db_creatorid'],
                      'db_creatorname'  =>  $hair['db_creatorname'],
                      'db_creationdate' =>  $hair['db_creationdate'],
                      'db_creationdiff' =>  ((new DateTime($hair['now']))->diff(new DateTime($hair['db_creationdate']))),
                      'db_editorid'     =>  $hair['db_editorid'],
                      'db_editorname'   =>  $hair['db_editorname'],
                      'db_editiondate'  =>  $hair['db_editiondate'],
                      'db_editiondiff'  =>  ((new DateTime($hair['now']))->diff(new DateTime($hair['db_editiondate']))));

    $page_title = "Hair";

  } else {
    $include_page = "error";
    $page_title = "Error";
  }

} else {
  $include_page = "error";
  $page_title = "Error";
}

include_once('mvc/views/pages/skeleton.php');
