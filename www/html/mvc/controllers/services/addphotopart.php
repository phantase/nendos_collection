<?php

header('Content-Type: application/json');

if( ! isLogged() ){
  echo json_encode(array('result'=>'failure','reason'=>'Not authorized'));
  exit;
}

if( isset($_GET['photoid']) && strlen($_GET['photoid'])>0 ){
  $photoid = $_GET['photoid'];
  if( isset($_GET['parttype']) && strlen($_GET['parttype'])>0 ){
    $parttype = $_GET['parttype'];
    if( isset($_POST['partid']) && strlen($_POST['partid'])>0 ){
      $partid = $_POST['partid'];

      if( isset($_POST['xmin']) && isset($_POST['ymin']) && isset($_POST['xmax']) && isset($_POST['ymax']) ){
        $xmin = $_POST['xmin'];
        $ymin = $_POST['ymin'];
        $xmax = $_POST['xmax'];
        $ymax = $_POST['ymax'];
      } else {
        $xmin = null;
        $ymin = null;
        $xmax = null;
        $ymax = null;
      }

      $resultInfo = add_partPhoto($photoid,$parttype,$partid,$xmin,$ymin,$xmax,$ymax);

      if( $resultInfo[0] == "00000" ){
        echo json_encode(array('result'=>'success',
                              'photo_internalid'=>$photoid,
                              'part_type'=>$parttype,
                              'part_internalid'=>$partid,
                              'annotation_internalid'=>$resultInfo[4]));
        add_specificHistory($_SESSION['userid'],
                            $parttype,$partid,
                            "Addition",
                            $parttype." (".$partid.") has been added to photo (".$photoid.")",$photoid);
      } else {
        echo json_encode(array('result'=>'failure','reason'=>$resultInfo[2]));
      }


    } else {
      echo json_encode(array('result'=>'failure','reason'=>'Missing part type'));
      exit;
    }
  } else {
    echo json_encode(array('result'=>'failure','reason'=>'Missing part type'));
    exit;
  }
} else {
  echo json_encode(array('result'=>'failure','reason'=>'Missing photo identifier'));
  exit;
}
