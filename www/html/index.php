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

  function urlize($string){
    return preg_replace('/^-+|-+$/', '', strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $string)));
  }

  // Stuff for the access to the DB
  include_once('mvc/models/sql_connection.php');
  // Stuff to have the different renderers for the parts
  include_once('mvc/views/pages-sections/func_listings.php');
  include_once('mvc/views/pages-sections/func_counts.php');

  // Retrieve the parameter action which is used to navigate in the MVC
  $action = isset($_GET['action']) ? $_GET['action'] : "home";

  switch($action) {
    // LOGIN
    case "loginandout":
      include_once('mvc/controllers/services/loginandout.php');
      break;
    // ADD
    case "add_box":
      include_once('mvc/controllers/services/add_box.php');
      break;
    case "add_nendoroid":
      include_once('mvc/controllers/services/add_nendoroid.php');
      break;
    case "add_face":
      include_once('mvc/controllers/services/add_face.php');
      break;
    case "add_hair":
      include_once('mvc/controllers/services/add_hair.php');
      break;
    case "add_hand":
      include_once('mvc/controllers/services/add_hand.php');
      break;
    // ADD PICTURE on SOMETHING
    case "picupload":
      include_once('mvc/controllers/services/picupload.php');
      break;
    // EDIT
    case "edit_box":
      include_once('mvc/controllers/edit_box.php');
      break;
    case "edit_nendoroid":
      include_once('mvc/controllers/edit_nendoroid.php');
      break;
    case "edit_face":
      include_once('mvc/controllers/edit_face.php');
      break;
    case "edit_hair":
      include_once('mvc/controllers/edit_hair.php');
      break;
    case "edit_hand":
      include_once('mvc/controllers/edit_hand.php');
      break;
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
    case "face":
      include_once('mvc/controllers/face.php');
      break;
    case "hair":
      include_once('mvc/controllers/hair.php');
      break;
    case "hand":
      include_once('mvc/controllers/hand.php');
      break;
    // OTHER
    case "credits":
      include_once('mvc/controllers/credits.php');
      break;
    // HOME
    case "home":
    default:
      include_once('mvc/controllers/home.php');
      break;
  }
