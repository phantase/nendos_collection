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
  include_once('mvc/views/pages-sections/func_listings.php');
  include_once('mvc/views/pages-sections/func_counts.php');
  include_once('mvc/views/pages-sections/func_others.php');

  // Retrieve the parameter action which is used to navigate in the MVC
  $action = isset($_GET['action']) ? $_GET['action'] : "home";

  switch($action) {
    // LOGIN, LOGOUT, SIGNUP
    case "login":
    case "logout":
    case "signup":
    // ADD
    case "add_box":
    case "add_nendoroid":
    case "add_face":
    case "add_hair":
    case "add_hand":
    case "add_bodypart":
    case "add_accessory":
    // ADD & EDIT & PICUPLOAD
    case "add":
    case "edit":
    case "picupload":
    case "validate":
    case "unvalidate":
    case "collect":
    case "uncollect":
    // USER EDIT
    case "useredit":
    // VOCABULARY
    case "vocabularies":
    // PHOTO UPLOAD
    case "photoupload":
      $include_page = 'services/'.$action;
      break;
  }

  include_once('mvc/controllers/'.$include_page.'.php');
