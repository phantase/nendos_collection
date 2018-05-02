<?php

if( isset($_GET['hair_internalid']) ){
  $hair_internalid = $_GET['hair_internalid'];

  $resultInfo = get_singleHair($hair_internalid,$_SESSION['userid']);

  if($resultInfo[0]=="00000"){

    $hair = $resultInfo[4];

    $hair['coll_additionsince'] = ((new DateTime($hair['now']))->diff(new DateTime($hair['coll_additiondate'])));

    $hair['box_url'] = urlize($hair['box_name']);

    if( isset($hair['nendoroid_name']) && strlen($hair['nendoroid_name'])>0 ){
      $hair['nendoroid_url'] = urlize($hair['nendoroid_name']);
    }

    $og_title = "Hairs: " . $hair['hair_haircut'] 
              . " from " . $hair['box_category'] 
              . ((isset($hair['box_number']) && strlen($hair['box_number'])>0)?" #".$hair['box_number']:"") 
              . " - " . $hair['box_name'];
    $og_description = "Some hairs described in Nendoroids-db, " 
                    . $hair['hair_frontback'] . " - "
                    . $hair['hair_haircut'] 
                    . " [" . $hair['hair_main_color'] . ((isset($hair['hair_other_color']) && strlen($hair['hair_other_color'])>0)?"/".$hair['hair_other_color']:"") . "] - " 
                    . $hair['hair_description'] 
                    . " - From box: " . $hair['box_category'] 
                    . ((isset($hair['box_number']) && strlen($hair['box_number'])>0)?" #".$hair['box_number']:"") 
                    . " - " . $hair['box_name'];
    $og_image = "http://" . $_SERVER['HTTP_HOST'] . "/images/nendos/hairs/" . $hair['hair_internalid'] . "_thumb";

    $metadata = array('db_creatorid'    =>  $hair['db_creatorid'],
                      'db_creatorname'  =>  $hair['db_creatorname'],
                      'db_creationdate' =>  $hair['db_creationdate'],
                      'db_creationdiff' =>  ((new DateTime($hair['now']))->diff(new DateTime($hair['db_creationdate']))),
                      'db_editorid'     =>  $hair['db_editorid'],
                      'db_editorname'   =>  $hair['db_editorname'],
                      'db_editiondate'  =>  $hair['db_editiondate'],
                      'db_editiondiff'  =>  ((new DateTime($hair['now']))->diff(new DateTime($hair['db_editiondate']))),
                      'db_validatorid'     =>  $hair['db_validatorid'],
                      'db_validatorname'   =>  $hair['db_validatorname'],
                      'db_validationdate'  =>  $hair['db_validationdate'],
                      'db_validationdiff'  =>  ((new DateTime($hair['now']))->diff(new DateTime($hair['db_validationdate']))));

    $resultInfo = get_hairHistory($hair_internalid);
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

    $page_title = "Hair";

  } else {
    raiseError($resultInfo[2]);
  }

} else {
  raiseError("There is no hair id provided.");
}

include_once('mvc/views/pages/skeleton.php');
