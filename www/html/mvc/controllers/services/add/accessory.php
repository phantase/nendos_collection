<?php

header('Content-Type: application/json');

if( ! isset($_SESSION['userid']) ){
  echo json_encode(array('result'=>'failure','reason'=>'Not authorized'));
  exit;
}

if( isset($_POST['new_accessory_box_internalid']) && strlen($_POST['new_accessory_box_internalid'])>0
 && isset($_POST['new_accessory_nendoroid_internalid'])
 && isset($_POST['new_accessory_type'])
 && isset($_POST['new_accessory_main_color'])
 && isset($_POST['new_accessory_other_color'])
 && isset($_POST['new_accessory_description'])){

  $new_accessory_box_internalid = getPOSTorNULL('new_accessory_box_internalid');
  $new_accessory_nendoroid_internalid = getPOSTorNULL('new_accessory_nendoroid_internalid');
  if($new_accessory_nendoroid_internalid == "0") {
    $new_accessory_nendoroid_internalid = null;
  }
  $new_accessory_type = getPOSTorNULL('new_accessory_type');
  $new_accessory_main_color = getPOSTorNULL('new_accessory_main_color');
  $new_accessory_other_color = getPOSTorNULL('new_accessory_other_color');
  $new_accessory_description = getPOSTorNULL('new_accessory_description');

  $resultInfo = add_singleAccessory($new_accessory_box_internalid,
                                $new_accessory_nendoroid_internalid,
                                $new_accessory_type,
                                $new_accessory_main_color,
                                $new_accessory_other_color,
                                $new_accessory_description,
                                $_SESSION['userid']);
  if( $resultInfo[0] == "00000" ){
    echo json_encode(array('result'=>'success',
                          'new_accessory_internalid'=>$resultInfo[4],
                          'new_accessory_box_internalid'=>$new_accessory_box_internalid,
                          'new_accessory_nendoroid_internalid'=>$new_accessory_nendoroid_internalid,
                          'new_accessory_part'=>$new_accessory_part,
                          'new_accessory_main_color'=>$new_accessory_main_color,
                          'new_accessory_other_color'=>$new_accessory_other_color,
                          'new_accessory_description'=>$new_accessory_description));
    add_history($_SESSION['userid'],$new_accessory_box_internalid,$new_accessory_nendoroid_internalid,
                $resultInfo[4],null,null,null,null,
                "Creation","");
  } else {
    echo json_encode(array('result'=>'failure','reason'=>$resultInfo[2]));
  }


} else {
  echo json_encode(array('result'=>'failure','reason'=>'Bad parameters'));
}
