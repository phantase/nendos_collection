<?php

$quality = 90;
$max_size = 500;

header('Content-Type: application/json');

if( ! isEditor() ){
  echo json_encode(array('result'=>'failure','reason'=>'Not authorized'));
  exit;
}

if( isset($_GET['element']) && isset($_GET['internalid']) ){
  $element = $_GET['element'];
  switch($element){
    case 'accessory':
      $destination_folder = 'images/nendos/accessories/';
      break;
    case 'bodypart':
      $destination_folder = 'images/nendos/bodyparts/';
      break;
    case 'box':
      $destination_folder = 'images/nendos/boxes/';
      break;
    case 'face':
      $destination_folder = 'images/nendos/faces/';
      break;
    case 'hair':
      $destination_folder = 'images/nendos/hairs/';
      break;
    case 'hand':
      $destination_folder = 'images/nendos/hands/';
      break;
    case 'nendoroid':
      $destination_folder = 'images/nendos/nendoroids/';
      break;
    default:
      echo json_encode(array('result'=>'failure','reason'=>'This element is not supported at the moment...'));
      exit;
      break;
  }
  // Just in case, for new and empty project, create the missing folders
  if( !file_exists($destination_folder) ){
    mkdir($destination_folder,0777,true);
  }

  // Upload data can be POST'ed as raw form data or uploaded via <iframe> and <form>
  // using regular multipart/form-data enctype (which is handled by PHP $_FILES).
  if (!empty($_FILES['fd-file']) && is_uploaded_file($_FILES['fd-file']['tmp_name'])) {
    // Regular multipart/form-data upload.
    $name = $_FILES['fd-file']['name'];
    $data = file_get_contents($_FILES['fd-file']['tmp_name']);
    $image_temp = $_FILES['fd-file']['tmp_name'];
  } else {
    // Raw POST data.
    $name = urldecode(@$_SERVER['HTTP_X_FILE_NAME']);
    $data = file_get_contents("php://input");
    $image_temp = "php://input";
  }

  $image_size_info  = getimagesize($image_temp); //get image size

  if($image_size_info){
    $image_width      = $image_size_info[0]; //image width
    $image_height     = $image_size_info[1]; //image height
    $image_type       = $image_size_info['mime']; //image type
  }else{
    echo json_encode(array('result'=>'failure','reason'=>'Image is not valid'));
    exit;
  }

  $internalid = $_GET['internalid'];

  $destination = $destination_folder . $internalid . '_thumb.jpg';
  $destinationfull = $destination_folder . $internalid . '_full.jpg';

  //switch statement below checks allowed image type
  //as well as creates new image from given file
  switch($image_type){
    case 'image/jpeg': case 'image/pjpeg':
      $image_res = imagecreatefromjpeg($image_temp);
      normal_resize_image($image_res, $destination, $image_type, $max_size, $image_width, $image_height, $quality);
      break;
    default:
      $image_res = false;
  }

  if($image_res){
    if(save_image($image_res, $destinationfull, $image_type, $quality)){
      add_specificHistory($_SESSION['userid'],$element,$internalid,"Update","Picture has been updated");
      echo json_encode(array('result'=>'success','part'=>$element,'internalid'=>$internalid));
    }
  } else {
    echo json_encode(array('result'=>'failure','reason'=>'Image is not valid to save as jpeg'));
    exit;
  }
} else {
  echo json_encode(array('result'=>'failure','reason'=>'Not enough information to work'));
  exit;
}
