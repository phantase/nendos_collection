<?php

if( isset($_GET['boxinternalid']) ){
  $boxinternalid = $_GET['boxinternalid'];

  include_once('mvc/models/get_boxes.php');
  $box = get_singleBox($boxinternalid);
  include_once('mvc/models/get_nendoroids.php');
  $nendoroids = get_boxNendoroids($boxinternalid);
  foreach ($nendoroids as $key => $nendoroid) {
    $nendoroids[$key]['url'] = preg_replace('/^-+|-+$/', '', strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $nendoroid['name'])));
  }
  include_once('mvc/models/get_faces.php');
  $faces = get_boxFaces($boxinternalid);
  include_once('mvc/models/get_hands.php');
  $hands = get_boxHands($boxinternalid);
  include_once('mvc/models/get_bodyparts.php');
  $bodyparts = get_boxBodyParts($boxinternalid);
  include_once('mvc/models/get_hairs.php');
  $hairs = get_boxHairs($boxinternalid);
  include_once('mvc/models/get_accessories.php');
  $accessories = get_boxAccessories($boxinternalid);

  include_once('mvc/views/pages/skeleton.php');

} else {

}
