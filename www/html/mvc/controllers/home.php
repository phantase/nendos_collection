<?php

$resultInfo = get_allNendoroids();
if($resultInfo[0] == "00000" ){

  $nendoroids = $resultInfo[4];
  foreach ($nendoroids as $key => $nendoroid) {
    $nendoroids[$key]['nendoroid_url'] = urlize($nendoroid['nendoroid_name']);
  }

  $count_boxes = count_allBoxes();
  $count_nendoroids = count_allNendoroids();
  $count_faces = count_allFaces();
  $count_hairs = count_allHairs();
  $count_bodyparts = count_allBodyParts();
  $count_hands = count_allHands();
  $count_accessories = count_allAccessories();

  $page_title = "Nendoroids DB";
} else {
  $page_title = "Error";
  $include_page = "error";
}
include_once('mvc/views/pages/skeleton.php');
