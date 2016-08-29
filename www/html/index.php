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
    // ADD
    case "add_box":
    case "add_nendoroid":
    case "add_face":
    case "add_hair":
    case "add_hand":
    case "add_bodypart":
    case "add_accessory":
    // ADD PICTURE on SOMETHING
    case "picupload":
      include_once('mvc/controllers/services/'.$action.'.php');
      break;
    // EDIT
    case "edit_box":
    case "edit_nendoroid":
    case "edit_face":
    case "edit_hair":
    case "edit_hand":
    case "edit_bodypart":
    case "edit_accessory":
      include_once('mvc/controllers/'.$action.'.php');
      break;
    // LISTINGS
    case "boxes":
    case "nendoroids":
    case "faces":
    case "hairs":
    case "hands":
    case "bodyparts":
    case "accessories":
      include_once('mvc/controllers/'.$action.'.php');
      break;
    // SINGLE PAGES
    case "box":
    case "nendoroid":
    case "face":
    case "hair":
    case "hand":
    case "bodypart":
    case "accessory":
      include_once('mvc/controllers/'.$action.'.php');
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
