<?php

if( isset($_GET['face_internalid']) ){
  $face_internalid = $_GET['face_internalid'];

  $resultInfo = get_singleFace($face_internalid,$_SESSION['userid']);

  if($resultInfo[0]=="00000"){

    $face = $resultInfo[4];

    $face['coll_additionsince'] = ((new DateTime($face['now']))->diff(new DateTime($face['coll_additiondate'])));

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
                      'db_editiondiff'  =>  ((new DateTime($face['now']))->diff(new DateTime($face['db_editiondate']))),
                      'db_validatorid'     =>  $face['db_validatorid'],
                      'db_validatorname'   =>  $face['db_validatorname'],
                      'db_validationdate'  =>  $face['db_validationdate'],
                      'db_validationdiff'  =>  ((new DateTime($face['now']))->diff(new DateTime($face['db_validationdate']))));

    $resultInfo = get_faceHistory($face_internalid);
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

    $page_title = "Face";

  } else {
    raiseError($resultInfo[2]);
  }

} else {
  raiseError("There is no face id provided.");
}

include_once('mvc/views/pages/skeleton.php');
