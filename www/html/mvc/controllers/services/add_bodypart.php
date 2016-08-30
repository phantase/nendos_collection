<?php

header('Content-Type: application/json');

if( ! isset($_SESSION['userid']) ){
  echo json_encode(array('result'=>'failure','reason'=>'Not authorized'));
  exit;
}

if( isset($_POST['new_bodypart_box_id']) && strlen($_POST['new_bodypart_box_id'])>0
 && isset($_POST['new_bodypart_nendoroid_id'])
 && isset($_POST['new_bodypart_part'])
 && isset($_POST['new_bodypart_main_color'])
 && isset($_POST['new_bodypart_main_color_hex'])
 && isset($_POST['new_bodypart_second_color'])
 && isset($_POST['new_bodypart_second_color_hex'])
 && isset($_POST['new_bodypart_description'])){

  $bodypart_box_id = $_POST['new_bodypart_box_id'];
  $bodypart_nendoroid_id = $_POST['new_bodypart_nendoroid_id'];
  $bodypart_part = $_POST['new_bodypart_part'];
  $bodypart_main_color = $_POST['new_bodypart_main_color'];
  $bodypart_main_color_hex = $_POST['new_bodypart_main_color_hex'];
  if(strlen($bodypart_main_color_hex)>6){
    $bodypart_main_color_hex = substr($bodypart_main_color_hex,1);
  }
  $bodypart_second_color = $_POST['new_bodypart_second_color'];
  $bodypart_second_color_hex = $_POST['new_bodypart_second_color_hex'];
  if(strlen($bodypart_second_color_hex)>6){
    $bodypart_second_color_hex = substr($bodypart_second_color_hex,1);
  }
  $bodypart_description = $_POST['new_bodypart_description'];

  include_once('mvc/models/bodyparts.php');

  $internalid = add_singleBodypart($bodypart_box_id,
                                $bodypart_nendoroid_id,
                                $bodypart_main_color,
                                $bodypart_main_color_hex,
                                $bodypart_second_color,
                                $bodypart_second_color_hex,
                                $bodypart_part,
                                $bodypart_description,
                                $_SESSION['userid']);
  if( isset($internalid) && $internalid != 0 ){
    echo json_encode(array('result'=>'success',
                          'bodypart_internalid'=>$internalid,
                          'bodypart_box_id'=>$bodypart_box_id,
                          'bodypart_nendoroid_id'=>$bodypart_nendoroid_id,
                          'bodypart_part'=>$bodypart_part,
                          'bodypart_main_color'=>$bodypart_main_color,
                          'bodypart_main_color_hex'=>$bodypart_main_color_hex,
                          'bodypart_second_color'=>$bodypart_second_color,
                          'bodypart_second_color_hex'=>$bodypart_second_color_hex,
                          'bodypart_description'=>$bodypart_description));
  } else {
    echo json_encode(array('result'=>'failure','reason'=>'Not able to create DB record'));
  }


} else {
  echo json_encode(array('result'=>'failure','reason'=>'Bad parameters'));
}
