<?php

header('Content-Type: application/json');

if( ! isset($_SESSION['userid']) ){
  echo json_encode(array('result'=>'failure','reason'=>'Not authorized'));
  exit;
}

if( isset($_POST['new_face_box_internalid']) && strlen($_POST['new_face_box_internalid'])>0
 && isset($_POST['new_face_nendoroid_internalid'])
 && isset($_POST['new_face_eyes'])
 && isset($_POST['new_face_eyes_color'])
 && isset($_POST['new_face_mouth'])
 && isset($_POST['new_face_skin_color'])
 && isset($_POST['new_face_sex'])){

  $new_face_box_internalid       = getPOSTorNULL('new_face_box_internalid');
  $new_face_nendoroid_internalid = getPOSTorNULL('new_face_nendoroid_internalid');
  if($new_face_nendoroid_internalid == "0") {
    $new_face_nendoroid_internalid = null;
  }
  $new_face_eyes                 = getPOSTorNULL('new_face_eyes');
  $new_face_eyes_color           = getPOSTorNULL('new_face_eyes_color');
  $new_face_mouth                = getPOSTorNULL('new_face_mouth');
  $new_face_skin_color           = getPOSTorNULL('new_face_skin_color');
  $new_face_sex                  = getPOSTorNULL('new_face_sex');

  $resultInfo = add_singleFace($new_face_box_internalid,
                                $new_face_nendoroid_internalid,
                                $new_face_eyes,
                                $new_face_eyes_color,
                                $new_face_mouth,
                                $new_face_skin_color,
                                $new_face_sex,
                                $_SESSION['userid']);
  if( $resultInfo[0] == "00000" ){
    echo json_encode(array('result'=>'success',
                          'new_face_internalid'=>$resultInfo[4],
                          'new_face_box_internalid'=>$new_face_box_internalid,
                          'new_face_nendoroid_internalid'=>$new_face_nendoroid_internalid,
                          'new_face_eyes'=>$new_face_eyes,
                          'new_face_eyes_color'=>$new_face_eyes_color,
                          'new_face_mouth'=>$new_face_mouth,
                          'new_face_skin_color'=>$new_face_skin_color,
                          'new_face_sex'=>$new_face_sex));
  } else {
    echo json_encode(array('result'=>'failure','reason'=>$resultInfo[2]));
  }


} else {
  echo json_encode(array('result'=>'failure','reason'=>'Bad parameters'));
}
