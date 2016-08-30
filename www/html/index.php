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

  function urlize($string){
    return preg_replace('/^-+|-+$/', '', strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $string)));
  }
  function intervalFormater($interval){
    if($interval->y>1){
      return $interval->format('%y years');
    } else if($interval->y>0){
      return $interval->format('1 year');
    } else if($interval->m>1){
      return $interval->format('%m months');
    } else if($interval->m>0){
      return $interval->format('1 month');
    } else if($interval->d>1){
      return $interval->format('%d days');
    } else if($interval->d>0){
      return $interval->format('1 day');
    } else if($interval->h>1){
      return $interval->format('%h hours');
    } else if($interval->h>0){
      return $interval->format('1 hour');
    } else if($interval->i>1){
      return $interval->format('%i minutes');
    } else if($interval->i>0){
      return $interval->format('1 minute');
    } else if($interval->s>1){
      return $interval->format('%s seconds');
    } else if($interval->s>0){
      return $interval->format('1 second');
    }

    return "toto";
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
      $include_page = 'services/'.$action;
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
      $include_page = 'single/'.$action;
      break;
    // OTHER
    case "credits":
      $include_page = $action;
      break;
    // HOME
    case "home":
    default:
      $include_page = 'home';
      break;
  }

  include_once('mvc/controllers/'.$include_page.'.php');
