<?php

$count_nendoroids = count_allNendoroids();
$nendoroids = get_allNendoroids();
foreach ($nendoroids as $key => $nendoroid) {
  $nendoroids[$key]['url'] = preg_replace('/^-+|-+$/', '', strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $nendoroid['name'])));
}
$count_boxes = count_allBoxes();
$count_faces = count_allFaces();
$count_hairs = count_allHairs();
$count_bodyparts = count_allBodyParts();
$count_hands = count_allHands();
$count_accessories = count_allAccessories();

$page_title = "Nendoroids DB";

include_once('mvc/views/pages/skeleton.php');
