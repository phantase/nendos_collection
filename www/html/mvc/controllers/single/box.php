<?php

if( isset($_GET['boxinternalid']) ){
  $boxinternalid = $_GET['boxinternalid'];

  include_once('mvc/models/boxes.php');
  $box = get_singleBox($boxinternalid);
  include_once('mvc/models/nendoroids.php');
  $nendoroids = get_boxNendoroids($boxinternalid);
  foreach ($nendoroids as $key => $nendoroid) {
    $nendoroids[$key]['url'] = preg_replace('/^-+|-+$/', '', strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $nendoroid['name'])));
  }
  include_once('mvc/models/faces.php');
  $faces = get_boxFaces($boxinternalid);
  include_once('mvc/models/hands.php');
  $hands = get_boxHands($boxinternalid);
  include_once('mvc/models/bodyparts.php');
  $bodyparts = get_boxBodyParts($boxinternalid);
  include_once('mvc/models/hairs.php');
  $hairs = get_boxHairs($boxinternalid);
  include_once('mvc/models/accessories.php');
  $accessories = get_boxAccessories($boxinternalid);

  $page_title = "Box - ".$box['type']." #".$box['name'];

  include_once('mvc/views/pages/skeleton.php');

} else {

}
