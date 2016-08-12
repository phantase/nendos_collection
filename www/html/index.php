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
    case "boxes":
      include_once('mvc/controllers/boxes.php');
      break;
    case "nendoroid":
      include_once('mvc/controllers/nendoroid.php');
      break;
    case "nendoroids":
      include_once('mvc/controllers/nendoroids.php');
      break;
    case "home":
    default:
      include_once('mvc/controllers/home.php');
      break;
  }
