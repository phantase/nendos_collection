<?php

if( isset($_GET['bodypart_internalid']) ){
  $bodypart_internalid = $_GET['bodypart_internalid'];

  $resultInfo = get_singleBodypart($bodypart_internalid);

  if($resultInfo[0]=="00000"){

    $bodypart = $resultInfo[4];

    $bodypart['box_url'] = urlize($bodypart['box_name']);

    if( isset($bodypart['nendoroid_name']) && strlen($bodypart['nendoroid_name'])>0 ){
      $bodypart['nendoroid_url'] = urlize($bodypart['nendoroid_name']);
    }

    $metadata = array('db_creatorid'    =>  $bodypart['db_creatorid'],
                      'db_creatorname'  =>  $bodypart['db_creatorname'],
                      'db_creationdate' =>  $bodypart['db_creationdate'],
                      'db_creationdiff' =>  ((new DateTime($bodypart['now']))->diff(new DateTime($bodypart['db_creationdate']))),
                      'db_editorid'     =>  $bodypart['db_editorid'],
                      'db_editorname'   =>  $bodypart['db_editorname'],
                      'db_editiondate'  =>  $bodypart['db_editiondate'],
                      'db_editiondiff'  =>  ((new DateTime($bodypart['now']))->diff(new DateTime($bodypart['db_editiondate']))));

    $page_title = "bodypart";

  } else {
    $include_page = "error";
    $page_title = "Error";
  }

} else {
  $include_page = "error";
  $page_title = "Error";
}

include_once('mvc/views/pages/skeleton.php');
