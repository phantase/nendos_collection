<?php

include_once('mvc/models/get_nendoroids.php');
$count_nendoroids = count_nendoroids();
$nendoroids = get_allNendoroids();
foreach ($nendoroids as $key => $nendoroid) {
  $nendoroids[$key]['url'] = preg_replace('/^-+|-+$/', '', strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $nendoroid['name'])));
}
include_once('mvc/models/get_boxes.php');
$count_boxes = count_nendoroidBoxes();
include_once('mvc/models/get_faces.php');
$count_faces = count_nendoroidFaces();
include_once('mvc/models/get_hairs.php');
$count_hairs = count_nendoroidHairs();
include_once('mvc/models/get_bodyparts.php');
$count_body_parts = count_nendoroidBodyParts();
include_once('mvc/models/get_hands.php');
$count_hands = count_nendoroidHands();
include_once('mvc/models/get_accessories.php');
$count_accessories = count_nendoroidAccessories();

include_once('mvc/views/pages/skeleton.php');
