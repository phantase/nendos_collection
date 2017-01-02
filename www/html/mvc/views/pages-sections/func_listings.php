<?php

function showAccessoriesListing($accessories,$sortingfield=null,$withlinks=false,$withadd=false,$box_url=null,$box_id=null,$nendoroid_url=null,$nendoroid_id=null){
  include('mvc/views/pages-sections/simple_listings/accessories.php');
}

function showBodyPartsListing($bodyparts,$sortingfield=null,$withlinks=false,$withadd=false,$box_url=null,$box_id=null,$nendoroid_url=null,$nendoroid_id=null){
  include('mvc/views/pages-sections/simple_listings/bodyparts.php');
}

function showBoxesListing($boxes,$sortingfield=null,$withlinks=false,$withadd=false){
    include('mvc/views/pages-sections/simple_listings/boxes.php');
}

function showFacesListing($faces,$sortingfield=null,$withlinks=false,$withadd=false,$box_url=null,$box_id=null,$nendoroid_url=null,$nendoroid_id=null){
  include('mvc/views/pages-sections/simple_listings/faces.php');
}

function showHairsListing($hairs,$sortingfield=null,$withlinks=false,$withadd=false,$box_url=null,$box_id=null,$nendoroid_url=null,$nendoroid_id=null){
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
  include('mvc/views/pages-sections/simple_listings/hands.php');
}

function showNendoroidsListing($nendoroids,$options=null){
  $sortingfield   = $options['sortingfield'];
  $withlinks      = $options['withlinks'];
  $withadd        = $options['withadd'];
  $box_url        = $options['box_url'];
  $box_id         = $options['box_id'];
  include('mvc/views/pages-sections/simple_listings/nendoroids.php');
}

function showNendoroidsArticle($nendoroids){
  include('mvc/views/pages-sections/article_listings/nendoroids.php');
}

function showUsersListing($users,$options=null){
  $sortingfield   = $options['sortingfield'];
  $withlinks      = $options['withlinks'];
  include('mvc/views/pages-sections/simple_listings/users.php');
}
