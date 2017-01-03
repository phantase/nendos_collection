<?php

function showBoxesListing($boxes,$options=null){
  $sortingfield   = $options['sortingfield'];
  $withlinks      = $options['withlinks'];
  $withadd        = $options['withadd'];
  $shareddiv      = $options['shareddiv'];
  $cellsize       = ($options['cellsize'])?$options['cellsize']:"2u 3u(medium) 4u(small)";
  include('mvc/views/pages-sections/simple_listings/boxes.php');
}

function showNendoroidsListing($nendoroids,$options=null){
  $sortingfield   = $options['sortingfield'];
  $withlinks      = $options['withlinks'];
  $withadd        = $options['withadd'];
  $box_url        = $options['box_url'];
  $box_id         = $options['box_id'];
  $shareddiv      = $options['shareddiv'];
  $cellsize       = ($options['cellsize'])?$options['cellsize']:"3u 4u(medium) 6u(small)";
  include('mvc/views/pages-sections/simple_listings/nendoroids.php');
}

function showAccessoriesListing($accessories,$options=null){
  $sortingfield   = $options['sortingfield'];
  $withlinks      = $options['withlinks'];
  $withadd        = $options['withadd'];
  $box_url        = $options['box_url'];
  $box_id         = $options['box_id'];
  $nendoroid_url  = $options['nendoroid_url'];
  $nendoroid_id   = $options['nendoroid_id'];
  $shareddiv      = $options['shareddiv'];
  $cellsize       = ($options['cellsize'])?$options['cellsize']:"2u 3u(small)";
  include('mvc/views/pages-sections/simple_listings/accessories.php');
}

function showBodyPartsListing($bodyparts,$options=null){
  $sortingfield   = $options['sortingfield'];
  $withlinks      = $options['withlinks'];
  $withadd        = $options['withadd'];
  $box_url        = $options['box_url'];
  $box_id         = $options['box_id'];
  $nendoroid_url  = $options['nendoroid_url'];
  $nendoroid_id   = $options['nendoroid_id'];
  $shareddiv      = $options['shareddiv'];
  $cellsize       = ($options['cellsize'])?$options['cellsize']:"2u 3u(small)";
  include('mvc/views/pages-sections/simple_listings/bodyparts.php');
}

function showFacesListing($faces,$options=null){
  $sortingfield   = $options['sortingfield'];
  $withlinks      = $options['withlinks'];
  $withadd        = $options['withadd'];
  $box_url        = $options['box_url'];
  $box_id         = $options['box_id'];
  $nendoroid_url  = $options['nendoroid_url'];
  $nendoroid_id   = $options['nendoroid_id'];
  $shareddiv      = $options['shareddiv'];
  $cellsize       = ($options['cellsize'])?$options['cellsize']:"2u 3u(small)";
  include('mvc/views/pages-sections/simple_listings/faces.php');
}

function showHairsListing($hairs,$options=null){
  $sortingfield   = $options['sortingfield'];
  $withlinks      = $options['withlinks'];
  $withadd        = $options['withadd'];
  $box_url        = $options['box_url'];
  $box_id         = $options['box_id'];
  $nendoroid_url  = $options['nendoroid_url'];
  $nendoroid_id   = $options['nendoroid_id'];
  $shareddiv      = $options['shareddiv'];
  $cellsize       = ($options['cellsize'])?$options['cellsize']:"2u 3u(small)";
  include('mvc/views/pages-sections/simple_listings/hairs.php');
}

function showHandsListing($hands,$options=null){
  $sortingfield   = $options['sortingfield'];
  $withlinks      = $options['withlinks'];
  $withadd        = $options['withadd'];
  $box_url        = $options['box_url'];
  $box_id         = $options['box_id'];
  $nendoroid_url  = $options['nendoroid_url'];
  $nendoroid_id   = $options['nendoroid_id'];
  $shareddiv      = $options['shareddiv'];
  $cellsize       = ($options['cellsize'])?$options['cellsize']:"2u 3u(small)";
  include('mvc/views/pages-sections/simple_listings/hands.php');
}

function showUsersListing($users,$options=null){
  $sortingfield   = $options['sortingfield'];
  $withlinks      = $options['withlinks'];
  include('mvc/views/pages-sections/simple_listings/users.php');
}

function showPhotosListing($photos,$options=null){
  $sortingfield   = $options['sortingfield'];
  $withlinks      = $options['withlinks'];
  $withadd        = $options['withadd'];
  include('mvc/views/pages-sections/simple_listings/photos.php');
}

function showNendoroidsArticle($nendoroids){
  include('mvc/views/pages-sections/article_listings/nendoroids.php');
}
