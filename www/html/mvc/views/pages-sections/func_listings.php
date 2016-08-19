<?php

function showAccessoriesListing($accessories,$renderer,$divider){
  switch($renderer){
    case "article":
      include('mvc/views/pages-sections/articles/accessories.php');
      break;
    case "simple":
      include('mvc/views/pages-sections/simple_listings/accessories.php');
      break;
  }
}

function showBodyPartsListing($bodyparts,$renderer,$divider){
  switch($renderer){
    case "article":
      include('mvc/views/pages-sections/articles/bodyparts.php');
      break;
    case "simple":
      include('mvc/views/pages-sections/simple_listings/bodyparts.php');
      break;
  }
}

function showBoxesListing($boxes,$renderer,$divider){
  switch($renderer){
    case "article":
      include('mvc/views/pages-sections/articles/boxes.php');
      break;
    case "simple":
      include('mvc/views/pages-sections/simple_listings/boxes.php');
      break;
  }
}

function showFacesListing($faces,$renderer,$divider){
  switch($renderer){
    case "article":
      include('mvc/views/pages-sections/articles/faces.php');
      break;
    case "simple":
      include('mvc/views/pages-sections/simple_listings/faces.php');
      break;
  }
}

function showHairsListing($hairs,$renderer,$divider){
  switch($renderer){
    case "article":
      include('mvc/views/pages-sections/articles/hairs.php');
      break;
    case "simple":
      include('mvc/views/pages-sections/simple_listings/hairs.php');
      break;
  }
}

function showHandsListing($hands,$renderer,$divider){
  switch($renderer){
    case "article":
      include('mvc/views/pages-sections/articles/hands.php');
      break;
    case "simple":
      include('mvc/views/pages-sections/simple_listings/hands.php');
      break;
  }
}

function showNendoroidsListing($nendoroids,$renderer,$divider){
  switch($renderer){
    case "article":
      include('mvc/views/pages-sections/articles/nendoroids.php');
      break;
  }
}
