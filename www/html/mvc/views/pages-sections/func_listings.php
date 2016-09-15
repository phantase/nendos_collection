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

function showHandsListing($hands,$sortingfield=null,$withlinks=false,$withadd=false,$box_url=null,$box_id=null,$nendoroid_url=null,$nendoroid_id=null){
  include('mvc/views/pages-sections/simple_listings/hands.php');
}

function showNendoroidsListing($nendoroids,$sortingfield=null,$withlinks=false,$withadd=false,$box_url=null,$box_id=null){
  include('mvc/views/pages-sections/simple_listings/nendoroids.php');
}

function showNendoroidsArticle($nendoroids){
  include('mvc/views/pages-sections/article_listings/nendoroids.php');
}

function showUsersListing($users,$sortingfield=null,$withlinks=false){
  include('mvc/views/pages-sections/simple_listings/users.php');
}
