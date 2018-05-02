<?php

if( isset($_GET['hand_internalid']) ){
  $hand_internalid = $_GET['hand_internalid'];

  $resultInfo = get_singleHand($hand_internalid,$_SESSION['userid']);

  if($resultInfo[0]=="00000"){

    $hand = $resultInfo[4];

    $hand['coll_additionsince'] = ((new DateTime($hand['now']))->diff(new DateTime($hand['coll_additiondate'])));

    $hand['box_url'] = urlize($hand['box_name']);

    if( isset($hand['nendoroid_name']) && strlen($hand['nendoroid_name'])>0 ){
      $hand['nendoroid_url'] = urlize($hand['nendoroid_name']);
    }

    $og_title = "Hand: " . $hand['hand_posture'] 
              . " from " . $hand['box_category'] 
              . ((isset($hand['box_number']) && strlen($hand['box_number'])>0)?" #".$hand['box_number']:"") 
              . " - " . $hand['box_name'];
    $og_description = "A hand described in Nendoroids-db, " 
                    . $hand['hand_leftright'] . " - "
                    . $hand['hand_posture'] 
                    . " [" . $hand['hand_skin_color'] . "] - " 
                    . $hand['hand_description'] 
                    . " - From box: " . $hand['box_category'] 
                    . ((isset($hand['box_number']) && strlen($hand['box_number'])>0)?" #".$hand['box_number']:"") 
                    . " - " . $hand['box_name'];
    $og_image = "http://" . $_SERVER['HTTP_HOST'] . "/images/nendos/hands/" . $hand['hand_internalid'] . "_thumb";

    $metadata = array('db_creatorid'    =>  $hand['db_creatorid'],
                      'db_creatorname'  =>  $hand['db_creatorname'],
                      'db_creationdate' =>  $hand['db_creationdate'],
                      'db_creationdiff' =>  ((new DateTime($hand['now']))->diff(new DateTime($hand['db_creationdate']))),
                      'db_editorid'     =>  $hand['db_editorid'],
                      'db_editorname'   =>  $hand['db_editorname'],
                      'db_editiondate'  =>  $hand['db_editiondate'],
                      'db_editiondiff'  =>  ((new DateTime($hand['now']))->diff(new DateTime($hand['db_editiondate']))),
                      'db_validatorid'     =>  $hand['db_validatorid'],
                      'db_validatorname'   =>  $hand['db_validatorname'],
                      'db_validationdate'  =>  $hand['db_validationdate'],
                      'db_validationdiff'  =>  ((new DateTime($hand['now']))->diff(new DateTime($hand['db_validationdate']))));

    $resultInfo = get_handHistory($hand_internalid);
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

    $page_title = "Hand";

  } else {
    raiseError($resultInfo[2]);
  }

} else {
  raiseError("There is no hand id provided.");
}

include_once('mvc/views/pages/skeleton.php');
