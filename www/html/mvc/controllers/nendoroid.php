<?php

if( isset($_GET['nendointernalid']) ){
  $nendointernalid = $_GET['nendointernalid'];

  include_once('mvc/models/nendoroids.php');
  $nendoroid = get_singleNendoroid($nendointernalid);
  include_once('mvc/models/faces.php');
  $faces = get_nendoroidFaces($nendointernalid);
  include_once('mvc/models/hands.php');
  $hands = get_nendoroidHands($nendointernalid);
  include_once('mvc/models/bodyparts.php');
  $bodyparts = get_nendoroidBodyParts($nendointernalid);
  include_once('mvc/models/hairs.php');
  $hairs = get_nendoroidHairs($nendointernalid);
  include_once('mvc/models/accessories.php');
  $accessories = get_nendoroidAccessories($nendointernalid);

  $page_title = $nendoroid['origin']." - ".$nendoroid['name'];

  include_once('mvc/views/pages/skeleton.php');

} else {

}
