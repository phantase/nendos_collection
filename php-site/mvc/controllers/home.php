<?php

$resultInfo = get_allNendoroids();
if($resultInfo[0] == "00000" ){

  $nendoroids = $resultInfo[4];
  foreach ($nendoroids as $key => $nendoroid) {
    $nendoroids[$key]['nendoroid_url'] = urlize($nendoroid['nendoroid_name']);
  }

// Global counts
  $count_boxes = count_allBoxes();
  $count_nendoroids = count_allNendoroids();
  $count_faces = count_allFaces();
  $count_hairs = count_allHairs();
  $count_bodyparts = count_allBodyParts();
  $count_hands = count_allHands();
  $count_accessories = count_allAccessories();

  $og_title = "Nendoroids-db - Collect all your Nendoroids parts";
  $og_description = "Nendoroids-db, the unique database for all the Nendoroids parts. Already "
                  . $count_boxes . " boxes, "
                  . $count_nendoroids . " nendoroids, "
                  . $count_faces . " faces, "
                  . $count_hairs . " hairs, "
                  . $count_bodyparts . " bodyparts, "
                  . $count_hands . " hands, "
                  . $count_accessories . " accessories in the database!";
  $og_image = "http://" . $_SERVER['HTTP_HOST'] . "/images/logo.svg";

// User counts - if user is logged in
  if( isset($_SESSION['userid']) ){
    $count_userboxes = getValueOrRaiseError(count_userBoxes($_SESSION['userid']));
    $count_usernendoroids = getValueOrRaiseError(count_userNendoroids($_SESSION['userid']));
    $count_userfaces = getValueOrRaiseError(count_userFaces($_SESSION['userid']));
    $count_userhairs = getValueOrRaiseError(count_userHairs($_SESSION['userid']));
    $count_userhands = getValueOrRaiseError(count_userHands($_SESSION['userid']));
    $count_userbodyparts = getValueOrRaiseError(count_userBodyparts($_SESSION['userid']));
    $count_useraccessories = getValueOrRaiseError(count_userAccessories($_SESSION['userid']));
  }

  $page_title = "Nendoroids DB";
} else {
  raiseError($resultInfo[2]);
}
include_once('mvc/views/pages/skeleton.php');
