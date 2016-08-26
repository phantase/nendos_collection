<?php

$quality = 90;

header('Content-Type: application/json');

if( ! isset($_SESSION['userid']) ){
  echo json_encode(array('result'=>'failure','reason'=>'Not authorized'));
  exit;
}

if( isset($_GET['part']) && isset($_GET['internalid']) ){
  $part = $_GET['part'];
  switch($part){
    case 'box':
      $destination_folder = 'images/nendos/boxes/';
      break;
    default:
      echo json_encode(array('result'=>'failure','reason'=>'Wrong part'));
      exit;
      break;
  }
  // Just in case, for new and empty project, create the missing folders
  if( !file_exists($destination_folder) ){
    mkdir($destination_folder,0777,true);
  }

  // Upload data can be POST'ed as raw form data or uploaded via <iframe> and <form>
  // using regular multipart/form-data enctype (which is handled by PHP $_FILES).
  if (!empty($_FILES['fd-file']) and is_uploaded_file($_FILES['fd-file']['tmp_name'])) {
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

  //switch statement below checks allowed image type
  //as well as creates new image from given file
  switch($image_type){
    case 'image/jpeg': case 'image/pjpeg':
      $image_res = imagecreatefromjpeg($image_temp); break;
    default:
      $image_res = false;
  }

  if($image_res){
    $destination = $destination_folder . $_GET['internalid'] . '.jpg';
    if(save_image($image_res, $destination, $image_type, $quality)){
      echo json_encode(array('result'=>'success'));
    }
  } else {
    echo json_encode(array('result'=>'failure','reason'=>'Image is not valid to save as jpeg'));
    exit;
  }
} else {
  echo json_encode(array('result'=>'failure','reason'=>'Not enough information to work'));
  exit;
}


##### Saves image resource to file #####
function save_image($source, $destination, $image_type, $quality){
  switch(strtolower($image_type)){//determine mime type
    case 'image/png':
      imagepng($source, $destination); return true; //save png file
      break;
    case 'image/gif':
      imagegif($source, $destination); return true; //save gif file
      break;
    case 'image/jpeg': case 'image/pjpeg':
      imagejpeg($source, $destination, $quality); return true; //save jpeg file
      break;
    default: return false;
  }
}
