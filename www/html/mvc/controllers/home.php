<?php

include_once('mvc/models/nendoroids.php');
$count_nendoroids = count_allNendoroids();
$nendoroids = get_allNendoroids();
foreach ($nendoroids as $key => $nendoroid) {
  $nendoroids[$key]['url'] = preg_replace('/^-+|-+$/', '', strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $nendoroid['name'])));
}
include_once('mvc/models/boxes.php');
$count_boxes = count_allBoxes();
include_once('mvc/models/faces.php');
$count_faces = count_allFaces();
include_once('mvc/models/hairs.php');
$count_hairs = count_allHairs();
include_once('mvc/models/bodyparts.php');
$count_bodyparts = count_allBodyParts();
include_once('mvc/models/hands.php');
$count_hands = count_allHands();
include_once('mvc/models/accessories.php');
$count_accessories = count_allAccessories();

$page_title = "Nendoroids DB";

include_once('mvc/views/pages/skeleton.php');
