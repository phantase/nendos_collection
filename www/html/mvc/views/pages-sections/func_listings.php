<?php

function showAccessoriesListing($accessories,$renderer,$withlinks=false,$withadd=false){
  switch($renderer){
    case "article":
      include('mvc/views/pages-sections/article_listings/accessories.php');
      break;
    case "simple":
      include('mvc/views/pages-sections/simple_listings/accessories.php');
      break;
  }
}

function showBodyPartsListing($bodyparts,$renderer,$withlinks=false,$withadd=false){
  switch($renderer){
    case "article":
      include('mvc/views/pages-sections/article_listings/bodyparts.php');
      break;
    case "simple":
      include('mvc/views/pages-sections/simple_listings/bodyparts.php');
      break;
  }
}

function showBoxesListing($boxes,$renderer,$withlinks=false,$withadd=false){
  switch($renderer){
    case "article":
      include('mvc/views/pages-sections/article_listings/boxes.php');
      break;
    case "simple":
      include('mvc/views/pages-sections/simple_listings/boxes.php');
      break;
  }
}

function showFacesListing($faces,$renderer,$withlinks=false,$withadd=false,$box_name=null,$box_id=null,$nendoroid_url=null,$nendoroid_id=null){
  switch($renderer){
    case "article":
      include('mvc/views/pages-sections/article_listings/faces.php');
      break;
    case "simple":
      include('mvc/views/pages-sections/simple_listings/faces.php');
      break;
  }
}

function showHairsListing($hairs,$renderer,$withlinks=false,$withadd=false,$box_name=null,$box_id=null,$nendoroid_url=null,$nendoroid_id=null){
  switch($renderer){
    case "article":
      include('mvc/views/pages-sections/article_listings/hairs.php');
      break;
    case "simple":
      include('mvc/views/pages-sections/simple_listings/hairs.php');
      break;
  }
}

function showHandsListing($hands,$renderer,$withlinks=false,$withadd=false){
  switch($renderer){
    case "article":
      include('mvc/views/pages-sections/article_listings/hands.php');
      break;
    case "simple":
      include('mvc/views/pages-sections/simple_listings/hands.php');
      break;
  }
}

function showNendoroidsListing($nendoroids,$renderer,$withlinks=false,$withadd=false,$box_name=null,$box_id=null){
  switch($renderer){
    case "article":
    case "home":
      include('mvc/views/pages-sections/article_listings/nendoroids.php');
      break;
    case "simple":
      include('mvc/views/pages-sections/simple_listings/nendoroids.php');
      break;
  }
}
