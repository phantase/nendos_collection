<?php

header('Content-Type: application/json');

if( ! isEditor() ){
  echo json_encode(array('result'=>'failure','reason'=>'Not authorized'));
  exit;
}

if( isset($_POST['new_bodypart_box_internalid']) && strlen($_POST['new_bodypart_box_internalid'])>0
 && isset($_POST['new_bodypart_nendoroid_internalid'])
 && isset($_POST['new_bodypart_part'])
 && isset($_POST['new_bodypart_main_color'])
 && isset($_POST['new_bodypart_other_color'])
 && isset($_POST['new_bodypart_description'])){

  $new_bodypart_box_internalid = getPOSTorNULL('new_bodypart_box_internalid');
  $new_bodypart_nendoroid_internalid = getPOSTorNULL('new_bodypart_nendoroid_internalid');
  if($new_bodypart_nendoroid_internalid == "0") {
    $new_bodypart_nendoroid_internalid = null;
  }
  $new_bodypart_part = getPOSTorNULL('new_bodypart_part');
  $new_bodypart_main_color = getPOSTorNULL('new_bodypart_main_color');
  $new_bodypart_other_color = getPOSTorNULL('new_bodypart_other_color');
  $new_bodypart_description = getPOSTorNULL('new_bodypart_description');

  $resultInfo = add_singleBodypart($new_bodypart_box_internalid,
                                $new_bodypart_nendoroid_internalid,
                                $new_bodypart_part,
                                $new_bodypart_main_color,
                                $new_bodypart_other_color,
                                $new_bodypart_description,
                                $_SESSION['userid']);
  if( $resultInfo[0] == "00000" ){
    echo json_encode(array('result'=>'success',
                          'new_bodypart_internalid'=>$resultInfo[4],
                          'new_bodypart_box_internalid'=>$new_bodypart_box_internalid,
                          'new_bodypart_nendoroid_internalid'=>$new_bodypart_nendoroid_internalid,
                          'new_bodypart_part'=>$new_bodypart_part,
                          'new_bodypart_main_color'=>$new_bodypart_main_color,
                          'new_bodypart_other_color'=>$new_bodypart_other_color,
                          'new_bodypart_description'=>$new_bodypart_description));
    add_history($_SESSION['userid'],$new_bodypart_box_internalid,$new_bodypart_nendoroid_internalid,
                null,$resultInfo[4],null,null,null,
                "Creation","");
  } else {
    echo json_encode(array('result'=>'failure','reason'=>$resultInfo[2]));
  }


} else {
  echo json_encode(array('result'=>'failure','reason'=>'Bad parameters'));
}
