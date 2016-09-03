<?php

if( isset($_GET['nendoroid_internalid']) ){
  $nendoroid_internalid = $_GET['nendoroid_internalid'];

  $resultInfo = get_singleNendoroid($nendoroid_internalid);
  if( $resultInfo[0]=="00000" ){
    $nendoroid = $resultInfo[4];

    $nendoroid['nendoroid_url'] = urlize($nendoroid['nendoroid_name']);
    $nendoroid['box_url'] = urlize($nendoroid['box_name']);

    $metadata = array('db_creatorid'    =>  $nendoroid['db_creatorid'],
                      'db_creatorname'  =>  $nendoroid['db_creatorname'],
                      'db_creationdate' =>  $nendoroid['db_creationdate'],
                      'db_creationdiff' =>  ((new DateTime($nendoroid['now']))->diff(new DateTime($nendoroid['db_creationdate']))),
                      'db_editorid'     =>  $nendoroid['db_editorid'],
                      'db_editorname'   =>  $nendoroid['db_editorname'],
                      'db_editiondate'  =>  $nendoroid['db_editiondate'],
                      'db_editiondiff'  =>  ((new DateTime($nendoroid['now']))->diff(new DateTime($nendoroid['db_editiondate']))));

    $faces = get_nendoroidFaces($nendoroid_internalid);
    $hands = get_nendoroidHands($nendoroid_internalid);
    $bodyparts = get_nendoroidBodyParts($nendoroid_internalid);
    $hairs = get_nendoroidHairs($nendoroid_internalid);
    $accessories = get_nendoroidAccessories($nendoroid_internalid);

    $page_title = $nendoroid['nendoroid_name'];
    if( isset($nendoroid['nendoroid_version']) && strlen($nendoroid['nendoroid_version'])>0){
      $page_title .= " - ".$nendoroid['nendoroid_version'];
    }

  } else {
    $include_page = "error";
    $page_title = "Error";
  }

} else {
  $include_page = "error";
  $page_title = "Error";
}

include_once('mvc/views/pages/skeleton.php');
