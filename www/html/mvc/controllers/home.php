<?php

include_once('mvc/models/get_nendoroids.php');
$nendoroids = get_allNendoroids();
foreach ($nendoroids as $key => $nendoroid) {
  $nendoroids[$key]['url'] = preg_replace('/^-+|-+$/', '', strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $nendoroid['name'])));
}
$count_boxes = count_nendoroidBoxes();
include_once('mvc/models/get_parts.php');
$count_faces = count_nendoroidFaces();
$count_hairs = count_nendoroidHairs();
$count_body_parts = count_nendoroidBodyParts();
$count_hands = count_nendoroidHands();
$count_accessories = count_nendoroidAccessories();

include_once('mvc/views/pages/skeleton.php');
