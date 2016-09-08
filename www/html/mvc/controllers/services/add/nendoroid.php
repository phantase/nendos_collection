<?php

header('Content-Type: application/json');

if( ! isset($_SESSION['userid']) ){
  echo json_encode(array('result'=>'failure','reason'=>'Not authorized'));
  exit;
}

if( isset($_POST['new_nendoroid_box_internalid']) && strlen($_POST['new_nendoroid_box_internalid'])>0
 && isset($_POST['new_nendoroid_name']) && strlen($_POST['new_nendoroid_name'])>0
 && isset($_POST['new_nendoroid_color']) && strlen($_POST['new_nendoroid_color'])>0 ){

  if( isset($_POST['new_nendoroid_box_internalid']) && strlen($_POST['new_nendoroid_box_internalid'])>0 ){ $new_nendoroid_box_internalid  = $_POST['new_nendoroid_box_internalid']; }
  if( isset($_POST['new_nendoroid_name'])           && strlen($_POST['new_nendoroid_name'])>0           ){ $new_nendoroid_name            = $_POST['new_nendoroid_name']; }
  if( isset($_POST['new_nendoroid_version'])        && strlen($_POST['new_nendoroid_version'])>0        ){ $new_nendoroid_version         = $_POST['new_nendoroid_version']; }
  if( isset($_POST['new_nendoroid_sex'])            && strlen($_POST['new_nendoroid_sex'])>0            ){ $new_nendoroid_sex             = $_POST['new_nendoroid_sex']; }
  if( isset($_POST['new_nendoroid_color'])          && strlen($_POST['new_nendoroid_color'])>0          ){ $new_nendoroid_color           = $_POST['new_nendoroid_color']; }

  if(isset($new_nendoroid_color) && strlen($new_nendoroid_color)>6){
    $new_nendoroid_color = substr($new_nendoroid_color,1);
  }
  $new_nendoroid_url = urlize($new_nendoroid_name);

  $resultInfo = add_singleNendoroid($new_nendoroid_box_internalid,
                                    $new_nendoroid_name,
                                    $new_nendoroid_version,
                                    $new_nendoroid_sex,
                                    $new_nendoroid_color,
                                    $_SESSION['userid']);
  if( $resultInfo[0] == "00000" ){
    echo json_encode(array('result'=>'success',
                          'new_nendoroid_internalid'=>$resultInfo[4],
                          'new_nendoroid_box_internalid'=>$new_nendoroid_box_internalid,
                          'new_nendoroid_name'=>$new_nendoroid_name,
                          'new_nendoroid_version'=>$new_nendoroid_version,
                          'new_nendoroid_sex'=>$new_nendoroid_sex,
                          'new_nendoroid_color'=>$new_nendoroid_color,
                          'new_nendoroid_url'=>$new_nendoroid_url));
    add_history($_SESSION['userid'],$new_nendoroid_box_internalid,$resultInfo[4],
                null,null,null,null,null,
                "Creation","");
  } else {
    echo json_encode(array('result'=>'failure','reason'=>$resultInfo[2]));
  }


} else {
  echo json_encode(array('result'=>'failure','reason'=>'Bad parameters'));
}
