<?php

if( isset($_GET['nendointernalid']) ){
  $nendointernalid = $_GET['nendointernalid'];

  include_once('mvc/models/get_nendoroids.php');
  $nendoroid = get_singleNendoroid($nendointernalid);
  include_once('mvc/models/get_faces.php');
  $faces = get_nendoroidFaces($nendointernalid);
  include_once('mvc/models/get_hands.php');
  $hands = get_nendoroidHands($nendointernalid);
  include_once('mvc/models/get_bodyparts.php');
  $body_parts = get_nendoroidBodyParts($nendointernalid);
  include_once('mvc/models/get_hairs.php');
  $hairs = get_nendoroidHairs($nendointernalid);
  include_once('mvc/models/get_accessories.php');
  $accessories = get_nendoroidAccessories($nendointernalid);

  $page_title = $nendoroid['origin']." - ".$nendoroid['name'];

  include_once('mvc/views/pages/skeleton.php');

} else {

}
