<?php

if( isset($_GET['accessory_internalid']) ){
  $accessory_internalid = $_GET['accessory_internalid'];

  $resultInfo = get_singleAccessory($accessory_internalid,$_SESSION['userid']);

  if($resultInfo[0]=="00000"){

    $accessory = $resultInfo[4];

    $accessory['coll_additionsince'] = ((new DateTime($accessory['now']))->diff(new DateTime($accessory['coll_additiondate'])));

    $accessory['box_url'] = urlize($accessory['box_name']);

    if( isset($accessory['nendoroid_name']) && strlen($accessory['nendoroid_name'])>0 ){
      $accessory['nendoroid_url'] = urlize($accessory['nendoroid_name']);
    }

    $og_title = "Accessory: " . $accessory['accessory_type'] . " from " . $accessory['box_category'] . ((isset($accessory['box_number']) && strlen($accessory['box_number'])>0)?" #".$accessory['box_number']:"") . " - " . $accessory['box_name'];
    $og_description = "An accessory described in Nendoroids-db, " . $accessory['accessory_type'] . " [" . $accessory['accessory_main_color'] . ((isset($accessory['accessory_other_color']) && strlen($accessory['accessory_other_color'])>0)?"/".$accessory['accessory_other_color']:"") . "] - " . $accessory['accessory_description'] . " - From box: " . $accessory['box_category'] . ((isset($accessory['box_number']) && strlen($accessory['box_number'])>0)?" #".$accessory['box_number']:"") . " - " . $accessory['box_name'];
    $og_image = "http://" . $_SERVER['HTTP_HOST'] . "/images/nendos/accessories/" . $accessory['accessory_internalid'] . "_thumb";

    $metadata = array('db_creatorid'    =>  $accessory['db_creatorid'],
                      'db_creatorname'  =>  $accessory['db_creatorname'],
                      'db_creationdate' =>  $accessory['db_creationdate'],
                      'db_creationdiff' =>  ((new DateTime($accessory['now']))->diff(new DateTime($accessory['db_creationdate']))),
                      'db_editorid'     =>  $accessory['db_editorid'],
                      'db_editorname'   =>  $accessory['db_editorname'],
                      'db_editiondate'  =>  $accessory['db_editiondate'],
                      'db_editiondiff'  =>  ((new DateTime($accessory['now']))->diff(new DateTime($accessory['db_editiondate']))),
                      'db_validatorid'     =>  $accessory['db_validatorid'],
                      'db_validatorname'   =>  $accessory['db_validatorname'],
                      'db_validationdate'  =>  $accessory['db_validationdate'],
                      'db_validationdiff'  =>  ((new DateTime($accessory['now']))->diff(new DateTime($accessory['db_validationdate']))));

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
