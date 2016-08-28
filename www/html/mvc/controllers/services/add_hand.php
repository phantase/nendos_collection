<?php

header('Content-Type: application/json');

if( ! isset($_SESSION['userid']) ){
  echo json_encode(array('result'=>'failure','reason'=>'Not authorized'));
  exit;
}

if( isset($_POST['new_hand_box_id']) && strlen($_POST['new_hand_box_id'])>0
 && isset($_POST['new_hand_nendoroid_id'])
 && isset($_POST['new_hand_skin_color'])
 && isset($_POST['new_hand_skin_color_hex'])
 && isset($_POST['new_hand_leftright'])
 && isset($_POST['new_hand_posture'])
 && isset($_POST['new_hand_description'])){

  $hand_box_id = $_POST['new_hand_box_id'];
  $hand_nendoroid_id = $_POST['new_hand_nendoroid_id'];
  $hand_skin_color = $_POST['new_hand_skin_color'];
  $hand_skin_color_hex = $_POST['new_hand_skin_color_hex'];
  if(strlen($hand_skin_color_hex)>6){
    $hand_skin_color_hex = substr($hand_skin_color_hex,1);
  }
  $hand_leftright = $_POST['new_hand_leftright'];
  $hand_posture = $_POST['new_hand_posture'];
  $hand_description = $_POST['new_hand_description'];

  include_once('mvc/models/hands.php');

  $internalid = add_singleHand($hand_box_id,
                                $hand_nendoroid_id,
                                $hand_skin_color,
                                $hand_skin_color_hex,
                                $hand_leftright,
                                $hand_posture,
                                $hand_description);
  if( isset($internalid) && $internalid != 0 ){
    echo json_encode(array('result'=>'success',
                          'hand_internalid'=>$internalid,
                          'hand_box_id'=>$hand_box_id,
                          'hand_nendoroid_id'=>$hand_nendoroid_id,
                          'hand_skin_color'=>$hand_skin_color,
                          'hand_skin_color_hex'=>$hand_skin_color_hex,
                          'hand_leftright'=>$hand_leftright,
                          'hand_posture'=>$hand_posture,
                          'hand_description'=>$hand_description));
  } else {
    echo json_encode(array('result'=>'failure','reason'=>'Not able to create DB record'));
  }


} else {
  echo json_encode(array('result'=>'failure','reason'=>'Bad parameters'));
}
