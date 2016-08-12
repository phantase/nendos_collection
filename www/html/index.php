<?php

  session_start();

  // Stuff for the i18n (translation/internationalization)
  $lang = isset($_GET['lang']) ? $_GET['lang'] : 'fr';
  switch($lang){
    case 'en':
      $locale = 'en_US';
      break;
    case 'fr':
    default:
      $locale = 'fr_FR';
      break;
  }

  // Stuff for the access to the DB
  include_once('mvc/models/sql_connection.php');

  // Retrieve the parameter action which is used to navigate in the MVC
  $action = isset($_GET['action']) ? $_GET['action'] : "home";

  switch($action) {
    // LISTINGS
    case "boxes":
      include_once('mvc/controllers/boxes.php');
      break;
    case "nendoroids":
      include_once('mvc/controllers/nendoroids.php');
      break;
    case "faces":
      include_once('mvc/controllers/faces.php');
      break;
    case "hairs":
      include_once('mvc/controllers/hairs.php');
      break;
    case "hands":
      include_once('mvc/controllers/hands.php');
      break;
    case "bodyparts":
      include_once('mvc/controllers/bodyparts.php');
      break;
    case "accessories":
      include_once('mvc/controllers/accessories.php');
      break;
    // SINGLE PAGES
    case "box":
      include_once("mvc/controllers/box.php");
      break;
    case "nendoroid":
      include_once('mvc/controllers/nendoroid.php');
      break;
    // HOME
    case "home":
    default:
      include_once('mvc/controllers/home.php');
      break;
  }
