<?php

if( isset($_GET['nendoroid_internalid']) ){
  $nendoroid_internalid = $_GET['nendoroid_internalid'];

  $resultInfo = get_singleNendoroid($nendoroid_internalid,$_SESSION['userid']);
  if( $resultInfo[0]=="00000" ){
    $nendoroid = $resultInfo[4];

    $nendoroid['nendoroid_url'] = urlize($nendoroid['nendoroid_name']);
    $nendoroid['box_url'] = urlize($nendoroid['box_name']);
    if( $nendoroid['coll_additiondate'] ) {
      $nendoroid['coll_additionsince'] = ((new DateTime($nendoroid['now']))->diff(new DateTime($nendoroid['coll_additiondate'])));
    }

    $metadata = array('db_creatorid'    =>  $nendoroid['db_creatorid'],
                      'db_creatorname'  =>  $nendoroid['db_creatorname'],
                      'db_creationdate' =>  $nendoroid['db_creationdate'],
                      'db_creationdiff' =>  ((new DateTime($nendoroid['now']))->diff(new DateTime($nendoroid['db_creationdate']))),
                      'db_editorid'     =>  $nendoroid['db_editorid'],
                      'db_editorname'   =>  $nendoroid['db_editorname'],
                      'db_editiondate'  =>  $nendoroid['db_editiondate'],
                      'db_editiondiff'  =>  ((new DateTime($nendoroid['now']))->diff(new DateTime($nendoroid['db_editiondate']))),
                      'db_validatorid'     =>  $nendoroid['db_validatorid'],
                      'db_validatorname'   =>  $nendoroid['db_validatorname'],
                      'db_validationdate'  =>  $nendoroid['db_validationdate'],
                      'db_validationdiff'  =>  ((new DateTime($nendoroid['now']))->diff(new DateTime($nendoroid['db_validationdate']))));

    $resultInfo = get_nendoroidFaces($nendoroid_internalid,$_SESSION['userid']);
    if($resultInfo[0]!="00000"){
      raiseError($resultInfo[2]);
    }
    $faces = $resultInfo[4];
    foreach ($faces as $key => $face) {
      if( $face['coll_additiondate'] ) {
        $faces[$key]['coll_additionsince'] = ((new DateTime($face['now']))->diff(new DateTime($face['coll_additiondate'])));
      }
    }

    $resultInfo = get_nendoroidHands($nendoroid_internalid);
    if($resultInfo[0]!="00000"){
      raiseError($resultInfo[2]);
    }
    $hands = $resultInfo[4];

    $resultInfo = get_nendoroidBodyParts($nendoroid_internalid);
    if($resultInfo[0]!="00000"){
      raiseError($resultInfo[2]);
    }
    $bodyparts = $resultInfo[4];

    $resultInfo = get_nendoroidHairs($nendoroid_internalid,$_SESSION['userid']);
    if($resultInfo[0]!="00000"){
      raiseError($resultInfo[2]);
    }
    $hairs = $resultInfo[4];
    foreach ($hairs as $key => $hair) {
      if( $hair['coll_additiondate'] ) {
        $hairs[$key]['coll_additionsince'] = ((new DateTime($hair['now']))->diff(new DateTime($hair['coll_additiondate'])));
      }
    }

    $resultInfo = get_nendoroidAccessories($nendoroid_internalid);
    if($resultInfo[0]!="00000"){
      raiseError($resultInfo[2]);
    }
    $accessories = $resultInfo[4];

    $resultInfo = get_nendoroidHistory($nendoroid_internalid);
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

    $page_title = $nendoroid['nendoroid_name'];
    if( isset($nendoroid['nendoroid_version']) && strlen($nendoroid['nendoroid_version'])>0){
      $page_title .= " - ".$nendoroid['nendoroid_version'];
    }

  } else {
    raiseError($resultInfo[2]);
  }

} else {
  raiseError("There is no nendoroid id provided.");
}

include_once('mvc/views/pages/skeleton.php');
