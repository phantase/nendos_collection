<?php
// TODO: add a security check to know is user is logged in or not (using if(isLogged()))
// TODO: add a content-type for this request, maybe just header('Content-Type: application/json');

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
    switch(strtolower($image_type)){//determine file extension
      case 'image/png':
        $image_ext = '.png';
        break;
      case 'image/gif':
        $image_ext = '.gif';
        break;
      case 'image/jpeg': case 'image/pjpeg':
        $image_ext = '.jpg';
        break;
      default:
        unlink($destination_temp); // We remove the written file as it's not a recognized picture.
        echo json_encode(array('result'=>'failure','reason'=>'Image is not valid'));
        exit;
    }
  }else{
    unlink($destination_temp); // We remove the written file if it's not a picture.
    echo json_encode(array('result'=>'failure','reason'=>'Image is not valid'));
    exit;
  }

  $userid = $_SESSION['userid'];

  // File must be an image, so we can add its info in the DB
  $resultInfo = add_singlePhoto($userid,$_GET['title'],$image_width,$image_height);
  if($resultInfo[0] == "00000"){
    $internalid = $resultInfo[4];
  } else {
    echo json_encode(array('result'=>'failure','reason'=>$resultInfo[2]));
    exit;
  }

  $destination_thumb = $destination_folder . $internalid . '_thumb' . $image_ext;
  $destination_full = $destination_folder . $internalid . '_full' . $image_ext;

  if( ! rename($destination_temp,$destination_full) ){
    echo json_encode(array('result'=>'failure','reason'=>'Unable to process image (mv)'));
    exit;
  }

  $image_res = imagecreatefromjpeg($destination_full);
  if( ! normal_resize_image($image_res,$destination_thumb,$image_type,500,$image_width,$image_height,90) ){
    echo json_encode(array('result'=>'failure','reason'=>'Unable to process image (rz)'));
    exit;
  }

  echo json_encode(array('result'=>'success','internalid'=>$internalid));

} else {
  echo json_encode(array('result'=>'failure','reason'=>'No input data'));
  exit;
}
