<?php

if( isset($_GET['nendointernalid']) ){
  $nendointernalid = $_GET['nendointernalid'];

  include_once('mvc/models/get_nendoroids.php');
  include_once('mvc/models/get_parts.php');
  $nendoroid = get_singleNendoroid($nendointernalid);
  $faces = get_nendoroidFaces($nendointernalid);
  $hands = get_nendoroidHands($nendointernalid);
  $body_parts = get_nendoroidBodyParts($nendointernalid);
  $hairs = get_nendoroidHairs($nendointernalid);
  $accessories = get_nendoroidAccessories($nendointernalid);

  include_once('mvc/views/pages/skeleton.php');

} else {

}
