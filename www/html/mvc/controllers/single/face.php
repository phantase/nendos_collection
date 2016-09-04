<?php

if( isset($_GET['face_internalid']) ){
  $face_internalid = $_GET['face_internalid'];

  $resultInfo = get_singleFace($face_internalid);

  if($resultInfo[0]=="00000"){

    $face = $resultInfo[4];

    $face['box_url'] = urlize($face['box_name']);

    if( isset($face['nendoroid_name']) && strlen($face['nendoroid_name'])>0 ){
      $face['nendoroid_url'] = urlize($face['nendoroid_name']);
    }

    $metadata = array('db_creatorid'    =>  $face['db_creatorid'],
                      'db_creatorname'  =>  $face['db_creatorname'],
                      'db_creationdate' =>  $face['db_creationdate'],
                      'db_creationdiff' =>  ((new DateTime($face['now']))->diff(new DateTime($face['db_creationdate']))),
                      'db_editorid'     =>  $face['db_editorid'],
                      'db_editorname'   =>  $face['db_editorname'],
                      'db_editiondate'  =>  $face['db_editiondate'],
                      'db_editiondiff'  =>  ((new DateTime($face['now']))->diff(new DateTime($face['db_editiondate']))));

    $page_title = "face";

  } else {
    $include_page = "error";
    $page_title = "Error";
  }

} else {
  $include_page = "error";
  $page_title = "Error";
}

include_once('mvc/views/pages/skeleton.php');
