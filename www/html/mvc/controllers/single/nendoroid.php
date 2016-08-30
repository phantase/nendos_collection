<?php

if( isset($_GET['nendointernalid']) ){
  $nendointernalid = $_GET['nendointernalid'];

  include_once('mvc/models/nendoroids.php');
  $nendoroid = get_singleNendoroid($nendointernalid);
  $nendoroid['url'] = preg_replace('/^-+|-+$/', '', strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $nendoroid['name'])));
  $metadata = array('creator'=>$nendoroid['creator'],
                    'creator_name'=>$nendoroid['creator_name'],
                    'creation'=>$nendoroid['creation'],
                    'creation_diff'=>((new DateTime($nendoroid['now']))->diff(new DateTime($nendoroid['creation']))),
                    'editor'=>$nendoroid['editor'],
                    'editor_name'=>$nendoroid['editor_name'],
                    'edition'=>$nendoroid['edition'],
                    'edition_diff'=>((new DateTime($nendoroid['now']))->diff(new DateTime($nendoroid['edition']))));
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
