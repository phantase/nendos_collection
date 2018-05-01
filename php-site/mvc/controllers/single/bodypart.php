<?php

if( isset($_GET['bodypart_internalid']) ){
  $bodypart_internalid = $_GET['bodypart_internalid'];

  $resultInfo = get_singleBodypart($bodypart_internalid,$_SESSION['userid']);

  if($resultInfo[0]=="00000"){

    $bodypart = $resultInfo[4];

    $bodypart['coll_additionsince'] = ((new DateTime($bodypart['now']))->diff(new DateTime($bodypart['coll_additiondate'])));

    $bodypart['box_url'] = urlize($bodypart['box_name']);

    if( isset($bodypart['nendoroid_name']) && strlen($bodypart['nendoroid_name'])>0 ){
      $bodypart['nendoroid_url'] = urlize($bodypart['nendoroid_name']);
    }

    $og_title = "Bodypart: " . $bodypart['bodypart_part'] 
              . " from " . $bodypart['box_category'] 
              . ((isset($bodypart['box_number']) && strlen($bodypart['box_number'])>0)?" #".$bodypart['box_number']:"") 
              . " - " . $bodypart['box_name'];
    $og_description = "A bodypart described in Nendoroids-db, " 
                    . $bodypart['bodypart_part'] 
                    . " [" . $bodypart['bodypart_main_color'] . ((isset($bodypart['bodypart_other_color']) && strlen($bodypart['bodypart_other_color'])>0)?"/".$bodypart['bodypart_other_color']:"") . "] - " 
                    . $bodypart['bodypart_description'] 
                    . " - From box: " . $bodypart['box_category'] 
                    . ((isset($bodypart['box_number']) && strlen($bodypart['box_number'])>0)?" #".$bodypart['box_number']:"") 
                    . " - " . $bodypart['box_name'];
    $og_image = "http://" . $_SERVER['HTTP_HOST'] . "/images/nendos/bodyparts/" . $bodypart['bodypart_internalid'] . "_thumb";

    $metadata = array('db_creatorid'    =>  $bodypart['db_creatorid'],
                      'db_creatorname'  =>  $bodypart['db_creatorname'],
                      'db_creationdate' =>  $bodypart['db_creationdate'],
                      'db_creationdiff' =>  ((new DateTime($bodypart['now']))->diff(new DateTime($bodypart['db_creationdate']))),
                      'db_editorid'     =>  $bodypart['db_editorid'],
                      'db_editorname'   =>  $bodypart['db_editorname'],
                      'db_editiondate'  =>  $bodypart['db_editiondate'],
                      'db_editiondiff'  =>  ((new DateTime($bodypart['now']))->diff(new DateTime($bodypart['db_editiondate']))),
                      'db_validatorid'     =>  $bodypart['db_validatorid'],
                      'db_validatorname'   =>  $bodypart['db_validatorname'],
                      'db_validationdate'  =>  $bodypart['db_validationdate'],
                      'db_validationdiff'  =>  ((new DateTime($bodypart['now']))->diff(new DateTime($bodypart['db_validationdate']))));

    $resultInfo = get_bodypartHistory($bodypart_internalid);
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

    $page_title = "Bodypart";

  } else {
    raiseError($resultInfo[2]);
  }

} else {
  raiseError('There is no bodypart id provided.');
}

include_once('mvc/views/pages/skeleton.php');
