<?php

header('Content-Type: application/json');

if( ! isEditor() ){
  echo json_encode(array('result'=>'failure','reason'=>'Not authorized'));
  exit;
}

if( isset($_POST['new_hand_box_internalid']) && strlen($_POST['new_hand_box_internalid'])>0
 && isset($_POST['new_hand_nendoroid_internalid'])
 && isset($_POST['new_hand_skin_color'])
 && isset($_POST['new_hand_leftright'])
 && isset($_POST['new_hand_posture'])
 && isset($_POST['new_hand_description'])){

  $new_hand_box_internalid = getPOSTorNULL('new_hand_box_internalid');
  $new_hand_nendoroid_internalid = getPOSTorNULL('new_hand_nendoroid_internalid');
  if($new_hand_nendoroid_internalid == "0") {
    $new_hand_nendoroid_internalid = null;
  }
  $new_hand_skin_color = getPOSTorNULL('new_hand_skin_color');
  $new_hand_leftright = getPOSTorNULL('new_hand_leftright');
  $new_hand_posture = getPOSTorNULL('new_hand_posture');
  $new_hand_description = getPOSTorNULL('new_hand_description');

  $resultInfo = add_singleHand($new_hand_box_internalid,
                                $new_hand_nendoroid_internalid,
                                $new_hand_skin_color,
                                $new_hand_leftright,
                                $new_hand_posture,
                                $new_hand_description,
                                $_SESSION['userid']);
  if( $resultInfo[0] == "00000" ){
    echo json_encode(array('result'=>'success',
                          'new_hand_internalid'=>$resultInfo[4],
                          'new_hand_box_internalid'=>$new_hand_box_internalid,
                          'new_hand_nendoroid_internalid'=>$new_hand_nendoroid_internalid,
                          'new_hand_skin_color'=>$new_hand_skin_color,
                          'new_hand_leftright'=>$new_hand_leftright,
                          'new_hand_posture'=>$new_hand_posture,
                          'new_hand_description'=>$new_hand_description));
    add_history($_SESSION['userid'],$new_hand_box_internalid,$new_hand_nendoroid_internalid,
                null,null,null,null,$resultInfo[4],
                "Creation","");
  } else {
    echo json_encode(array('result'=>'failure','reason'=>$resultInfo[2]));
  }


} else {
  echo json_encode(array('result'=>'failure','reason'=>'Bad parameters'));
}
