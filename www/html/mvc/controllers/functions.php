<?php

/** Used to urlize a string (i.e. transform it to become more pleasant in the address bar) */
function urlize($string){
  return preg_replace('/^-+|-+$/', '', strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $string)));
}

/** Used to transform an interval to something human readable */
function intervalFormater($interval){
  if($interval->y>1){
    return $interval->format('%y years ago');
  } else if($interval->y>0){
    return $interval->format('1 year ago');
  } else if($interval->m>1){
    return $interval->format('%m months ago');
  } else if($interval->m>0){
    return $interval->format('1 month ago');
  } else if($interval->d>1){
    return $interval->format('%d days ago');
  } else if($interval->d>0){
    return $interval->format('1 day ago');
  } else if($interval->h>1){
    return $interval->format('%h hours ago');
  } else if($interval->h>0){
    return $interval->format('1 hour ago');
  } else if($interval->i>1){
    return $interval->format('%i minutes ago');
  } else if($interval->i>0){
    return $interval->format('1 minute ago');
  } else if($interval->s>1){
    return $interval->format('%s seconds ago');
  } else if($interval->s>0){
    return $interval->format('1 second ago');
  }

  return "Right now";
}

/** Used to know if the current user is logged */
function isLogged(){
  return isset($_SESSION['userid']);
}

/** Used to know if the current user have administrator rights */
function isAdministrator(){
  return isset($_SESSION['userid']) && isset($_SESSION['administrator']) && $_SESSION['administrator'];
}

/** Used to know if the current user have validator rights */
function isValidator(){
  return isset($_SESSION['userid']) && isset($_SESSION['validator']) && $_SESSION['validator'];
}

/** Used to know if the current user have editor rights */
function isEditor(){
  return isset($_SESSION['userid']) && isset($_SESSION['editor']) && $_SESSION['editor'];
}

function getPOSTorNULL($index){
  if( isset($_POST[$index]) && strlen($_POST[$index]) > 0 ) {
    return $_POST[$index];
  } else {
    return null;
  }
}

function getGETorNULL($index){
  if( isset($_GET[$index]) && strlen($_GET[$index]) > 0 ) {
    return $_GET[$index];
  } else {
    return null;
  }
}

function raiseError($errorMessage){

  $errorMessage = $errorMessage;

  $include_page = "error";
  $page_title = "Error";

  include_once('mvc/views/pages/skeleton.php');

  exit;
}

function getValueOrRaiseError($resultInfo){
  if($resultInfo[0]=="00000"){
    return $resultInfo[4];
  } else {
    raiseError($resultInfo[2]);
  }
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
  $new_width    = min($max_size,ceil($image_scale * $image_width));
  $new_height   = min($max_size,ceil($image_scale * $image_height));

  $new_canvas   = imagecreatetruecolor( $new_width, $new_height ); //Create a new true color image

  //Copy and resize part of an image with resampling
  if(imagecopyresampled($new_canvas, $source, 0, 0, 0, 0, $new_width, $new_height, $image_width, $image_height)){
    save_image($new_canvas, $destination, $image_type, $quality); //save resized image
  }

  return true;
}

##### This function crops image to create exact square, no matter what its original size! ######
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
