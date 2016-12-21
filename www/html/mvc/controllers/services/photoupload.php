<?php

// Upload data can be POST'ed as raw form data or uploaded via <iframe> and <form>
// using regular multipart/form-data enctype (which is handled by PHP $_FILES).
if (!empty($_FILES['fd-file']) and is_uploaded_file($_FILES['fd-file']['tmp_name'])) {
  // Regular multipart/form-data upload.
  $name = $_FILES['fd-file']['name'];
  $inputdata = fopen($_FILES['fd-file']['tmp_name'],'r');
} else {
  // Raw POST data.
  $name = urldecode(@$_SERVER['HTTP_X_FILE_NAME']);
  $inputdata = fopen("php://input",'r');
}

if( $inputdata ) {

  $destination_folder = "images/nendos/photos/";
  $destination_folder_temp = $destination_folder."temp/";
  // Just in case, for new and empty project, create the missing folders
  if( !file_exists($destination_folder_temp) ){
    mkdir($destination_folder_temp,0777,true);
  }

  $destination_temp = $destination_folder_temp . $name;

  $destination_thumb = $destination_folder . 'thumb_' . $name;
  $destination_full = $destination_folder . 'full_' . $name;

  // Copy the input file from the entry to a file in temp directory
  $fp = fopen($destination_temp,"w");
  while($data=fread($inputdata, 1024))
    fwrite($fp, $data);
  fclose($fp);
  fclose($inputdata);

  $image_size_info  = getimagesize($destination_temp); //get image size

  if($image_size_info){
    $image_width      = $image_size_info[0]; //image width
    $image_height     = $image_size_info[1]; //image height
    $image_type       = $image_size_info['mime']; //image type
  }else{
    unlink($destination_temp); // We remove the written file if it's not a picture.
    echo json_encode(array('result'=>'failure','reason'=>'Image is not valid'));
    exit;
  }

  if( ! rename($destination_temp,$destination_full) ){
    echo json_encode(array('result'=>'failure','reason'=>'Unable to process image (mv)'));
    exit;
  }

  $image_res = imagecreatefromjpeg($destination_full);
  if( ! normal_resize_image($image_res,$destination_thumb,$image_type,500,$image_width,$image_height,90) ){
    echo json_encode(array('result'=>'failure','reason'=>'Unable to process image (rz)'));
    exit;
  }

  echo json_encode(array('result'=>'success','blabla'=>'That was cool...'));

} else {
  echo json_encode(array('result'=>'failure','reason'=>'No input data'));
  exit;
}
