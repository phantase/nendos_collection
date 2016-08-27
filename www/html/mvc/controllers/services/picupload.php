<?php

$quality = 90;
$max_size = 500;

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
    case 'nendoroid':
      $destination_folder = 'images/nendos/nendoroids/';
      break;
    default:
      echo json_encode(array('result'=>'failure','reason'=>'This part is not supported at the moment...'));
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

  $internalid = $_GET['internalid'];

  $destination = $destination_folder . $internalid . '.jpg';
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
      echo json_encode(array('result'=>'success','part'=>$part,'internalid'=>$internalid));
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
#####  This function will proportionally resize image #####
function normal_resize_image($source, $destination, $image_type, $max_size, $image_width, $image_height, $quality){

  if($image_width <= 0 || $image_height <= 0){return false;} //return false if nothing to resize

  //do not resize if image is smaller than max size
  if($image_width <= $max_size && $image_height <= $max_size){
    if(save_image($source, $destination, $image_type, $quality)){
      return true;
    }
  }

  //Construct a proportional size of new image
  $image_scale  = min($max_size/$image_width, $max_size/$image_height);
  $new_width    = ceil($image_scale * $image_width);
  $new_height   = ceil($image_scale * $image_height);

  $new_canvas   = imagecreatetruecolor( $new_width, $new_height ); //Create a new true color image

  //Copy and resize part of an image with resampling
  if(imagecopyresampled($new_canvas, $source, 0, 0, 0, 0, $new_width, $new_height, $image_width, $image_height)){
    save_image($new_canvas, $destination, $image_type, $quality); //save resized image
  }

  return true;
}

##### This function corps image to create exact square, no matter what its original size! ######
function crop_image_square($source, $destination, $image_type, $square_size, $image_width, $image_height, $quality){
  if($image_width <= 0 || $image_height <= 0){return false;} //return false if nothing to resize

  if( $image_width > $image_height )
  {
    $y_offset = 0;
    $x_offset = ($image_width - $image_height) / 2;
    $s_size   = $image_width - ($x_offset * 2);
  }else{
    $x_offset = 0;
    $y_offset = ($image_height - $image_width) / 2;
    $s_size = $image_height - ($y_offset * 2);
  }
  $new_canvas = imagecreatetruecolor( $square_size, $square_size); //Create a new true color image

  //Copy and resize part of an image with resampling
  if(imagecopyresampled($new_canvas, $source, 0, 0, $x_offset, $y_offset, $square_size, $square_size, $s_size, $s_size)){
    save_image($new_canvas, $destination, $image_type, $quality);
  }

  return true;
}
