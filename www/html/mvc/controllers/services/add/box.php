<?php

header('Content-Type: application/json');

if( ! isset($_SESSION['userid']) ){
  echo json_encode(array('result'=>'failure','reason'=>'Not authorized'));
  exit;
}

if( isset($_POST['new_box_name']) && strlen($_POST['new_box_name'])>0
  && isset($_POST['new_box_category']) && strlen($_POST['new_box_category'])>0 ){

  if( isset($_POST['new_box_number'])           && strlen($_POST['new_box_number'])>0           ){ $new_box_number          = $_POST['new_box_number']; }
  if( isset($_POST['new_box_name'])             && strlen($_POST['new_box_name'])>0             ){ $new_box_name            = $_POST['new_box_name']; }
  if( isset($_POST['new_box_series'])           && strlen($_POST['new_box_series'])>0           ){ $new_box_series          = $_POST['new_box_series']; }
  if( isset($_POST['new_box_manufacturer'])     && strlen($_POST['new_box_manufacturer'])>0     ){ $new_box_manufacturer    = $_POST['new_box_manufacturer']; }
  if( isset($_POST['new_box_category'])         && strlen($_POST['new_box_category'])>0         ){ $new_box_category        = $_POST['new_box_category']; }
  if( isset($_POST['new_box_price'])            && strlen($_POST['new_box_price'])>0            ){ $new_box_price           = $_POST['new_box_price']; }
  if( isset($_POST['new_box_releasedate'])      && strlen($_POST['new_box_releasedate'])>0      ){ $new_box_releasedate     = $_POST['new_box_releasedate']; }
  if( isset($_POST['new_box_specifications'])   && strlen($_POST['new_box_specifications'])>0   ){ $new_box_specifications  = $_POST['new_box_specifications']; }
  if( isset($_POST['new_box_sculptor'])         && strlen($_POST['new_box_sculptor'])>0         ){ $new_box_sculptor        = $_POST['new_box_sculptor']; }
  if( isset($_POST['new_box_cooperation'])      && strlen($_POST['new_box_cooperation'])>0      ){ $new_box_cooperation     = $_POST['new_box_cooperation']; }
  if( isset($_POST['new_box_officialurl'])      && strlen($_POST['new_box_officialurl'])>0      ){ $new_box_officialurl     = $_POST['new_box_officialurl']; }

  $new_box_releasedate = split("/",$new_box_releasedate)[0]."-".split("/",$new_box_releasedate)[1]."-01";

  $resultArray = add_singleBox(
    $new_box_number,
    $new_box_name,
    $new_box_series,
    $new_box_manufacturer,
    $new_box_category,
    $new_box_price,
    $new_box_releasedate,
    $new_box_specifications,
    $new_box_sculptor,
    $new_box_cooperation,
    $new_box_officialurl,
    $_SESSION['userid']);
  if( $resultArray[0] == "00000" ){
    $new_box_internalid = $resultArray[4];
    echo json_encode(array(
        'result'                  =>  'success',
        'new_box_internalid'      =>  $new_box_internalid,
        'new_box_number'          =>  $new_box_number,
        'new_box_name'            =>  $new_box_name,
        'new_box_series'          =>  $new_box_series,
        'new_box_manufacturer'    =>  $new_box_manufacturer,
        'new_box_category'        =>  $new_box_category,
        'new_box_price'           =>  $new_box_price,
        'new_box_releasedate'     =>  $new_box_releasedate,
        'new_box_specifications'  =>  $new_box_specifications,
        'new_box_cooperation'     =>  $new_box_cooperation,
        'new_box_officialurl'     =>  $new_box_officialurl,
        'new_box_url'             =>  urlize($new_box_name)));
  } else {
    echo json_encode(array(
        'result'  =>  'failure',
        'reason'  =>  $resultArray[2]));
  }


} else {
  echo json_encode(array(
        'result'  =>  'failure',
        'reason'  =>  'Bad parameters'));
}
