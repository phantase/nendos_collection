<?php

include_once('mvc/models/get_nendoroids.php');
$count_nendoroids = count_allNendoroids();
$nendoroids = get_allNendoroids();
foreach ($nendoroids as $key => $nendoroid) {
  $nendoroids[$key]['url'] = preg_replace('/^-+|-+$/', '', strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $nendoroid['name'])));
}
include_once('mvc/models/get_boxes.php');
$count_boxes = count_allBoxes();
include_once('mvc/models/get_faces.php');
$count_faces = count_allFaces();
include_once('mvc/models/get_hairs.php');
$count_hairs = count_allHairs();
include_once('mvc/models/get_bodyparts.php');
$count_body_parts = count_allBodyParts();
include_once('mvc/models/get_hands.php');
$count_hands = count_allHands();
include_once('mvc/models/get_accessories.php');
$count_accessories = count_allAccessories();

include_once('mvc/views/pages/skeleton.php');
