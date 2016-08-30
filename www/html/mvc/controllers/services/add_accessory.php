<?php

header('Content-Type: application/json');

if( ! isset($_SESSION['userid']) ){
  echo json_encode(array('result'=>'failure','reason'=>'Not authorized'));
  exit;
}

if( isset($_POST['new_accessory_box_id']) && strlen($_POST['new_accessory_box_id'])>0
 && isset($_POST['new_accessory_nendoroid_id'])
 && isset($_POST['new_accessory_type'])
 && isset($_POST['new_accessory_main_color'])
 && isset($_POST['new_accessory_main_color_hex'])
 && isset($_POST['new_accessory_other_color'])
 && isset($_POST['new_accessory_other_color_hex'])
 && isset($_POST['new_accessory_description'])){

  $accessory_box_id = $_POST['new_accessory_box_id'];
  $accessory_nendoroid_id = $_POST['new_accessory_nendoroid_id'];
  $accessory_type = $_POST['new_accessory_type'];
  $accessory_main_color = $_POST['new_accessory_main_color'];
  $accessory_main_color_hex = $_POST['new_accessory_main_color_hex'];
  if(strlen($accessory_main_color_hex)>6){
    $accessory_main_color_hex = substr($accessory_main_color_hex,1);
  }
  $accessory_other_color = $_POST['new_accessory_other_color'];
  $accessory_other_color_hex = $_POST['new_accessory_other_color_hex'];
  if(strlen($accessory_other_color_hex)>6){
    $accessory_other_color_hex = substr($accessory_other_color_hex,1);
  }
  $accessory_description = $_POST['new_accessory_description'];

  include_once('mvc/models/accessories.php');

  $internalid = add_singleAccessory($accessory_box_id,
                                $accessory_nendoroid_id,
                                $accessory_type,
                                $accessory_main_color,
                                $accessory_main_color_hex,
                                $accessory_other_color,
                                $accessory_other_color_hex,
                                $accessory_description,
                                $_SESSION['userid']);
  if( isset($internalid) && $internalid != 0 ){
    echo json_encode(array('result'=>'success',
                          'accessory_internalid'=>$internalid,
                          'accessory_box_id'=>$accessory_box_id,
                          'accessory_nendoroid_id'=>$accessory_nendoroid_id,
                          'accessory_part'=>$accessory_part,
                          'accessory_main_color'=>$accessory_main_color,
                          'accessory_main_color_hex'=>$accessory_main_color_hex,
                          'accessory_other_color'=>$accessory_other_color,
                          'accessory_other_color_hex'=>$accessory_other_color_hex,
                          'accessory_description'=>$accessory_description));
  } else {
    echo json_encode(array('result'=>'failure','reason'=>'Not able to create DB record'));
  }


} else {
  echo json_encode(array('result'=>'failure','reason'=>'Bad parameters'));
}
