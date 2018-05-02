<?php

if( isset($_GET['order']) && isset($_GET['direction']) ){
  $selected_order = $_GET['order'];
  $selected_direction = $_GET['direction'];
} else {
  $selected_order = "db_creationdate";
  $selected_direction = "desc";
}

$resultInfo = get_allNendoroids($selected_order,$selected_direction,$_SESSION['userid']);
if($resultInfo[0]=="00000"){
  $nendoroids = $resultInfo[4];
  foreach ($nendoroids as $key => $nendoroid) {
    $nendoroids[$key]['nendoroid_url'] = urlize($nendoroid['nendoroid_name']);
    if( $nendoroid['coll_additiondate'] ) {
      $nendoroids[$key]['coll_additionsince'] = ((new DateTime($nendoroid['now']))->diff(new DateTime($nendoroid['coll_additiondate'])));
    }
  }
  $page_title = "Nendoroids";

  $nendoroid = $nendoroids[0];

  $og_title = "Already " . count($nendoroids) . " nendoroids described in Nendoroids-db";
  $og_description = "We have " . count($nendoroids) . " nendoroids described in Nendoroids-db. "
        . "The last one is " . $nendoroid['nendoroid_name']
        . ((isset($nendoroid['nendoroid_version']) && strlen($nendoroid['nendoroid_version'])>0)?" - ".$nendoroid['nendoroid_version']:"")
        . " - From box: " . $nendoroid['box_category'] 
        . ((isset($nendoroid['box_number']) && strlen($nendoroid['box_number'])>0)?" #".$nendoroid['box_number']:"") 
        . " - " . $nendoroid['box_name'];
  $og_image = "http://" . $_SERVER['HTTP_HOST'] . "/images/nendos/nendoroids/" . $nendoroid['nendoroid_internalid'] . "_thumb";

} else {
  raiseError($resultInfo[2]);
}

include_once('mvc/views/pages/skeleton.php');
