<?php

if( isset($_GET['box_internalid']) ){
  $box_internalid = $_GET['box_internalid'];

  include_once('mvc/models/boxes.php');
  $box = get_singleBox($box_internalid);
  $box['box_url'] = urlize($box['box_name']);
  $metadata = array('db_creatorid'    =>  $box['db_creatorid'],
                    'db_creatorname'  =>  $box['db_creatorname'],
                    'db_creationdate' =>  $box['db_creationdate'],
                    'db_creationdiff' =>  ((new DateTime($box['now']))->diff(new DateTime($box['db_creationdate']))),
                    'db_editorid'     =>  $box['db_editorid'],
                    'db_editorname'   =>  $box['db_editorname'],
                    'db_editiondate'  =>  $box['db_editiondate'],
                    'db_editiondiff'  =>  ((new DateTime($box['now']))->diff(new DateTime($box['db_editiondate']))));
  include_once('mvc/models/nendoroids.php');
  $nendoroids = get_boxNendoroids($box_internalid);
  foreach ($nendoroids as $key => $nendoroid) {
    $nendoroids[$key]['nendoroid_url'] = urlize($nendoroid['nendoroid_name']);
  }
  include_once('mvc/models/faces.php');
  $faces = get_boxFaces($box_internalid);
  include_once('mvc/models/hands.php');
  $hands = get_boxHands($box_internalid);
  include_once('mvc/models/bodyparts.php');
  $bodyparts = get_boxBodyParts($box_internalid);
  include_once('mvc/models/hairs.php');
  $hairs = get_boxHairs($box_internalid);
  include_once('mvc/models/accessories.php');
  $accessories = get_boxAccessories($box_internalid);

  $page_title = "Box - ".$box['box_category'];
  if($box['box_number']){
    $page_title .= " #".$box['box_number'];
  }
  $page_title .= " ".$box['box_name'];

  include_once('mvc/views/pages/skeleton.php');

} else {

}
