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
  // Arbitrary set
  date_default_timezone_set('Europe/Paris');

  include_once('mvc/controllers/functions.php');
  // Stuff for the access to the DB
  include_once('mvc/models/sql_connection.php');
  // Stuff to have the different renderers for the parts
  include_once('mvc/views/pages-sections/func_collecting.php');
  include_once('mvc/views/pages-sections/func_listings.php');
  include_once('mvc/views/pages-sections/func_counts.php');
  include_once('mvc/views/pages-sections/func_others.php');

  // Retrieve the parameter action which is used to navigate in the MVC
  $action = isset($_GET['action']) ? $_GET['action'] : "home";

  switch($action) {
    // ADD & COLLECT
    case "add":
    case "collect":
      $include_page = $action;
      break;
    // EDIT
    case "edit_box":
    case "edit_nendoroid":
    case "edit_face":
    case "edit_hair":
    case "edit_hand":
    case "edit_bodypart":
    case "edit_accessory":
      $include_page = 'edit/'.$action;
      break;
    // LISTINGS
    case "boxes":
    case "nendoroids":
    case "faces":
    case "hairs":
    case "hands":
    case "bodyparts":
    case "accessories":
    case "users":
      $include_page = 'listings/'.$action;
      break;
    // SINGLE PAGES
    case "box":
    case "nendoroid":
    case "face":
    case "hair":
    case "hand":
    case "bodypart":
    case "accessory":
    case "user":
      $include_page = 'single/'.$action;
      break;
    // PHOTOS
    case "addphoto":
      $include_page = 'photos/add';
      break;
    // OTHER
    case "credits":
    case "login":
    case "signup":
      $include_page = $action;
      break;
    // HOME
    case "home":
    default:
      $include_page = 'home';
      break;
  }

  include_once('mvc/controllers/'.$include_page.'.php');
