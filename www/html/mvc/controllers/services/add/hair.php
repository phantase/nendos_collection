<?php

header('Content-Type: application/json');

if( ! isset($_SESSION['userid']) ){
  echo json_encode(array('result'=>'failure','reason'=>'Not authorized'));
  exit;
}

if( isset($_POST['new_hair_box_internalid']) && strlen($_POST['new_hair_box_internalid'])>0
 && isset($_POST['new_hair_nendoroid_internalid'])
 && isset($_POST['new_hair_main_color'])
 && isset($_POST['new_hair_other_color'])
 && isset($_POST['new_hair_haircut'])
 && isset($_POST['new_hair_frontback'])
 && isset($_POST['new_hair_description'])){

  $new_hair_box_internalid       = getPOSTorNULL('new_hair_box_internalid');
  $new_hair_nendoroid_internalid = getPOSTorNULL('new_hair_nendoroid_internalid');
  if($new_hair_nendoroid_internalid == "0") {
    $new_hair_nendoroid_internalid = null;
  }
  $new_hair_main_color = getPOSTorNULL('new_hair_main_color');
  $new_hair_other_color = getPOSTorNULL('new_hair_other_color');
  $new_hair_haircut = getPOSTorNULL('new_hair_haircut');
  $new_hair_frontback = getPOSTorNULL('new_hair_frontback');
  $new_hair_description = getPOSTorNULL('new_hair_description');

  $resultInfo = add_singleHair($new_hair_box_internalid,
                                $new_hair_nendoroid_internalid,
                                $new_hair_haircut,
                                $new_hair_main_color,
                                $new_hair_other_color,
                                $new_hair_description,
                                $new_hair_frontback,
                                $_SESSION['userid']);
  if( $resultInfo[0] == "00000" ){
    echo json_encode(array('result'=>'success',
                          'new_hair_internalid'=>$resultInfo[4],
                          'new_hair_box_internalid'=>$new_hair_box_internalid,
                          'new_hair_nendoroid_internalid'=>$new_hair_nendoroid_internalid,
                          'new_hair_main_color'=>$new_hair_main_color,
                          'new_hair_other_color'=>$new_hair_other_color,
                          'new_hair_haircut'=>$new_hair_haircut,
                          'new_hair_frontback'=>$new_hair_frontback,
                          'new_hair_description'=>$new_hair_description));
  } else {
    echo json_encode(array('result'=>'failure','reason'=>$resultInfo[2]));
  }


} else {
  echo json_encode(array('result'=>'failure','reason'=>'Bad parameters'));
}
