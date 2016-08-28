<?php

header('Content-Type: application/json');

if( ! isset($_SESSION['userid']) ){
  echo json_encode(array('result'=>'failure','reason'=>'Not authorized'));
  exit;
}

if( isset($_POST['new_face_box_id']) && strlen($_POST['new_face_box_id'])>0
 && isset($_POST['new_face_nendoroid_id'])
 && isset($_POST['new_face_eyes'])
 && isset($_POST['new_face_eyes_color'])
 && isset($_POST['new_face_eyes_color_hex'])
 && isset($_POST['new_face_mouth'])
 && isset($_POST['new_face_skin_color'])
 && isset($_POST['new_face_skin_color_hex'])
 && isset($_POST['new_face_sex'])){

  $face_box_id = $_POST['new_face_box_id'];
  $face_nendoroid_id = $_POST['new_face_nendoroid_id'];
  $face_eyes = $_POST['new_face_eyes'];
  $face_eyes_color = $_POST['new_face_eyes_color'];
  $face_eyes_color_hex = $_POST['new_face_eyes_color_hex'];
  if(strlen($face_eyes_color_hex)>6){
    $face_eyes_color_hex = substr($face_eyes_color_hex,1);
  }
  $face_mouth = $_POST['new_face_mouth'];
  $face_skin_color = $_POST['new_face_skin_color'];
  $face_skin_color_hex = $_POST['new_face_skin_color_hex'];
  if(strlen($face_skin_color_hex)>6){
    $face_skin_color_hex = substr($face_skin_color_hex,1);
  }
  $face_sex = $_POST['new_face_sex'];

  include_once('mvc/models/faces.php');

  $internalid = add_singleFace($face_box_id,
                                $face_nendoroid_id,
                                $face_eyes,
                                $face_eyes_color,
                                $face_eyes_color_hex,
                                $face_mouth,
                                $face_skin_color,
                                $face_skin_color_hex,
                                $face_sex);
  if( isset($internalid) && $internalid != 0 ){
    echo json_encode(array('result'=>'success',
                          'face_internalid'=>$internalid,
                          'face_box_id'=>$face_box_id,
                          'face_nendoroid_id'=>$face_nendoroid_id,
                          'face_eyes'=>$face_eyes,
                          'face_eyes_color'=>$face_eyes_color,
                          'face_eyes_color_hex'=>$face_eyes_color_hex,
                          'face_mouth'=>$face_mouth,
                          'face_skin_color'=>$face_skin_color,
                          'face_skin_color_hex'=>$face_skin_color_hex,
                          'face_sex'=>$face_sex));
  } else {
    echo json_encode(array('result'=>'failure','reason'=>'Not able to create DB record'));
  }


} else {
  echo json_encode(array('result'=>'failure','reason'=>'Bad parameters'));
}
