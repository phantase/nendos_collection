<?php

if( isset($_GET['order']) && isset($_GET['direction']) ){
  $selected_order = $_GET['order'];
  $selected_direction = $_GET['direction'];
} else {
  $selected_order = "photo_uploaded";
  $selected_direction = "desc";
}

$resultInfo = get_allPhotos($selected_order,$selected_direction,$_SESSION['userid']);
if($resultInfo[0]=="00000"){
  $photos = $resultInfo[4];
  foreach ($photos as $key => $photo) {
    $photo[$key]['photo_uploadedsince'] = ((new DateTime($photo['now']))->diff(new DateTime($photo['photo_uploaded'])));
    $photo[$key]['photo_updatedsince'] = ((new DateTime($photo['now']))->diff(new DateTime($photo['photo_updated'])));
  }
  $page_title = "Photos";

  $photo = $photos[0];

  $og_title = "Already " . count($photos) . " photos uploaded in Nendoroids-db";
  $og_description = "We have " . count($photos) . " photos uploaded in Nendoroids-db. "
        . "The last one is a " . $photo['photo_title']
        . " - From " . $photo['photo_username'];
  $og_image = "http://" . $_SERVER['HTTP_HOST'] . "/images/nendos/photos/" . $photo['photo_internalid'] . "_thumb";

} else {
  raiseError($resultInfo[2]);
}

include_once('mvc/views/pages/skeleton.php');
